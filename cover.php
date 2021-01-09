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
            <!-- <div class="add-cover">
                <a href="#">Change Cover</a>    
            </div> -->
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
                <li>Title Id: <?php echo $ID;?></li>
                <li>Series Name: <?php echo $row['serName'];?></li>
                <li>Series Author: <?php echo $row['serAuthor'];?></li>
                <li>Number of Volumes: <?php echo $row['serVolNum'];?></li>
                <li>Number of Chapters: <?php echo $row['serChpNum'];?></li>
                <li>Number of Pages: <?php echo $row['serPageNum'];?></li>
                <li>
                    <form action="include/new-cover.inc.php" method="POST" enctype="multipart/form-data"> 
                        <input type="hidden" name="serId" value="<?php echo $ID;?>">
                        <input type="file" name="new-Cover">
                        <button type="submit" name="new-Cov-Btn">Add Cover</button>
                    </form>               
                </li>
            </ul>
        </div>
    </div>

    <div class="series-description">
            <h3>Description</h3>
            <p><?php echo $row['serDesc']; ?></p>
    </div>

    <div class="series-chp-list">
        <ul class="chp-navigate">
            <!-- <li>Chapters</li> -->
            <li>Cover</li>
        </ul>
        <div class="chp-list-container">
            <?php
                $imgQuery = "SELECT `coverName`,`coverLocation`, `coverSerId` FROM `cover` WHERE `coverSerId` = $ID ORDER BY `coverDate` DESC ";
                $imgResult = mysqli_query($conn, $imgQuery);
                if(mysqli_num_rows($imgResult)>0){
                    while($pic = mysqli_fetch_assoc($imgResult)){
                        echo "<div class='cover-list-container'>";
                            echo "<a href='#'><img src='{$pic['coverLocation']}' alt='' class='thumb-link'></a>";
                        echo "</div>";
                    }
                }else{}
            ?>
        </div>
    </div>
</div>