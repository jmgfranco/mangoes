<?php
$phpFileUploadError = array(
    0 => 'success',
    1 => 'File Limit',
    2 => 'File Limit 2',
    3 => 'Partial Upload',
    4 => 'No file upload',
    6 => 'Missing temp folder',
    7 => 'FAile to write disk',
    8 => 'Stoped',
);

if(isset($_POST['ChpBtn'])){
    include 'dbhandler.php';
    $file_array = reArrayFiles($_FILES['pages']);
    $serId = $_POST['seriesId'];
    $chapterName = $_POST['chp_name'];
    $chapterNumber = $_POST['chp_num'];
    $volumeList = $_POST['volumeList'];
    $date = date("Y-m-d H:i:s");

    if(empty($chapterName)|| empty($_FILES['pages'])){
        header("Location: ../new-Chp.php?ID=$serId?EmptyChapterName");
        exit();
    }
    else if(empty($volumeList)){
        header("Location: ../new-Chp.php?ID=$serId?NoVolumeSelected");
        exit();
    }
    else{

        $sql = "SELECT `volumeId`, `volumeName`, `volumeFileLoc` FROM `volume` WHERE volumeId = ?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"i",$volumeList);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        while ($rows = mysqli_fetch_array($result)) {
            $volFileLoc = $rows['volumeFileLoc'];
            $chapterLocName = "$volFileLoc/$chapterName";

            if (!file_exists("../$chapterLocName")) {
                mkdir("../$chapterLocName",0700,true);
            }
            else{
                echo "Folder Already Exists";
            }

            $sql = "INSERT INTO `chapter`(`chapterName`, `chapterNumber`, `chapterVolId`, `chapterSerId`, `chapterDate`, `chapterLocation`) VALUES (?,?,?,?,?,?)";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,"siiiss",$chapterName,$chapterNumber,$volumeList,$serId,$date,$chapterLocName);
            mysqli_stmt_execute($stmt);
            
            $queue = "SELECT `chapterId` FROM `chapter` WHERE chapterName = ? AND chapterVolId = ? AND chapterSerId = ?  ";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$queue);
            mysqli_stmt_bind_param($stmt,"sii",$chapterName,$volumeList,$serId);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            while ($row = mysqli_fetch_assoc($result)) {
                $chapterId = $row['chapterId'];
        
                for ($i=0; $i < count($file_array); $i++) { 
                    if($file_array[$i]['error']){
                        $delete = "DELETE FROM `chapter` WHERE chapterName = ? AND chapterVolId = ? AND chapterSerId = ?  ";
                        $delStmt = mysqli_stmt_init($conn);
                        mysqli_stmt_prepare($delStmt,$delete);
                        mysqli_stmt_bind_param($delStmt,"sii",$chapterName,$volumeList,$serId);
                        mysqli_stmt_execute($delStmt);
                        header("Location: ../new-Chp.php?ID=$serId?NoFileUploaded");
                        exit();
                    }
                    else{
                        $extension = array('jpg','png','gif','jpeg');
                        $file_extension = explode('.',$file_array[$i]['name']);
                        $file_ext = end($file_extension);
            
                        if(!in_array($file_ext,$extension)){
                            ?> <div >
                            <?php echo "{$file_array[$i]['name']} - Invalid file extenxsion";
                            ?></div>
                            <?php
                        }
                        else{
                            $location = "../".$chapterLocName."/".basename($file_array[$i]['name']);
                            $filename = $file_array[$i]['name'];
                            $fileTmpName = $file_array[$i]['tmp_name'];
                            $fileSize = $file_array[$i]['size'];
                            $fileError = $file_array[$i]['error'];
                            $fileType = $file_array[$i]['type'];
                            $fileLocation = $chapterLocName."/".basename($file_array[$i]['name']);
                        
                            $sql = "INSERT INTO `pages`(`pageName`, `pageTmpName`, `pageSize`, `pageError`, `pageType`, `pageChpId`, `pageVolId`, `pageSerId`, `pageDate`, `pageLocation`) VALUES (?,?,?,?,?,?,?,?,?,?)";

                            $stmt = mysqli_stmt_init($conn);
                            mysqli_stmt_prepare($stmt,$sql);
                            mysqli_stmt_bind_param($stmt,"ssiisiiiss",$filename,$fileTmpName,$fileSize,$fileError,$fileType,$chapterId,$volumeList,$serId,$date,$fileLocation);
                            mysqli_stmt_execute($stmt);
                            
                            if (move_uploaded_file($file_array[$i]['tmp_name'], $location)){
                                header("Location: ../index.php?success");
                            }
                            else{
                                $msg = "Upload not Success";
                            } 
                        }
                    }
                }
            }
        }
    }   
}

function pre_r($array){
    echo '<pre';
    print_r($array);
    echo '<pre';
}

function reArrayFiles($file_post){
    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i=0; $i < $file_count ; $i++) { 
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }
    return $file_ary;
}

?>