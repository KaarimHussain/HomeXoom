<nav class="navbar fixed-top navbar-expand-lg m-lg-3 p-1">
    <div class="container header d-flex align-items-center justify-content-between">
        <a class="navbar-brand" href="#">
            <img src="<?php echo BASE_URL ?>/Images/Logo.png" class="img-fluid w-sm-25" alt="HomeXoom Logo">
        </a>
        <div class="offcanvas offcanvas-end h-screen" tabindex="-1" id="offcanvasNavbar"
            aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                    HomeXoom
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-center flex-grow-1 pe-3 gap-3">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Buy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sell</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Listing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Our Team</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-between gap-3">
            <button class="navbar-toggler bg-white" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div>
                <button class="button-primary">Login</button>
                <button class="button-secondary">Register</button>
            </div>
        </div>
    </div>
</nav>