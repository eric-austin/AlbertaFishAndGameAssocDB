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
        
        $Incident = ["IncNo" => $_POST['IncNo'],
            "Date" => $_POST['Date'],
            "RName" => $_POST["RName"],
            "Club" => $_POST["Club"],
            "EFlag" => $_POST["EFlag"],
			"VFlag" => $_POST["VFlag"],
			"OFlag" => $_POST["OFlag"]];
        
        $sql = "UPDATE Incident
                SET Date = :Date, RName = :RName, Club = :Club,
                    EFlag = :EFlag, VFlag = :VFlag, OFlag = :OFlag
                WHERE IncNo = :IncNo";
        
        $statement = $connection->prepare($sql);
        $statement->execute($Incident);

        $success = "Incident updated successfully.";
    } catch (PDOException $error) {
        echo $error->getMessage();
    }
}

if (isset($_GET['IncNo'])) {
  try {
      $connection = new PDO($dsn, $username, $password, $options);
      $IncNo = $_GET["IncNo"];
      
      $sql = "SELECT * FROM Incident WHERE IncNo = :IncNo";
      $statement = $connection->prepare($sql);
      $statement->bindValue(":IncNo", $IncNo);
      $statement->execute();
      
      $Incident = $statement->fetch(PDO::FETCH_ASSOC);
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
	<h1>Edit a Report</h1>
	
	<?php if ($success) echo $success; ?>
	
	<form method="post">
		<label for="IncNo">Incident #</label>
		<input type="number" name="IncNo" id="IncNo" value="<?php echo escape($Incident["IncNo"])?>" readonly>
		<label for="Date">Date</label>
		<input type="date" name="Date" id="Date" value="<?php echo escape($Incident["Date"])?>">
		<label for="RName">Reporter Name</label>
		<input type="text" name="RName" id="RName" value="<?php echo escape($Incident["RName"])?>">
		<label for="Club">Club</label>
		<input type="text" name="Club" id="Club" value="<?php echo escape($Incident["Club"])?>">
		<label for="EFlag">EFlag</label>
		<input type="checkbox" name="EFlag" id="EFlag" value="<?php echo escape($Incident["EFlag"])?>">
		<label for="VFlag">VFlag</label>
		<input type="checkbox" name="VFlag" id="VFlag" value="<?php echo escape($Incident["VFlag"])?>">
		<label for="OFlag">OFlag</label>
		<input type="checkbox" name="OFlag" id="OFlag" value="<?php echo escape($Incident["OFlag"])?>">
		<input type="submit" name="submit" value="Submit">
	</form>
</body>

<a href="edit-report.php">Back to Edit Reports</a>

<?php include "../../tempates/footer.php"; ?>