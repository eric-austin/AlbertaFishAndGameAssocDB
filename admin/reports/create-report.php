<?php 

/**
 * use an html form to create a new member
 * in the database
 */

if (isset($_POST['submit'])) {
    require "../../config.php";
    require "../../common.php";
    
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $new_report = array(
            "IncidentNum" => $_POST["IncidentNum"],
            "Date" => $_POST['Date'],
            "ReporterName" => $_POST["RName"],
            "EmergencyFlag" => $_POST["EFlag"],
			"ViolationFlag" => $_POST["VFlag"],
			"OtherFlag" => $_POST["OFlag"],
            "Club" => $_POST["Club"]
        );
        
        $sql = "INSERT INTO Incident (IncidentNum, Date, ReporterName, EmergencyFlag, ViolationFlag, OtherFlag, Club) 
                VALUES (:IncidentNum, :Date, :ReporterName, :EmergencyFlag, :ViolationFlag, :OtherFlag, :Club)";
        
        $statement = $connection->prepare($sql);
        $statement->execute($new_report);
    } catch(PDOException $error) {
        echo $sql . "<br/>" . $error->getMessage();
    }
    
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $new_cause = array(
            "MemNo" => $_POST["MemNo"],
            "Club" => $_POST["Club"],
            "IncidentNum" => $_POST["IncidentNum"]
        );
        
        $sql = "INSERT INTO Cause (MemNo, Club, IncidentNum)
                VALUES (:MemNo, :Club, :IncidentNum)";
        
        $statement = $connection->prepare($sql);
        $statement->execute($new_cause);
       
    } catch (PDOException $e) {
        echo $sql . "<br/>" . $error->getMessage();
    }
}

?>

<?php include "../../templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
  <?php echo escape($_POST['IncidentNum']); ?> successfully added.
<?php } ?>

<body>
	<h1>Create Report</h1>

	<form method="post">
		<label for="IncidentNum">Incident #</label>
		<br/>
		<input type="number" name="IncidentNum" id="IncidentNum">
		<br/>
		<label for="MemNo">Offending Member #</label>
		<br/>
		<input type="number" name="MemNo" id="MemNo">
		<br/>
		<label for="Date">Date</label>
		<br />
		<input type="date" name="Date" id="Date">
		<br />
		<label for="RName">Reporter Name</label>
		<br />		
		<input type="text" name="RName" id="RName">
		<br />
		<label for="Club">Club</label>
		<br />
		<input type="text" name="Club" id="Club">
		<br />
		<label for="EFlag">Emergency (1=Yes, 0=No)</label>
		<br />
		<input type="number" name="EFlag" id="EFlag">
		<br />
		<label for="VFlag">Violation Flag (1=Yes, 0=No)</label>
		<br />
		<input type="number" name="VFlag" id="VFlag">
		<br />
		<label for="OFlag">Other Flag (1=Yes, 0=No)</label>
		<br />
		<input type="number" name="OFlag" id="OFlag">
		<br />
		<input type="submit" name="submit" value="Submit">
		<br />
	</form>
</body>

<a href="reports.php">Back to Reports</a>

<?php include "../../templates/footer.php"; ?>