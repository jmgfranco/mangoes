<?php
require 'dbhandler.php';

if(isset($_POST['new-Cov-Btn'])){
    $serId = $_POST['serId'];
    $coverName = $_FILES['new-Cover']['name'];
    $coverTmpName = $_FILES['new-Cover']['tmp_name'];
    $coverSize = $_FILES['new-Cover']['size'];
    $coverError = $_FILES['new-Cover']['error'];
    $coverType = $_FILES['new-Cover']['type'];

    $extension = array('jpg','png','gif','jpeg','');
    $file_extension = explode('.',$coverName);
    $file_ext = end($file_extension);

    if(in_array($file_ext,$extension)){
       
        $date = date("Y-m-d H:i:s");
        $coverLocation = "files/cover/".basename($coverName);

        if($coverSize == 0){}
        else{
            if(move_uploaded_file($coverTmpName,"../".$coverLocation)){
                $sql = "INSERT INTO `cover`(`coverName`, `coverTmpName`, `coverSize`, `coverError`, `coverType`, `coverLocation`,`coverDate`, `coverSerId`) VALUES (?,?,?,?,?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($stmt,$sql);
                mysqli_stmt_bind_param($stmt,"ssiisssi",$coverName,$coverTmpName,$coverSize,$coverError,$coverType,$coverLocation,$date,$serId  );
                mysqli_stmt_execute($stmt);
            }
            else{
                echo "FAIL";
            }
        }
        header("Location: ../series.php?ID=$serId");
    }
}