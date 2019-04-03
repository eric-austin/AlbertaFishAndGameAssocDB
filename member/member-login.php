
<?php include "../templates/header.php"; ?>

<body>
	<h1>Member Login</h1>

	<form class="login" action="member-page.php" method="post">
		Email: <br /><input type="text" name="useremail" /><br />
		Password: <br /><input type="text" name="password" /><br />
		<input type="submit" name="submit" />
	</form>
</body>

<?php include "../templates/footer.php"; ?>
