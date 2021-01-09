<?php
require "header.php";
if(isset($_GET['ID'])){
    include 'include/dbhandler.php';
    $ID = mysqli_real_escape_string($conn, $_GET['ID']);
}
?>

<div class="chp-container">
    <div class="new-chp-container">
        <form action="include/new-chp.inc.php" method="POST" enctype="multipart/form-data" id="upload-form">
            <div>
                <input type="file" name="pages[]" id="" multiple="">
            </div>
            <div>
                <input type="hidden" name="seriesId" value="<?php
                echo $ID;
                ?>"/>
                <input type="text" name="chp_name" placeholder="Chapter Name">
            </div>
            <div>
                <input type="text" name="chp_num" placeholder="Chapter Number">
            </div>
            <div>
                <label for="chp_name">Select Volume</label>
                <select name="volumeList" id="dropVol" form="upload-form">
                <?php
                    $query = "SELECT `volumeId`, `volumeSerNum`, `volumeName` FROM `volume` WHERE `volumeSerNum` = ? ";
                    $stmt = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($stmt,$query);
                    mysqli_stmt_bind_param($stmt,"i",$ID);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if(mysqli_num_rows($result)>0){
                        while($rows = mysqli_fetch_array($result)){
                            echo "<option value='{$rows['volumeId']}'>{$rows['volumeName']}</option>";
                        }
                    }     
                ?>
                </select>
            </div>
            <div>
                    <input type="submit" name="ChpBtn" value="Upload Chapter">
            </div>
        </form>
    </div>

    <div class="new-chp-addVol">
        <div class="New-Vol-Click">
            <a href="#" class="NewVolBtn" onclick="newVolClick()">Add New Volume</a>
        </div>
        <div class="newVolDrop" id="baba">
            <form action="include/new-vol.inc.php" method="POST">
                <input type="hidden" name="seriesId" value="<?php echo $ID;?>"/>
                <input type="text" name="newVolName" placeholder="Volume Name">
                <input type="submit" value="Add" name="addVol">
            </form>
        </div>
    </div>
</div>