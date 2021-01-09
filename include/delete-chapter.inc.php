<?php
include 'dbhandler.php';
if(isset($_POST['delBtn'])){

    $chpSerId = $_POST['delSerId'];
    $chpVolId = $_POST['delVolId'];
    $chpId = $_POST['delChpId'];

    $chpDel = "SELECT  `chapterLocation` FROM `chapter` WHERE `chapterId` = $chpId AND `chapterVolId` = $chpVolId AND `chapterSerId` = $chpSerId";
    $chpDelResult = mysqli_query($conn, $chpDel);
    while($chpDelrow = mysqli_fetch_assoc($chpDelResult)){
        $chpDelPath = "../".$chpDelrow['chapterLocation'];

        if(!is_dir($chpDelPath)){
            header("Location: ../series.php?ID=$chpSerId ");
        }else{
            $pageDel = "SELECT `pageId`, `pageChpId`, `pageVolId`, `pageSerId`, `pageLocation` FROM `pages` WHERE `pageChpId` = $chpId AND `pageVolId` = $chpVolId AND `pageSerId` = $chpSerId ";
            $pageDelResult = mysqli_query($conn, $pageDel);
            while($pageDelrow = mysqli_fetch_assoc($pageDelResult)){
                $pageDelPath = "../".$pageDelrow['pageLocation'];
                if(!unlink($pageDelPath)){
                    echo "Error in deleting files";
                }else
                {}
            }
            rmdir($chpDelPath);

            $pageDelete = "DELETE FROM `pages` WHERE `pageChpId` = $chpId AND `pageVolId` = $chpVolId AND `pageSerId` = $chpSerId ";
            mysqli_query($conn,$pageDelete);

            $chapterDelete = "DELETE FROM `chapter` WHERE `chapterId` = $chpId AND `chapterVolId` = $chpVolId AND `chapterSerId` = $chpSerId";
            mysqli_query($conn, $chapterDelete);

            header("Location: ../series.php?ID=$chpSerId");
        }
    }
}
