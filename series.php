<?php
require "header.php";

if(isset($_GET['ID']))
{
    include 'include/dbhandler.php';
    $ID = mysqli_real_escape_string($conn, $_GET['ID']);

    $sql = "SELECT `serName`, `serAuthor`, `serDesc`, `serVolNum`, `serChpNum`, `serPageNum`, `serDate`, `serLocation` FROM `series` WHERE serId = $ID";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $sql = "SELECT `volumeSerNum`, `volumeName`, `volumeChpNum`, `volumeTotPage`, `volumeDate` FROM volume AS vol JOIN series AS ser ON ser.serId = vol.volumeSerNum WHERE vol.volumeSerNum = $ID ";
    $result = mysqli_query($conn, $sql);
    $rowsSerNum = mysqli_num_rows($result);

    $sql = "SELECT `chapterId`, `chapterName` FROM chapter AS chp JOIN series AS ser ON ser.serId = chp.chapterSerId WHERE chp.chapterSerId = $ID";
    $result = mysqli_query($conn, $sql);
    $rowChpNum = mysqli_num_rows($result);
    
    $sql = "SELECT `pageId`,`pageName` FROM pages AS pag JOIN series AS ser ON ser.serId = pag.pageSerId WHERE pag.pageSerId = $ID";
    $result = mysqli_query($conn, $sql);
    $rowPagNum = mysqli_num_rows($result);

    $update = "UPDATE `series` SET `serVolNum`= $rowsSerNum WHERE serId = $ID ";
    mysqli_query($conn, $update);

    $update = "UPDATE `series` SET `serChpNum`= $rowChpNum WHERE serId = $ID";
    mysqli_query($conn, $update);

    $update = "UPDATE `series` SET `serPageNum`=$rowPagNum WHERE serId = $ID";
    mysqli_query($conn, $update);
}
?>

<div class="container">
    <div class="series-container">
        <div class="series-cover">
            <?php
                $imgQuery = "SELECT `coverName`,`coverLocation`, `coverSerId` FROM `cover` WHERE `coverSerId` = $ID ORDER BY `coverDate` DESC LIMIT 1 ";
                $imgResult = mysqli_query($conn, $imgQuery);
                if(mysqli_num_rows($imgResult)>0){
                    while($pic = mysqli_fetch_assoc($imgResult)){
                        echo "<div class='ser-cover-container'>";
                            echo "<a href='series.php?ID=$ID'><img src='{$pic['coverLocation']}' alt='' class='thumb-link'></a>";
                        echo "</div>";
                    }
                }
                else{
                 
                    echo "<a href='series.php?ID=$ID'><img src='files/cover/default.jpg' alt=''></a>";
                }
            ?>
        </div>
        <div class="series-info">
            <ul class="series-info-list"> 
                <li>Title ID: <?php echo $ID;?></li>
                <li>Series Name: <?php echo $row['serName'];?></li>
                <li>Series Author: <?php echo $row['serAuthor'];?></li>
                <li>Number of Volumes: <?php echo $row['serVolNum'];?></li>
                <li>Number of Chapters: <?php echo $row['serChpNum'];?></li>
                <li>Number of Pages: <?php echo $row['serPageNum'];?></li>
                <?php
                if(isset($_SESSION['userId'])){
                echo "<li>";
                    echo "<a href='#' class='show-ser-edit' onclick='seriesDrop()'>Edit Series</a>";
                echo "</li>";
                echo "<div class='ser-edit-drop' id='series-drop'>";
                    echo "<ul>";
                        echo "<li><a href='cover.php?ID=$ID'>Change Cover</a></li>";
                       
                    echo "</ul>";
                echo "<li><a href='new-Chp.php?ID=$ID'><i class='fas fa-plus-circle fa-lg'></i>Add Chapter</a>";         
                echo "</li>";
                echo "</div>";
                }
                ?>
            </ul>
        </div>
    </div>

    <div class="series-description">
            <h3>Description</h3>
            <p><?php echo $row['serDesc']; ?></p>
    </div>

    <div class="series-chp-list">
        <ul class="chp-navigate">
            <li>Chapters</li>
            <!-- <li>Cover</li> -->
        </ul>
        <div class="chp-list-container">
            <div clas="chapter-row">
                <div class="chapter-title">
                    <span>Chapter Title</span>
                </div>
                <div class="chapter-date">
                    <i class="far fa-clock"></i>
                    <!-- <span>Upload Date</span> -->
                </div>
                <div class="chapter-view">
                <i class="fas fa-eye"></i>
                    <!-- <span>Views</span> -->
                </div>
            </div>
            <?php
            $chapList = "SELECT `chapterId`, `chapterName`, `chapterNumber`,`chapterVolId`, `chapterDate`, `chapterLocation`,`chapterCount` FROM `chapter` WHERE chapterSerId = $ID";
            $chpListResult = mysqli_query($conn,$chapList);

            if(mysqli_num_rows($chpListResult)>0){
                while($chpRow = mysqli_fetch_assoc($chpListResult)){
                echo "<div class='chapter-row'>";
                    echo "<div class='chapter-title'>";
                        echo "<a href='chapter.php?ChpId={$chpRow['chapterId']}'>{$chpRow['chapterName']}</a>";
                    echo "</div>";
                    echo "<div class='chapter-date'>";
                        echo "<span>{$chpRow['chapterDate']}</span> ";
                    echo "</div>";
                    echo "<div class='chapter-view'>";
                        echo "<span>{$chpRow['chapterCount']}</span>";
                    echo "</div>";
                    if(isset($_SESSION['userId'])){
                    echo "<div class='chapter-delete'>";
                        // echo "<a href='include/delete-chapter.inc.php' onclick='fuck()' id='confirm-delete'>Delete</a>";
                        echo "<form action='include/delete-chapter.inc.php' method='POST' onclick='return confirmDel()'>";
                            echo "<input type='hidden' value='$ID' name='delSerId'>";
                            echo "<input type='hidden' value='{$chpRow['chapterVolId']}' name='delVolId'>";
                            echo "<input type='hidden' value='{$chpRow['chapterId']}' name='delChpId'>";
                            echo "<input type='submit' value='Delete' name='delBtn'>";
                        echo "</form>";

                    echo "</div>";
                    }
                echo "</div>";
                }
            }
            else{
            echo "<div class='chapter-row'>";
               // echo "<div class='chapter-title'>";
                    echo "<br>";
                    echo "<span>No Chapter Uploaded</span>";
              //  echo "</div>";
            echo "</div>";
            }
            ?>
        </div>
    </div>
</div>
