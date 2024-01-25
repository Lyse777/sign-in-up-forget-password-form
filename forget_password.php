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

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // When Email exists, it will show form to reset password
        $_SESSION['reset_email'] = $email; // Storing email in session to use for password reset
        echo "
        <style>
         body, html {
            height: 100%;
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-image: url('24.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.8); 
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }

        .password-form h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .form-control {
            margin-bottom: 15px;
        }

        .form-control label {
            display: block;
            margin-bottom: 5px;
            color: #666;
        }

        .form-control input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box; 
        }

        .btn {
            background-color: #8EB821;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #7EA024;
        }

    </style>

  <div class='form-container'>
            <form class='password-form' action='reset_password.php' method='post' onsubmit='return validateNewPassword()'>
            <h2>New Password</h2>
                <div class='form-control'>
                    <label for='new_password'>Password:</label>
                    <input type='password' id='new_password' name='new_password' required placeholder='Enter your new password'>
                </div>
                <div class='form-control'>
                    <input type='submit' class='btn' value='Reset Password'>
                </div>
            </form>
        </div>

<script>
    function validateNewPassword() {
        var newPassword = document.getElementById('new_password').value;
        if (newPassword.length < 5) {
            alert('Password must be at least 5 characters long.');
            return false; // Preventing form submission
        }
        return true; // Allowing form submission
    }
</script>

        ";
    } else {
        echo "<script>
                    alert('No user found with that email address.');
                       window.location.href='forget_password.html';
                  </script>";
    }

    $stmt->close();
} 

$conn->close();
?>
