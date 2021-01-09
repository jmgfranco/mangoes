<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/140915f29c.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Jost&display=swap" rel="stylesheet"> 
    <link rel="icon" href="files/cover/logo.png">
    <title>Reader</title>
</head>

<body>
    <header>
        <a href="index.html" class="header"></a>
        <nav>
            <ul>
                <li><img src="files/cover/logo.png" alt=""></li>
                <li><a href="index.php">Home</a></li>
                <!-- <li><a href="#">List</a></li> -->
                <li>
                    <form action="#">
                        <input type="text" placeholder="Search..." name="search">
                        <!-- <button type="submit"><i class="fa fa-search"></i></button> -->
                    </form>
                </li>
            </ul>
        </nav>
    
        <div class="signin">
            <?php
                if(isset($_SESSION['userId'])){
                echo '
                <div class="login-hover">
                        <button class="dropbtn">';
                    
                        echo "<span>Welcome ".$_SESSION["displayName"]."</span>";
                        echo "<i class='fas fa-user-alt'></i>";
                        echo'</button>
                        <div class="dropdown-content">
                            <a href="#" class="profile">Update Profile</a>
                            <form action="include/logout.inc.php" method="post" class="logout">
                            <button type="submit" name="logform">Logout</button>
                            </form>
                        </div>
                    </div>    
                ';
                }
                else{
                    echo' 
                <ul>
                    <li><a href="#" class="login-class" onclick="dropDown()">Login</a></li>       
                    <li><a href="register.php" class="#">Register</a></li>
                </ul>          
                <div class="drop under" id="down">
                    <form action="include/login.inc.php" method="post">
                        <input type="text" name="usern" placeholder="Username"><br>
                        <input type="password" name="passwrd" placeholder="Password"><br>
                        <input type="submit" value="Log In" name="login-submit">   
                    </form>  
                </div>';
            }      
            ?>
        </div>
    </header>

    <script src="js/script.js"></script>
</body>
</html>