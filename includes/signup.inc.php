<?php

//php function to check, if the characters of the variable "$val" are within the limits of "$x" and "$y"
function between($val, $x, $y){
    $val_len = strlen($val);
    return ($val_len >= $x && $val_len <= $y)?TRUE:FALSE;
}

if(isset($_POST['signup-submit'])) {//very if the user clicked connexion button
    require 'dbh.inc.php';
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $username = $_POST['uid'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $tele = $_POST['tele'];
    $passwordRepeat = $_POST['pwd-repeat'];
    if(empty($fname) || empty($lname) || empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
        header("Location: ../index.php?error=emptyfields");
        exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)){
        header("Location: ../index.php?error=invalidemailusername");
        exit();  
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../index.php?error=invalidemail");   
        exit();
    }
    else if(!preg_match("/^[a-zA-Z0-9]*$/", $tele) || !between($tele,6,20)) {
        header("Location: ../index.php?error=invalidtele");
        exit();
    } 
    else if(!preg_match("/^[a-zA-Z ]*$/", $fname) || !between($fname,2,20)) {
        header("Location: ../index.php?error=invalidfname");
        exit();
    }
    else if(!preg_match("/^[a-zA-Z ]*$/", $lname) || !between($lname,2,40)) {
        header("Location: ../index.php?error=invalidlname");
        exit();
    }
    else if(!preg_match("/^[a-zA-Z0-9]*$/", $username) || !between($username,4,20)) {
        header("Location: ../index.php?error=invalidusername");
        exit();
    }
    else if(!between($password,6,20)) {
        header("Location: ../index.php?error=invalidpassword");
        exit();
    }
    else if($password !== $passwordRepeat){
       header("Location: ../index.php?error=passworddontmatch");
       exit();
    }
   else {
        $sql = "SELECT uidUsers, emailUsers FROM users WHERE uidUsers=? OR emailUsers=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../index.php?error=error1");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "ss", $username, $email);     //checking if there is an email existing already...
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if($resultCheck != 0){
                header("Location: ../index.php?error=usernameemailtaken");
                exit();
            }
            else {
                $sql = "INSERT INTO users(f_name, l_name, uidUsers, telephone, emailUsers, pwdUsers) VALUES(?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../index.php?error=error2");
                    exit();
                }
                else {
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);    //encrypting password
                    mysqli_stmt_bind_param($stmt, "ssssss", $fname, $lname, $username, $tele, $email, $hashedPwd);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../index.php?signup=success");
                    exit();
                }
            }
        }
    } 
    //closing the connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else{
    header("Location: ../index.php");
    exit();
}