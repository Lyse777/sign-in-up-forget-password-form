<?php
session_start();

$host = 'localhost';
$dbUser = 'root';
$dbPassword = '';
$dbName = 'web_tech';

$conn = new mysqli($host, $dbUser, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT fullname, email, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_fullname'] = $user['fullname'];
            header("Location: dashboard.php");
            exit;
        } else {

            echo "<script>
                    alert('Incorrect password.');
                       window.location.href='index.html';
                  </script>";
        }
    } else {
        echo "<script>
                    alert('Email does not exist.');
                       window.location.href='index.html';
                  </script>";
    }

    $stmt->close();
} 

$conn->close();
?>
