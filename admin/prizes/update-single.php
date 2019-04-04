<?php

/**
  * Use an HTML form to edit an entry in the
  * prize table.
  *
  */

require "../../config.php";
require "../../common.php";

if (isset($_POST["submit"])){
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $Prize = ["PrizeName" => $_POST["PrizeName"],
                   "Member" => $_POST["Member"],
                   "EventName" => $_POST["EventName"],
                   "EventDate" => $_POST["EventDate"],
                   "Animal" => $_POST["Animal"]];
        
        $sql = "UPDATE Prize
                SET Member = :Member, Animal = :Animal
                WHERE PrizeName = :PrizeName AND EventName = :EventName
                    AND EventDate = :EventDate";
        
        $statement = $connection->prepare($sql);
        $statement->execute($Prize);

        $success = "Prize updated successfully.";
    } catch (PDOException $error) {
        echo $error->getMessage();
    }
}

if (isset($_GET['PrizeName'])) {
  try {
      $connection = new PDO($dsn, $username, $password, $options);
      $PrizeName = $_GET["PrizeName"];
      $EventName = $_GET["EventName"];
      $EventDate = $_GET["EventDate"];
      
      
      $sql = "SELECT * FROM Prize 
              WHERE PrizeName = :PrizeName AND EventName = :EventName AND EventDate = :EventDate";
      $statement = $connection->prepare($sql);
      $statement->bindValue(":PrizeName", $PrizeName);
      $statement->bindValue(":EventName", $EventName);
      $statement->bindValue(":EventDate", $EventDate);
      $statement->execute();
      
      $Prize = $statement->fetch(PDO::FETCH_ASSOC);
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
	<h1>Edit a Prize</h1>
	
	<?php if ($success) echo $success; ?>
	
	<form method="post">
		<label for="PrizeName">Prize Name</label>
		<input type="text" name="PrizeName" id="PrizeName" value="<?php echo escape($Prize["PrizeName"])?>" readonly>
		<label for="Member">Member #</label>
		<input type="number" name="Member" id="Member" value="<?php echo escape($Prize["Member"])?>">
		<label for="EventName">Event Name</label>
		<input type="text" name="EventName" id="EventName" value="<?php echo escape($Prize["EventName"])?>" readonly>
		<label for="EventDate">Event Date</label>
		<input type="date" name="EventDate" id="EventDate" value="<?php echo escape($Prize["EventDate"])?>" readonly>
		<label for="Animal">Animal #</label>
		<input type="number" name="Animal" id="Animal" value="<?php echo escape($Prize["Animal"])?>">
		<input type="submit" name="submit" value="Submit">
	</form>
</body>

<a href="edit-prize.php">Back to Edit Prizes</a>

<?php include "../../tempates/footer.php"; ?>