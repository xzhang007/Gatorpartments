<?php
	if($_SESSION['landlord'] == 0) {
		header("refresh:5; url=index.php");
		echo "You do not have the rights to access this page!";
	}
	/*
	if($_SERVER['REQUEST_METHOD'] == 'post') {
		$message = displayMessage(message);
		echo $message;
	}
	*/
?>

<div class="container">
	<h1> landlord's page </h1>

	<form action="<?php echo URL . 'user/authenticateMessage' ?>" method="post">
	Please Input Your Message Here: <input type="text" name="message"> <br>
	<input type="submit">
	</form>
</div>
