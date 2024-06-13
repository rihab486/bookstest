
<?php
session_start();
//echo 'ffffffffffffff';

// Retrieve the JSON data sent from JavaScript
$data = json_decode(file_get_contents('php://input'), true);

// Store the data in session variables
if (isset($data['iduser'])) {
    $_SESSION['iduser'] = $data['iduser'];
    echo  $_SESSION['iduser'] ;
}
if (isset($data['firstname'])) {
    $_SESSION['firstname'] = $data['firstname'];
    echo  $_SESSION['firstname'] ;
}
if (isset($data['lastname'])) {
    $_SESSION['lastname'] = $data['lastname'];
    echo  $_SESSION['lastname'] ;
}
if (isset($data['email'])) {
    $_SESSION['email'] = $data['email'];
    echo  $_SESSION['email'] ;
}
?>
