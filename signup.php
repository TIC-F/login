<?php
require 'database.php';
$message = '';
if (!empty($_POST['email']) && !empty($_POST['password']) && $_POST['password'] === $_POST['confirm_password']){
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email',$_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password',$password);

    if ($stmt->execute()){
        $message = 'Successfully created new user';
    }else{
        $message = 'Sorry there must have been an issue creating your account';
    }
}else{
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <a href="/login">Your Name App</a>
    </header>
    <?php if(!empty($message)): ?>
    <p><?= $message ?></p>
    <?php endif; ?>
    <h1>SignUp</h1>
    <span>or <a href="login.php">Login</a></span>
    <form action="signup.php" method="post">
    <input type="text" name="email" placeholder="Enter your mail">
    <input type="password" name="password" placeholder="Enter your password">
    <input type="password" name="confirm_password" placeholder="Confirm your password">
    <input type="submit" value="Send">
    </form>
</body>
</html>