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

if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['fullname'])) {
    $email = $_POST['email'];
    $fullname = $_POST['fullname'];
    $password = $_POST['password'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<script>
                    alert('A user with this email already exists.');
                    window.location.href='signup.html';
                  </script>";
    } else {
        $insertStmt = $conn->prepare("INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)");
        $insertStmt->bind_param("sss", $fullname, $email, $hashedPassword);

        if ($insertStmt->execute()) {
            echo "<script>
                    alert('Registration Was Successful.');
                    window.location.href='index.html';
                  </script>";
        } else {
            echo "Error: " . $conn->error;
        }

        $insertStmt->close();
    }

    $stmt->close();
} 

$conn->close();
?>
