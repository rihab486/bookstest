<!-- Navbar Start -->
<div class="container-fluid bg-primary">
    <div class="container">
        <nav class="navbar navbar-dark navbar-expand-lg py-0">
            <a href="./index.php?page=home" class="navbar-brand">
                <h1 class="text-white fw-bold d-block">Smo<span class="text-secondary">fet</span></h1>
            </a>
            <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse bg-transparent" id="navbarCollapse">
                <div class="navbar-nav ms-auto mx-xl-auto p-0">
                    <a href="./index.php?page=home" class="nav-item nav-link active text-secondary">Home</a>
                    
                    <?php
                    session_start();
                   
                    if (isset($_SESSION['iduser']) && isset($_REQUEST['page']) && $_REQUEST['page'] === 'account') {
                        ?>
                        <a href="./index.php?page=home" class="nav-item nav-link">Logout</a>
                    <?php
                    } else {
                    ?>
                        <a href="./index.php?page=register" class="nav-item nav-link">Signup</a>
                        <a href="./index.php?page=login" class="nav-item nav-link">Signin</a>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="d-none d-xl-flex flex-shrink-0">
                <div id="phone-tada" class="d-flex align-items-center justify-content-center me-4">
                    <a href="" class="position-relative animated tada infinite">
                        <i class="fa fa-phone-alt text-white fa-2x"></i>
                        <div class="position-absolute" style="top: -7px; left: 20px;">
                            <span><i class="fa fa-comment-dots text-secondary"></i></span>
                        </div>
                    </a>
                </div>
                <div class="d-flex flex-column pe-4 border-end">
                    <span class="text-white-50">Have any questions?</span>
                    <span class="text-secondary">Call: + 0123 456 7890</span>
                </div>
                <div class="d-flex align-items-center justify-content-center ms-4">
                    <a href="#"><i class="bi bi-search text-white fa-2x"></i></a>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->
