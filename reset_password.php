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

if (isset($_POST['new_password']) && isset($_SESSION['reset_email'])) {
    $new_password = $_POST['new_password'];
    $email = $_SESSION['reset_email'];

    // Hashing the new password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
    $stmt->bind_param("ss", $hashed_password, $email);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {


        echo "<script>
                    alert('Password Changed successfully.');
                       window.location.href='index.html';
                  </script>";
    } else {
        echo "Failed to update password.";
    }

    $stmt->close();
}

$conn->close();
?>
