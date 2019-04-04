<?php

/**
  * Use an HTML form to edit an entry in the
  * member table.
  *
  */

require "../../config.php";
require "../../common.php";

if (isset($_POST["submit"])){
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $Animal = ["TagNo" => $_POST["TagNo"],
                   "Weight" => $_POST["Weight"],
                   "Species" => $_POST["Species"],
                   "Gender" => $_POST["Gender"],
                   "Type" => $_POST["Type"],
                   "Hunter" => $_POST["Hunter"],
                   "WeaponUsed" => $_POST["WeaponUsed"]];
        
        $sql = "UPDATE Animal
                SET Weight = :Weight, Species = :Species, Gender = :Gender,
                    Type = :Type, Hunter = :Hunter, WeaponUsed = :WeaponUsed
                WHERE TagNo = :TagNo";
        
        $statement = $connection->prepare($sql);
        $statement->execute($Animal);

        $success = "Animal updated successfully.";
    } catch (PDOException $error) {
        echo $error->getMessage();
    }
}

if (isset($_GET['TagNo'])) {
  try {
      $connection = new PDO($dsn, $username, $password, $options);
      $TagNo = $_GET["TagNo"];
      
      $sql = "SELECT * FROM Animal WHERE TagNo = :TagNo";
      $statement = $connection->prepare($sql);
      $statement->bindValue(":TagNo", $TagNo);
      $statement->execute();
      
      $Animal = $statement->fetch(PDO::FETCH_ASSOC);
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
	<h1>Edit an Animal</h1>
	
	<?php if ($success) echo $success; ?>
	
	<form method="post">
		<label for="TagNo">Tag #</label>
		<input type="number" name="TagNo" id="TagNo" value="<?php echo escape($Animal["TagNo"])?>" readonly>
		<label for="Weight">Weight</label>
		<input type="number" name="Weight" id="Weight" value="<?php echo escape($Animal["Weight"])?>">
		<label for="Species">Species</label>
		<input type="text" name="Species" id="Species" value="<?php echo escape($Animal["Species"])?>">
		<label for="Gender">Gender</label>
		<input type="text" name="Gender" id="Gender" value="<?php echo escape($Animal["Gender"])?>">
		<label for="Type">Type</label>
		<input type="text" name="Type" id="Type" value="<?php echo escape($Animal["Type"])?>">
		<label for="Hunter">Hunter #</label>
		<input type="number" name="Hunter" id="Hunter" value="<?php echo escape($Animal["Hunter"])?>">
		<label for="WeaponUsed">Weapon Used</label>
		<input type="text" name="WeaponUsed" id="WeaponUsed" value="<?php echo escape($Animal["WeaponUsed"])?>">
		<input type="submit" name="submit" value="Submit">
	</form>
</body>

<a href="edit-animal.php">Back to Edit Animals</a>

<?php include "../../tempates/footer.php"; ?>