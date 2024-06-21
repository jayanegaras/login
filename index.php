<?php 

require 'function.php';


// login button check
if (isset($_POST['login'])) {
    $username = $_POST['login'];
    $password = $_POST['password'];

    $result = mysqli_query($conn,"SELECT * FROM users WHERE username = '$username'") or die(mysqli_error($conn));

    // username check
    if(mysqli_num_rows($result)){
        // password check
        $row = mysqli_fetch_assoc($result);
        if  (password_verify($password, $row["password"]))
        {
            // set session

            $_SESSION["login"] = true;


            header("Location: main.php");
            exit;
        }
    } 
}

// sign up button check
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div class="contain">
        <div class="nav">
            <div>Login</div>
            <div>Sign Up</div>
        </div>
        <div id="login">
            <form action="" method="post">
                <ul>
                    <li>
                        <label for="username">Username:</label>
                        <input type="text" name="username" id="username" required placeholder="username">
                    </li>
                    <li>
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" required>
                    </li>
                    <li>
                        <input type="checkbox" name = "remember" id="remember">
                        <label for="remember">Remember Me</label>
                    </li>
                    <li>
                        <button type="submit" name = "login" class="login" action = "">Login</button>
                    </li>
                </ul>
            </form>
        </div>
        <div id="sign">
            <form action="" method="post">
                <ul>
                    <li>
                        <label for="username">Username:</label>
                        <input type="text" name="username" id="username" required placeholder="username">
                    </li>
                    <li>
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" required>
                    </li>
                    <li>
                        <input type="checkbox" name = "remember" id="remember">
                        <label for="remember">Remember Me</label>
                    </li>
                    <li>
                        <button type="submit" name = "sign" class="sign" action = "">Sign</button>
                    </li>
                </ul>
            </form>
        </div>
    </div>
</body>
</html>