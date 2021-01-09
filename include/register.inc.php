<?php

if (isset($_POST['signbtn'])){
    require 'dbhandler.php';

    $username = $_POST['user'];
    $password = $_POST['pass1'];
    $password2 = $_POST['pass2'];
    $nickName = $_POST['display-name'];
    $email = $_POST['mail'];

    if( empty($username) || empty($password) || empty($password2) || empty($nickName) || empty($email)){
        header("Location: ../register.php?error=emptyfield");
        exit();
    }

    else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        header("Location: ../register.php?invaliduid");
        exit();  
    }

    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		header("Location: ../register.php?invalidEmail");
		exit();
    }
    
    else if($password !== $password2){
		header("Location ../register.php?errorpassword");
  }
  
  else{
    $sql = "SELECT userName from users where userName=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      header("Location ../register.php?error=sqlerror");
      exit();
    }
    else{
      mysqli_stmt_bind_param($stmt, "s", $username);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultCheck = mysqli_stmt_num_rows($stmt);

      if($resultCheck > 0 ){
				header("Location ../register.php?errorusermailtaken");
				exit();
      }
      else{
        $sql = "INSERT INTO users (userName, userPass, userDspName, userEmail) VALUES (?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
          header("Location ../register.php?error=sqlerror");
					exit();
        }
        else{
          $passhash = password_hash($password, PASSWORD_DEFAULT);
          mysqli_stmt_bind_param($stmt, "ssss",$username,$passhash,$nickName,$email);
          mysqli_stmt_execute($stmt);
          header("Location: ../index.php?register=success");
					exit();
        }
      }
    }
    mysqli_stmt_close($stmt);
  	mysqli_close($conn);
  }
}