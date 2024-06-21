<?php 
session_start();
require 'function.php';

// cookies check
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // check username by id
    $result = mysqli_query($conn,"SELECT * FROM users WHERE id = '$id' ");
    $row = mysqli_fetch_assoc($result);

    // check key from username
    if ($key == hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
}
}

if (isset($_SESSION["login"])){
    header('Location: main.php');
}
// login button check
if (isset($_POST['login'])) {
    $username = strtolower(htmlspecialchars($_POST['username']));
    $password = strtolower(htmlspecialchars($_POST['password']));

    $result = mysqli_query($conn,"SELECT * FROM users WHERE username = '$username'");

    // username check
    if(mysqli_num_rows($result)){
        // password check
        $row = mysqli_fetch_assoc($result);
        if ( password_verify($password, $row["password"]))
        {
            // set session
            $_SESSION["login"] = true;
            // cookies add
            if (isset($_POST["remember"])){
                setcookie("id", $row["id"], time() + 60*60*24*30);
                setcookie("key", hash('sha256', $row['username']), time() + 60*60*24*30);
            }


            header("Location: main.php");
            exit;
        }
    } 
}

// sign up button check
if  (isset($_POST["sign"])) {
        if  ( register($_POST) > 0){
            echo "
            <script>
                alert('Account already signed');
            </script>
            ";
        }
        else {
            echo "<script>
                alert(".mysqli_error($conn).")
            </script>";
        }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="contain">
        <div class="nav">
             <div class = "button clicked" data-target = "login">
                <h2>Login</h2>
            </div>
            <div class = "button" data-target = "sign">
                <h2>Sign Up</h2>
            </div>
        </div>
        <div class = "hidden show" id="login">
        <form action="" method="post">
                <ul>
                    <li>
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" autocomplete ="off" required placeholder="username">
                    </li>
                    <li>
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" required>
                    </li>
                    <li>
                        <label for="remember">Remember Me</label>
                        <input type="checkbox" name = "remember" id="remember">
                    </li>
                    <li>
                        <button type="submit" name = "login" class="login" action = "">Login</button>
                    </li>
                </ul>
            </form>
        </div>
        <div class = "hidden" id="sign">
        <form action="" method="post">
                <ul>
                    <li>
                        <label for="usernamesign">Username</label>
                        <input type="text" name="usernamesign" id="usernamesign" autocomplete = "off" required placeholder="username">
                    </li>
                    <li>
                        <label for="passwordsign">Password</label>
                        <input type="password" name="passwordsign" id="passwordsign" required>
                    </li>
                    <li>
                        <button type="submit" name = "sign" class="sign" action = "">Sign</button>
                    </li>
                </ul>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>