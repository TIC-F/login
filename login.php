<?php
    session_start();

    if(isset($_SESSION['user_id'])){
    //    header('Location: /login.php');
    }
    require 'database.php';
    if(!empty($_POST['email']) && !empty($_POST['password'])){
        $records = $conn->prepare('SELECT id, email, password FROM users WHERE email=:email');
        $records->bindParam(':email', $_POST['email']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $message = '';
        
        if(count($results) > 0 && password_verify($_POST['password'], $results['password'])){
        $_SESSION['user_id'] = $results['id'];
        header('Location: /login/index.php');  
        } else{
            $message = 'Sorry, Those credentials do not match';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header>
    <a href="/login">Your Name App</a>
</header>
    <h1>Login</h1>
    <span>or <a href="signup.php">Signup</a></span>
    <?php if (!empty($message)) : ?>
    <p><?= $message ?></p>
    <?php endif;?>
    <form action="login.php" method="post">
    <input type="text" name="email" placeholder="Enter your mail">
    <input type="password" name="password" placeholder="Enter your password">
    <input type="submit" value="Send">
    </form>
</body>
</html>