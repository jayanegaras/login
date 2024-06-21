<?php
// Database connection
$conn = mysqli_connect("localhost","root","","login");

function query($query){
    global $conn;
    $result = mysqli_query($conn,"$query");
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}
    function register($data){
        global $conn;
        $username = strtolower(htmlspecialchars($data["usernamesign"]));
        $password = strtolower(htmlspecialchars($data["passwordsign"]));
        
        // check username availability
        $check = mysqli_query($conn,"SELECT username FROM users WHERE username = '$username'");

        if(mysqli_fetch_assoc($check) == true){
            echo "
            <script>
                alert('Username already taken');
            </script>
            ";
            return false;
        }

        // encryption
        $password = password_hash($password, PASSWORD_DEFAULT);

        mysqli_query($conn,"INSERT INTO users VALUES('$username', '', '$password')");
        return mysqli_affected_rows($conn);  
}

function login(){
    if  (!isset($_SESSION["login"])){
        header("Location: index.php");
    }
}
