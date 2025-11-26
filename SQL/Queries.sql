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
    INDEX idx_role_id (role_id),
    INDEX idx_user_type (user_type),
    INDEX idx_is_active (is_active)
);