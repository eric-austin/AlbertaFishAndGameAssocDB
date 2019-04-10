<?php

/**
  * Use an HTML form to edit an entry in the
  * Event table.
  *
  */

require "../../config.php";
require "../../common.php";

if (isset($_POST["submit"])){
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $Event = ["Name" => $_POST["Name"],
                  "Date" => $_POST["Date"],
                  "City" => $_POST["City"],
                  "Street" => $_POST["Street"],
                  "Club" => $_POST["Club"]];
        
        $sql = "UPDATE Event
                SET City = :City, Street = :Street, Club = :Club
                WHERE Name = :Name AND Date = :Date";
        
        $statement = $connection->prepare($sql);
        $statement->execute($Event);

        $success = "Event updated successfully.";
    } catch (PDOException $error) {
        echo $error->getMessage();
    }
}

if (isset($_GET['Name'])) {
  try {
      $connection = new PDO($dsn, $username, $password, $options);
      $Name = $_GET["Name"];
      $Date = $_GET["Date"];
      
      $sql = "SELECT * FROM Event WHERE Name = :Name AND Date = :Date";
      $statement = $connection->prepare($sql);
      $statement->bindValue(":Name", $Name);
      $statement->bindValue(":Date", $Date);
      $statement->execute();
      
      $Event = $statement->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $error) {
      echo $sql . "<br/>" . $error->getMessage();
  }
} else {
    echo "Something went wrong!";
    exit;
}
?>

<?php include "../../templates/header.php"; ?>

<body>
	<h1>Edit an Event</h1>
	
	<?php if ($success) echo $success; ?>
	
	<form method="post">
		<label for="Name">Name</label>
		<br/>
		<input type="text" name="Name" id="Name" value="<?php echo escape($Event["Name"])?>" readonly>
		<br/>
		<label for="Date">Date</label>
		<br/>
		<input type="date" name="Date" id="Date" value="<?php echo escape($Event["Date"])?>" readonly>
		<br/>
		<label for="City">City</label>
		<br/>
		<input type="text" name="City" id="City" value="<?php echo escape($Event["City"])?>">
		<br/>
		<label for="Street">Street Address</label>
		<br/>
		<input type="text" name="Street" id="Street" value="<?php echo escape($Event["Street"])?>">
		<br/>
		<label for="Club">Club</label>
		<br/>
		<input type="text" name="Club" id="Street" value="<?php echo escape($Event["Club"])?>">
		<br/>
		<input type="submit" name="submit" value="Submit">
	</form>
</body>

<a href="edit-event.php">Back to Edit Events</a>

<?php include "../../tempates/footer.php"; ?>