<?php 

/**
 * use an html form to create a new club
 * in the database
 */

if (isset($_POST['submit'])) {
    require "../../config.php";
    require "../../common.php";
    
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $new_club = array(
            "city" => $_POST['city'],
            "address" => $_POST['address']
        );
        
        $sql = "INSERT INTO Club (city, address) VALUES (:city, :address)";
        
        $statement = $connection->prepare($sql);
        $statement->execute($new_club);
    } catch(PDOException $error) {
        echo $sql . "<br/>" . $error->getMessage();
    }
}

?>

<?php include "../../templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
  <?php echo escape($_POST['city']); ?> successfully added.
<?php } ?>

<body>
	<h1>Create Club</h1>
	
	<form method="post">
		<label for="city">City</label>
		<br />
		<input type="text" name="city" id="city">
		<br />
		<label for="address">Address</label>
		<br />
		<input type="text" name="address" id="address">
		<br />
		<input type="submit" name="submit" value="Submit">
	</form>
</body>

<a href="clubs.php">Back to Clubs</a>

<?php include "../../templates/footer.php"; ?>