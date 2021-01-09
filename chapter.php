<?php
require "header.php";
include 'include/dbhandler.php';

$chapterId=0;
if(isset($_GET['ChpId'])){
    $chapterId = $_GET['ChpId'];
    $nextChapter = $chapterId +1;
    $previousChapter = $chapterId-1;
    $sql = "SELECT chapterSerId FROM chapter WHERE chapterId = $chapterId";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    
    $chpCount = "UPDATE `chapter` SET `chapterCount`=`chapterCount`+1 WHERE `chapterId`=$chapterId";
    mysqli_query($conn,$chpCount);
}
?>

<div class="chapter-select-container">
        <select name="#" id="chapter-dropdown" onchange="chp_jump(this)" class="chapter-select">           
            <?php
                $chpQuery = "SELECT `chapterId`,`chapterName` FROM chapter WHERE chapterSerId = {$row['chapterSerId']}";
                $chpResult = mysqli_query($conn, $chpQuery);
                if(mysqli_num_rows($chpResult)>0){
                    while($chpRow = mysqli_fetch_assoc($chpResult)){
                        echo "<option id='sample' value='chapter.php?ChpId={$chpRow['chapterId']}'";
                        if($chapterId==$chpRow['chapterId']){echo "selected";} 
                        echo ">";
                        echo $chpRow['chapterName'];
                        echo "</options>";
                    }
                }
            ?>     
        </select>

        <div class="chp-btn-navigate">
            <div class="chp-prev">
                <a href="chapter.php?ChpId=<?php echo $previousChapter;?>">Previous Chapter</a>
            </div>
            <div class="chp-next">
                <a href="chapter.php?ChpId=<?php echo $nextChapter;?>">Next Chapter</a>
            </div>
        </div>

        <?php 
            $titleSql = "SELECT `serId`, `serName` FROM `series` WHERE `serId` = {$row['chapterSerId']}";
            $titleResult = mysqli_query($conn,$titleSql);
            if(mysqli_num_rows($titleResult)>0){
                while($titleRow = mysqli_fetch_assoc($titleResult)){
                    
                    echo "<div class='series-title'>";
                    echo "<a href='series.php?ID={$titleRow['serId']}'>{$titleRow['serName']}</a>";
                    echo "</div>";
                }   
            }
        ?>
</div>

<div class="container">
    <div class="page-container">
        <?php
            $sql = "SELECT  `pageLocation` FROM `pages` WHERE `pageChpId`=$chapterId";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result)>0){
                while ($row = mysqli_fetch_array($result)) {
                # code...
                $page = $row['pageLocation'];
                echo "<div class='page-img-container'>";
                     echo "<img src='$page'>";
                echo "</div>";
                }
            }else{
                echo "<h3>No Images Uploaded</h3>";
            }
        ?>
    </div>
    <!-- <button onclick="goBack()">Go Back</button> -->
    <button onclick="topFunction()" id="myBtn" title="Go to top">Go Back</button>
</div>

<script>
var mybutton = document.getElementById("myBtn");

  window.onscroll = function() {scrollFunction()};
  function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
      mybutton.style.display = "block";
    } else {
      mybutton.style.display = "none";
    }
  }
  
  // When the user clicks on the button, scroll to the top of the document
  function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
  }
</script>