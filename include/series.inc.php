<?php
require 'dbhandler.php';

if(isset($_POST['serBtn'])){
    $coverName = $_FILES['coverImg']['name'];
    $coverTmpName = $_FILES['coverImg']['tmp_name'];
    $coverSize = $_FILES['coverImg']['size'];
    $coverError = $_FILES['coverImg']['error'];
    $coverType = $_FILES['coverImg']['type'];

    $extension = array('jpg','png','gif','jpeg','');
    $file_extension = explode('.',$coverName);
    $file_ext = end($file_extension);

    if(in_array($file_ext,$extension)){

        $serName = $_POST['newSeries'];
        $serAuthor = $_POST['serAuthor'];
        $seriesDesc = $_POST['seriesDesc'];
        $seriesLocation = "files/series/".$serName;
        $date = date("Y-m-d H:i:s");
    
        if(empty($serName || $serAuthor || $seriesDesc)){
            header("Location: ../add-ser.php?EmptyField");
            exit();
        }
        else{
            if(!file_exists("../files/series.$serName")){
                mkdir("../files/series/".$serName,0700,true);
            }
            else{
                echo "Folder Already Exists";
            }

            $sql = "INSERT INTO `series`(`serName`, `serAuthor`, `serDesc`, `serDate`, `serLocation`) VALUES (?,?,?,?,?)";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql)){
                header("Location: ../index.php?SeriesSqlError");
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt,"sssss",$serName,$serAuthor,$seriesDesc,$date,$seriesLocation);
                mysqli_stmt_execute($stmt);
                
                $query = "SELECT `serId` FROM `series` WHERE `serName` = ?";
                $stmt = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($stmt,$query);
                mysqli_stmt_bind_param($stmt,"s",$serName);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $row = mysqli_fetch_assoc($result);
                $coverSerId = $row['serId'];
                $coverLocation = "files/cover/".basename($coverName);

                if($coverSize == 0){}
                else{
                
                    if(move_uploaded_file($coverTmpName,"../".$coverLocation)){
                        $sql = "INSERT INTO `cover`(`coverName`, `coverTmpName`, `coverSize`, `coverError`, `coverType`, `coverLocation`,`coverDate`, `coverSerId`) VALUES (?,?,?,?,?,?,?,?)";
                        $stmt = mysqli_stmt_init($conn);
                        mysqli_stmt_prepare($stmt,$sql);
                        mysqli_stmt_bind_param($stmt,"ssiisssi",$coverName,$coverTmpName,$coverSize,$coverError,$coverType,$coverLocation,$date,$coverSerId);
                        mysqli_stmt_execute($stmt);
                    }
                    else{
                        echo "FAIL";
                        // Put The default Image Here
                    }
                }
                header("Location: ../index.php?success"); 
            }
        }
    }
    else{
        header("Location: ../add-ser.php?NoFileUploaded");
        exit();
    }
}
