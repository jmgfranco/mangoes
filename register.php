<?php
	include "header.php";
?>

<main>
	<div class="register">
		<section class="section">
			<h1>Create your Account</h1>
			<form action="include/register.inc.php" method="post" class="blocky" enctype="multipart/form-data">

				<input type="text" name="user" placeholder="Username" class="name txt-trans" id="txt-trans" >	

				<input type="password" name="pass1" placeholder="Password" class="password" id="txt-trans" >

				<input type="password" name="pass2" placeholder="Re-enter Password" class="password2" id="txt-trans">
				
				<input type="text" name="display-name" placeholder="Display Name " id="txt-trans">
				
				<input type="text" name="mail" placeholder="E-mail" class="email" id="txt-trans">

				<!--<input type="file" name="profile"> -->
				
				<button type="submit" name="signbtn">Sign Up</button>
			</form>
		</section>
	</div>
</main>