<?php

require_once 'Connection.php'; 

use App\Database\DB_Connection;


// Instantiate DB_Connection and call the connect method
$object = new DB_Connection();
$conn = $object->connect();

//method request

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST' || $method === 'GET') {
    handleRequest($conn);
} 
else {
    header("HTTP/1.1 405 Method Not Allowed");
    echo json_encode(['error' => 'Method not allowed']);
}

function handleRequest($conn) {

    if (isset($_REQUEST['action'])) {
        $action = $_REQUEST['action'];
        if ($action === 'login') {
            loginUser($conn);
        } elseif ($action === 'insert') {
            insertUser($conn);
        } elseif ($action === 'allBooks') {
            if (isset($_REQUEST['user_id'])) {
                GetBooksByIduser($conn, $_REQUEST['user_id']);
            } else {
                header("HTTP/1.1 400 Bad Request");
                echo json_encode(['error' => 'User ID is required']);
            }
        }elseif ($action === 'ValidationEmail') {

            validateEmail($conn);

        }elseif($action === 'deletebook'){
            DeleteBookByIduser($conn,$_REQUEST['user_id'],$_REQUEST['book_id']);
        }
        elseif ($action === 'addBook') {
            if (isset($_REQUEST['user_id']) && isset($_REQUEST['bookName']) && isset($_REQUEST['bookPrice'])) {
                addBookByIdUser($conn, $_REQUEST['user_id'], $_REQUEST['bookName'], $_REQUEST['bookPrice']);
            } else {
                header("HTTP/1.1 400 Bad Request");
                echo json_encode(['error' => 'User ID, Book Name, and Book Price are required']);
            }
        }else {
            header("HTTP/1.1 400 Bad Request");
            echo json_encode(['error' => 'Invalid action']);
        }
    }  
    else {
        header("HTTP/1.1 400 Bad Request");
        echo json_encode(['error' => 'Invalid action ']);
    }
}

// Function to insert a new user
function insertUser($conn) {
    // Retrieve and validate input
    $firstname = isset($_REQUEST['firstname']) ? trim($_REQUEST['firstname']) : null;
    $lastname = isset($_REQUEST['lastname']) ? trim($_REQUEST['lastname']) : null;
    $email = isset($_REQUEST['email']) ? trim($_REQUEST['email']) : null;
    $password = isset($_REQUEST['password']) ? trim($_REQUEST['password']) : null;

    // Check if any of the required fields are missing
    if (empty($firstname) || empty($lastname) || empty($email) || empty($password)) {
        echo json_encode(['error' => 'All fields are required']);
        return;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO user (firstname, lastname, email, password) VALUES (:firstname, :lastname, :email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashed_password);

    if ($stmt->execute()) {
        echo json_encode(['results' => '1']);
    } else {
        echo json_encode(['error' => '0']);
    }
}

// Function to login a user
function loginUser($conn) {
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];

    $sql = "SELECT * FROM user WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        echo json_encode(['user' => $user]);
    } else {
        echo json_encode(['error' => '0']);
    }
}

// Function to fetch all books for a specific user
function GetBooksByIduser($conn, $userId) {
    $sql = "SELECT * FROM books WHERE user_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $userId);
    $stmt->execute();

    $resultsqlbooks = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($resultsqlbooks)) {
        echo json_encode(['results' => $resultsqlbooks]);
    } else {
        echo json_encode(['results' => 0]);
    }
}
// function to add book for a specific user
function AddBookByIduser($conn, $userId, $bookName, $bookPrice) {
    $sql = "INSERT INTO books (user_id, name, price) VALUES (:user_id, :name, :price)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':name', $bookName);
    $stmt->bindParam(':price', $bookPrice);
    
    if ($stmt->execute()) {
        echo json_encode(['results' => '1']);
    } else {
        echo json_encode(['error' => '0']);
    }
}

// Function to delete a book for a specific user
function DeleteBookByIduser($conn, $userId, $bookId) {
    $sql = "DELETE FROM books WHERE id = :book_id AND user_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':book_id', $bookId);
    $stmt->bindParam(':user_id', $userId);

    if ($stmt->execute()) {
        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => 1]);
        } else {
            echo json_encode(['success' => 0]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete book']);
    }
}


// Function to validate email
function validateEmail($conn) {
    $email = $_REQUEST['email'];
    $sql = $conn->prepare("SELECT COUNT(*) as somme FROM user WHERE email = :email");
    $sql->bindParam(':email', $email);
    $sql->execute();
    $result_user = $sql->fetch(PDO::FETCH_OBJ);

    echo $result_user->somme != 0 ? 1 : 0;
}


?>