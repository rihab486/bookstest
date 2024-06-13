
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>HighTech - IT Solutions Website Template</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Saira:wght@500;600;700&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="src/lib/animate/animate.min.css" rel="stylesheet">
        <link href="src/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

        <!-- Customized Bootstrap Stylesheet -->
        <link href="src/css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="src/css/style.css" rel="stylesheet">

        <style>
            .inline-elements {
                    display: inline-block;
                    vertical-align: middle;
                    margin-right: 10px; /* Optional: Add space between elements */
                }
        </style>
    </head>

    <body>
     
<?php
include("includes/header.php");

?>
<?php
if (!isset($_REQUEST["page"]) || $_REQUEST["page"] === "") {
    include("pages/home.php");
} else {
    switch ($_REQUEST["page"]) {
        case "login":
            include("pages/login.php");
            break;
        case "register":
            include("pages/register.php");
            break;
        case "account":
            include("pages/account.php");
            break;
        case "home":
            include("pages/home.php");
            break;
        case "logout":
            include("pages/logout.php");
            break;
        default:
            include("pages/register.php"); // Default case to handle unexpected 'page' values
            break;
    }
}
?>

<?php
include("includes/footer.php");
?>

    

        <!-- Back to Top -->
        <a href="#" class="btn btn-secondary btn-square rounded-circle back-to-top"><i class="fa fa-arrow-up text-white"></i></a>

        
        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="src/lib/wow/wow.min.js"></script>
        <script src="src/lib/easing/easing.min.js"></script>
        <script src="src/lib/waypoints/waypoints.min.js"></script>
        <script src="src/lib/owlcarousel/owl.carousel.min.js"></script>

        <!-- Template Javascript -->
        <script src="src/js/main.js"></script>
    </body>

</html>