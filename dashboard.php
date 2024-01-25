<?php
session_start();

if (!isset($_SESSION['user_email'])) {
    header('Location: index.html');
    exit;
}

echo "<h1>Greetings, Dear " . htmlspecialchars($_SESSION['user_fullname']) . ". Welcome to your Dashboard!</h1>
<br>
<br>
<form action='logout.php' method='post'>
    <button type='submit' style='background-color: #8EB821; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer;'>Logout</button>
</form>
";
