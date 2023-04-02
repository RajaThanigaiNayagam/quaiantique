
<?php

//php function to check, if the characters of the variable "$val" are within the limits of "$x" and "$y"
function between($val, $x, $y){
    $val_len = strlen($val);
    return ($val_len >= $x && $val_len <= $y)?TRUE:FALSE;
}

if(isset($_POST['edituser-submit'])) {//very if the user clicked connexion button
    require 'dbh.inc.php';
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $user_id = $_POST['user_id'];
    $username = $_POST['uid'];
    $actuelusername = $_POST['actueluid'];
    $email = $_POST['mail'];
    $actuelemail = $_POST['actuelmail'];
    $originalpwd = $_POST['originalpwd'];
    $password = $_POST['pwd'];
    $actuelpassword = $_POST['actuelpwd'];
    $passwordRepeat = $_POST['pwd-repeat'];
    $hashedPwd = password_hash($passwordRepeat, PASSWORD_DEFAULT);    //encrypting password
    //echo '<h5 class="bg-danger text-center">Votre mot de passe actuel est erroné... original pwd - '.$originalpwd.'  et le actuel pwd est - '.$hashedPwd.'</h5>';
       
    //if ( password_verify($actuelpassword, $originalpwd) ) {echo 'The actuel password matches...';} else {echo 'The actuel password NOT matches...';}
    $tele = $_POST['tele'];
    if(empty($fname) || empty($lname) || empty($username) || empty($email) ) {    // || empty($password) || empty($passwordRepeat)) {
        header("Location: ../index.php?erroredit=emptyfields");
        exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)){
        header("Location: ../index.php?erroredit=invalidemailusername");
        exit();  
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../index.php?erroredit=invalidemail");   
        exit();
    }
    else if(!preg_match("/^[a-zA-Z0-9]*$/", $tele) || !between($tele,6,20)) {
        header("Location: ../index.php?erroredit=invalidtele");
        exit();
    } 
    else if(!preg_match("/^[a-zA-Z ]*$/", $fname) || !between($fname,2,20)) {
        header("Location: ../index.php?erroredit=invalidfname");
        exit();
    }
    else if(!preg_match("/^[a-zA-Z ]*$/", $lname) || !between($lname,2,40)) {
        header("Location: ../index.php?erroredit=invalidlname");
        exit();
    }
    else if(!preg_match("/^[a-zA-Z0-9]*$/", $username) || !between($username,4,20)) {
        header("Location: ../index.php?erroredit=invalidusername");
        exit();
    }
    ///else if ( !( is_null($password) && is_null($passwordRepeat)  && is_null($actuelpassword)  ) && ( !password_verify($actuelpassword, $originalpwd) )   ){
    //    header("Location: ../index.php?erroredit=actuelpassworddontmatch");
    //   exit();
    //}
    else if($password !== $passwordRepeat){
       header("Location: ../index.php?erroredit=passworddontmatch");
       exit();
    }
   else {
        $sql = "SELECT uidUsers, emailUsers FROM users WHERE uidUsers=? OR emailUsers=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){    
            header("Location: ../index.php?erroredit=error1");
            exit();
        }
        else {
            if( ($username <> $actuelusername) ){
                mysqli_stmt_bind_param($stmt, "s", $username);     //checking if there is an email existing already...
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                if($resultCheck != 0){
                    header("Location: ../index.php?erroredit=usernameemailtaken");
                    exit();
                }
            } else if(  ($email <> $actuelemail) ){
                mysqli_stmt_bind_param($stmt, "s", $email);     //checking if there is an email existing already...
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                if($resultCheck != 0){
                    header("Location: ../index.php?erroredit=usernameemailtaken");
                    exit();
                }
            }
            if  ( !( is_null($password) && is_null($passwordRepeat)   )  && ( !password_verify($actuelpassword, $originalpwd) )   ){    //&& is_null($actuelpassword)
                $sqlupdate = "UPDATE users SET f_name = '$fname', l_name = '$lname' , uidUsers = '$username', telephone = '$tele', emailUsers = '$actuelemail' WHERE user_id = $user_id ";
                //echo '<h5 class="bg-danger text-center">SQL - '.$sqlupdate.'</h5>';
                if ($conn->query($sqlupdate) ) { 
                    header("Location: ../index.php?edit=success");
                    exit();
                }else {
                    $sqlerror = $conn->error;
                    header("Location: ../index.php?erroredit=error1&sqlerror=".$sqlerror);
                    exit();
                }

            } else {
                if  ( ( is_null($password) && is_null($passwordRepeat)   )   ){    //&& is_null($actuelpassword)
                    $sqlupdate = "UPDATE users SET f_name = '$fname', l_name = '$lname' , uidUsers = '$username', telephone = '$tele', emailUsers = '$actuelemail', pwdUsers = '$hashedPwd' WHERE user_id = $user_id ";
                } else {                
                    $sqlupdate = "UPDATE users SET f_name = '$fname', l_name = '$lname' , uidUsers = '$username', telephone = '$tele', emailUsers = '$actuelemail' WHERE user_id = $user_id ";
                }
                if ($conn->query($sqlupdate) ) {
                    header("Location: ../index.php?edit=success");
                    exit();
                }else {
                    $sqlerror = $conn->error;
                    header("Location: ../index.php?erroredit=error2&sqlerror=".$sqlerror);
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
    header("Location: ../index.php?erroredit=nosubmitbutton");
    exit();
}
