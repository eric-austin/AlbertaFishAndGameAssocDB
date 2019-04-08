
<?php 

/**
 * use an html form to login
 * 
 */



if (isset($_POST['submit'])) {
    require "config.php";
    require "common.php";
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        $sql = "SELECT *
                FROM Login
                WHERE username = :username AND password = :password";
        
        $statement = $connection->prepare($sql);
        $statement->bindValue(":username", $username);
        $statement->bindValue(":password", $password);
        $statement->execute();
        
        $result = $statement->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $error) {
        echo $sql . "<br/>" . $error->getMessage();
    }
    
}

?>


<?php include "templates/header.php" ?>



<body>
	<h1>Login</h1>
	
	<?php if (isset($_POST['submit']) && $statement) { ?>
  		<?php echo escape($result["MemberID"]); ?> successfully logged in.
	<?php } ?>
	
	<form method="post">
		Username: <br /><input type="text" name="username" id="username"/><br />
		Password: <br /><input type="text" name="password" id="password"/><br />
		<input type="submit" name="submit" value="Submit"> 
	</form>
</body>

<?php include "templates/footer.php" ?>