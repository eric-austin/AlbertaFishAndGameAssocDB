<?php 

/**
 * use an html form to create a new event
 * in the database
 */

if (isset($_POST['submit'])) {
    require "../../config.php";
    require "../../common.php";
    
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $new_event = array(
            "Name" => $_POST["Name"],
            "Date" => $_POST["Date"],
            "City" => $_POST["City"],
            "Street" => $_POST["Street"],
            "Club" => $_POST["Club"]
        );
        
        $sql = "INSERT INTO Event (Name, Date, City, Street, Club)
                VALUES (:Name, :Date, :City, :Street, :Club)";
        
        $statement = $connection->prepare($sql);
        $statement->execute($new_event);
    } catch(PDOException $error) {
        echo $sql . "<br/>" . $error->getMessage();
    }
}

?>

<?php include "../../templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
  <?php echo escape($_POST['Name']); ?> successfully added.
<?php } ?>

<body>
	<h1>Create Event</h1>
	
	<form method="post">
		<label for="Name">Name</label>
		<br />
		<input type="text" name="Name" id="Name">
		<br />
		<label for="Date">Date</label>
		<br />
		<input type="date" name="Date" id="Date">
		<br />
		<label for="City">City</label>
		<br />
		<input type="text" name="City" id="City">
		<br />
		<label for="Street">Address</label>
		<br />
		<input type="text" name="Street" id="City">
		<br />
		<label for="Club">Club</label>
		<br />
		<input type="text" name="Club" id="Club">
		<br />
		<input type="submit" name="submit" value="Submit">
	</form>
</body>

<a href="events.php">Back to Events</a>

<?php include "../../templates/footer.php"; ?>