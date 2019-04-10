<?php

/**
  * Use an HTML form to edit an entry in the
  * Club table.
  *
  */

require "../../config.php";
require "../../common.php";

if (isset($_POST["submit"])){
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $Club = ["City" => $_POST["City"], "Address" => $_POST["Address"]];
        
        $sql = "UPDATE Club
                SET Address = :Address
                WHERE City = :City";
        
        $statement = $connection->prepare($sql);
        $statement->execute($Club);

        $success = "Club updated successfully.";
    } catch (PDOException $error) {
        echo $error->getMessage();
    }
}

if (isset($_GET['City'])) {
  try {
      $connection = new PDO($dsn, $username, $password, $options);
      $City = $_GET["City"];
      
      $sql = "SELECT * FROM Club WHERE City = :City";
      $statement = $connection->prepare($sql);
      $statement->bindValue(":City", $City);
      $statement->execute();
      
      $Club = $statement->fetch(PDO::FETCH_ASSOC);
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
	<h1>Edit a Club</h1>
	
	<?php if ($success) echo $success; ?>
	
	<form method="post">
		<label for="City">City</label>
		<br/>
		<input type="text" name="City" id="City" value="<?php echo escape($Club["City"])?>" readonly>
		<br/>
		<label for="Address">Address</label>
		<br/>
		<input type="text" name="Address" id="Address" value="<?php echo escape($Club["Address"])?>">
		<br/>
		<label for="NumMemb"># of Members</label>
		<br/>
		<input type="number" name="NumMemb" id="NumMemb" value="<?php echo escape($Club["NumMemb"])?>" readonly>
		<br/>
		<input type="submit" name="submit" value="Submit">
	</form>
</body>

<a href="edit-club.php">Back to Edit Clubs</a>

<?php include "../../tempates/footer.php"; ?>