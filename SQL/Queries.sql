-- Create Database
CREATE DATABASE IF NOT EXISTS HomeXoom;
USE HomeXoom;

-- =============================================
-- Roles Table
-- =============================================
CREATE TABLE Roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(50) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO Roles (role_name) VALUES ('Buyer'), ('Seller'), ('Admin');

-- =============================================
-- Users Table
-- =============================================
CREATE TABLE Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_id INT NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(20),
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    -- Foreign Key Constraint
    CONSTRAINT fk_user_role 
        FOREIGN KEY (role_id) 
        REFERENCES Roles(id) 
        ON DELETE RESTRICT 
        ON UPDATE CASCADE,
    
    -- Indexes for better performance
    INDEX idx_email (email),
    INDEX idx_role_id (role_id)
);

-- =============================================
-- Subscriptions Table
-- =============================================
CREATE TABLE Subscriptions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    stripe_customer_id VARCHAR(255),
    stripe_subscription_id VARCHAR(255),
    stripe_price_id VARCHAR(255),
    status VARCHAR(50),
    current_period_start TIMESTAMP NULL DEFAULT NULL,
    current_period_end TIMESTAMP NULL DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    -- Foreign Key Constraint
    CONSTRAINT fk_subscription_user 
        FOREIGN KEY (user_id) 
        REFERENCES Users(id) 
        ON DELETE CASCADE 
        ON UPDATE CASCADE,

    -- Indexes
    INDEX idx_user_id (user_id),
    INDEX idx_stripe_customer_id (stripe_customer_id),
    INDEX idx_stripe_subscription_id (stripe_subscription_id)
);

UPDATE Subscriptions 
SET current_period_end = '2025-12-27 01:22:49'
WHERE user_id = 1;

-- =============================================
-- Properties Table
-- =============================================
CREATE TABLE Properties (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(15, 2) NOT NULL,
    address VARCHAR(255) NOT NULL,
    city VARCHAR(100) NOT NULL,
    state VARCHAR(100) NOT NULL,
    zip_code VARCHAR(20) NOT NULL,
    bedrooms INT,
    bathrooms DECIMAL(3, 1),
    sqft INT,
    property_type VARCHAR(50),
    area_type VARCHAR(50),
    country VARCHAR(100),
    google_map_url TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    -- Foreign Key Constraint
    CONSTRAINT fk_property_user 
        FOREIGN KEY (user_id) 
        REFERENCES Users(id) 
        ON DELETE CASCADE 
        ON UPDATE CASCADE,

    -- Indexes
    INDEX idx_property_user_id (user_id),
    INDEX idx_property_city (city),
    INDEX idx_property_price (price)
);

-- =============================================
-- PropertyImages Table
-- =============================================
CREATE TABLE PropertyImages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    property_id INT NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    is_primary BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    -- Foreign Key Constraint
    CONSTRAINT fk_image_property 
        FOREIGN KEY (property_id) 
        REFERENCES Properties(id) 
        ON DELETE CASCADE 
        ON UPDATE CASCADE,

    -- Indexes
    INDEX idx_image_property_id (property_id)
);