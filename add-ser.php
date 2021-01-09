<?php
require "header.php";
?>

<main>
    <div class="new-ser">
        <div class="ser-container"> 
            <h1>Add new series</h1>
            <form action="include/series.inc.php" method="POST" enctype="multipart/form-data">   
                <input type="text" name="newSeries" placeholder="Series Name">
                <input type="text" name="serAuthor" placeholder="Author">
                <textarea name="seriesDesc" id="" cols="30" rows="50" placeholder="Series Description"></textarea><br>
                <label for="cover">Cover</label>
                <input type="file" name="coverImg">
                <button type="submit" name="serBtn">Add Series</button>
            </form>
        </div>
    </div>
</main>