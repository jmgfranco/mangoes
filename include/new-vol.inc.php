<?php
if(isset($_POST['addVol'])){
    require 'dbhandler.php';

    $volTitle = $_POST['newVolName'];
    $serId = $_POST['seriesId'];
    $date = date("Y-m-d H:i:s");
    
    $fetch = "SELECT serId,serName,serLocation FROM `series` WHERE serId = ? ";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$fetch);
    mysqli_stmt_bind_param($stmt,"i",$serId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            $seriesLocation = $row['serLocation'];
            $volumeLocation = "$seriesLocation/$volTitle";

            if (!file_exists("...$volumeLocation")) {
                mkdir("../$volumeLocation",0700,true);
            }
            else{
                echo "Folder Already Exists";
            }

            $sql = "INSERT INTO `volume`(`volumeSerNum`, `volumeName`,`volumeDate`, `volumeFileLoc`) VALUES (?,?,?,?)";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,"isss",$serId,$volTitle ,$date,$volumeLocation);
            mysqli_stmt_execute($stmt);

            header("Location: ../new-Chp.php?ID=".$serId."newVolSuccess");
        }
    }
    else{
        echo "No Records Retard";
    }
}