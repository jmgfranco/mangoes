<?php
if (isset($_POST['login-submit'])){
    require 'dbhandler.php';

    $userId = $_POST['usern'];
    $userPass = $_POST['passwrd'];
    
	if(empty($userId) || empty($userPass)){
		header("Location: ../index.php?error=nofield");
		exit();
    }
    else{
        $sql = "SELECT * FROM users WHERE userName=? OR userEmail=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../index.php?error=sqlerror");
			exit();
        }
        else{
            mysqli_stmt_bind_param($stmt,"ss",$userId,$userId);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                $pwdcheck = password_verify($userPass, $row['userPass']);
                if($pwdcheck == false){
                    header("Location: ../index.php?error=wrongpassword");
					exit();
                }
                else if($pwdcheck == true){
					session_start();
					$_SESSION['userId'] = $row['userId'];
                    $_SESSION['userName'] = $row['userName'];
                    $_SESSION['displayName'] = $row['userDspName'];

					header("Location: ../index.php?login=success");
					exit();
				}
            }
            else{
                header("Location: ../index.php?error=userdoesntexist");
            }
        }
    }
}
else{
	header("Location: ../index.php");
	exit();
}
?>