<?php include "../templates/header.php"; ?>

<body>
	<h1>Admin Login</h1>

	<form action="admin-page.php" method="post">
		Email: <input type="text" name="useremail" /><br /> Password: <input
			type="text" name="password" /><br /> <input type="submit"
			name="submit" />
	</form>
</body>

<?php include "../templates/footer.php"; ?>