<?php
require "header.php";
include 'include/dbhandler.php';
?>

<div class="container">
    <div class="series-list">  
        <h2>Available Series</h2>
    </div>
    <div class="wrapper">
        <?php
            $sql = "SELECT `serId`, `serName`, `serAuthor`, `serDesc`,  `serLocation` FROM `series`";
            $result = mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                  echo "<div class='series-div'>";
                        echo "<div class='thumb'>";
                            $query = "SELECT `coverName`,`coverLocation`, `coverSerId` FROM `cover` WHERE `coverSerId` = {$row['serId']} ORDER BY `coverDate` DESC LIMIT 1";
                            $fetch = mysqli_query($conn, $query);
                            if(mysqli_num_rows($fetch)>0){
                                while($pic = mysqli_fetch_assoc($fetch)){
                                    if($pic['coverName']===""||empty($pic['coverSerId'])){
                                        echo "<a href='series.php?ID={$row['serId']}'><img src='files/cover/default.jpg' alt='' class='thumb-link'> </a>";
                                    }
                                    else{
                                        echo "<a href='series.php?ID={$row['serId']}'><img src='{$pic['coverLocation']}' alt='' class='thumb-link'>
                                        </a>";
                                    }
                                }
                            } 
                            else{
                                echo "<a href='series.php?ID={$row  ['serId']}'><img src='files/cover/default.jpg' alt='' class='thumb-link'> </a>";
                            }                          
                        echo "</div>";
                        echo "<div class='series-etc'>";
                            echo "<div class='title'>";
                                echo "<a href='series.php?ID={$row['serId']}'>{$row['serName']}</a>";
                            echo "</div>";
                            echo "<div class='author'>";
                                echo "<a href='#'>{$row['serAuthor']}</a>";
                            echo "</div>";
                            echo "<ul class='chap-list'>";
                                $chpquery = "SELECT `chapterId`, `chapterName`, `chapterSerId`,  `chapterLocation` FROM `chapter` WHERE chapterSerId= {$row['serId']} LIMIT 6";
                                $chpResult = mysqli_query($conn,$chpquery);
                                if(mysqli_num_rows($chpResult)>0){
                                    while ($rowChp = mysqli_fetch_assoc($chpResult)){
                                        echo "<li><a href='chapter.php?ChpId={$rowChp['chapterId']}'><li>{$rowChp['chapterName']}</li></a>";
                                    }
                                }
                                else{
                                    echo "<li>No Chapter Available</li>";
                                }
                            echo "</ul>";
                        echo "</div>";
                  echo "</div>";
                }
            }
            else{
                // echo "<a href='series.php?ID={$row['serId']}'><img src='files/cover/default.jpg' alt='' class='thumb-link'></a>";
            }
        ?>
        <?php
        if(isset($_SESSION['userId'])){
            echo '<div class="add-new">';
                echo '<div class="new-ser-border">';
                    echo '<a href="add-ser.php">';
                        echo '<div class="icon">';
                        echo '<i class="fas fa-plus-circle fa-5x"></i>';
                        echo '</div>';
                    echo '</a>';
                echo '</div>';
            echo '</div>';
        } 
        ?> 
    </div>
</div>

<!-- 
<?php
require "footer.php"
?> -->
<script type="js/index.js"></script>
