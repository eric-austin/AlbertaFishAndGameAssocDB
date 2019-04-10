<?php

/**
  * Use an HTML form to edit an entry in the
  * reports table.
  *
  */

require "../../config.php";
require "../../common.php";

if (isset($_POST["submit"])){
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $Incident = ["IncidentNum" => $_POST['IncidentNum'],
                     "Date" => $_POST['Date'],
                     "ReporterName" => $_POST["ReporterName"],
                     "EmergencyFlag" => $_POST["EmergencyFlag"],
			         "ViolationFlag" => $_POST["ViolationFlag"],
			         "OtherFlag" => $_POST["OtherFlag"],
                     "Club" => $_POST["Club"]];
        
        $sql = "UPDATE Incident
                SET Date = :Date, ReporterName = :ReporterName, EmergencyFlag = :EmergencyFlag,
                    ViolationFlag = :ViolationFlag, OtherFlag = :OtherFlag, Club = :Club
                WHERE IncidentNum = :IncidentNum";
        
        $statement = $connection->prepare($sql);
        $statement->execute($Incident);

        $success = "Incident updated successfully.";
    } catch (PDOException $error) {
        echo $error->getMessage();
    }
}

if (isset($_GET['IncidentNum'])) {
  try {
      $connection = new PDO($dsn, $username, $password, $options);
      $IncidentNum = $_GET["IncidentNum"];
      
      $sql = "SELECT * FROM Incident WHERE IncidentNum = :IncidentNum";
      $statement = $connection->prepare($sql);
      $statement->bindValue(":IncidentNum", $IncidentNum);
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
		<label for="IncidentNum">Incident #</label>
		<br/>
		<input type="number" name="IncidentNum" id="IncidentNum" value="<?php echo escape($Incident["IncidentNum"])?>" readonly>
		<br/>
		<label for="Date">Date</label>
		<br/>
		<input type="date" name="Date" id="Date" value="<?php echo escape($Incident["Date"])?>">
		<br/>
		<label for="ReporterName">Reporter Name</label>
		<br/>
		<input type="text" name="ReporterName" id="ReporterName" value="<?php echo escape($Incident["ReporterName"])?>">
		<br/>
		<label for="Club">Club</label>
		<br/>
		<input type="text" name="Club" id="Club" value="<?php echo escape($Incident["Club"])?>">
		<br/>
		<label for="EmergencyFlag">Emergency Flag (1=Yes, 0=No)</label>
		<br/>
		<input type="number" name="EmergencyFlag" id="EmergencyFlag" value="<?php echo escape($Incident["EmergencyFlag"])?>">
		<br/>
		<label for="ViolationFlag">VFlag (1=Yes, 0=No)</label>
		<br/>
		<input type="number" name="ViolationFlag" id="ViolationFlag" value="<?php echo escape($Incident["ViolationFlag"])?>">
		<br/>
		<label for="OtherFlag">OFlag (1=Yes, 0=No)</label>
		<br/>
		<input type="number" name="OtherFlag" id="OtherFlag" value="<?php echo escape($Incident["OtherFlag"])?>">
		<br/>
		<input type="submit" name="submit" value="Submit">
	</form>
</body>

<a href="edit-report.php">Back to Edit Reports</a>

<?php include "../../tempates/footer.php"; ?>