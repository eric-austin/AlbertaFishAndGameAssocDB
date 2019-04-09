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
            "IncNo" => $_POST['IncNo'],
            "Date" => $_POST['Date'],
            "RName" => $_POST["RName"],
            "Club" => $_POST["Club"],
            "EFlag" => $_POST["EFlag"],
			"VFlag" => $_POST["VFlag"],
			"OFlag" => $_POST["OFlag"],
            "MemNo" => $_POST["MemNo"]
        );
        
        $sql = "INSERT INTO Incident (IncNo, Date, RName, Club, EFlag, VFlag, OFlag) 
                VALUES (:IncNo, :Date, :RName, :EFlag, :VFlag, :OFlag, :Club)";
        
        $statement = $connection->prepare($sql);
        $statement->execute($new_member);
    } catch(PDOException $error) {
        echo $sql . "<br/>" . $error->getMessage();
    }
}

?>

<?php include "../../templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
  <?php echo escape($_POST['IncNo']); ?> successfully added.
<?php } ?>

<body>
	<h1>Create Report</h1>

	<form method="post">
		<label for="IncNo">Incident Number</label>
		<br />		
		<input type="text" name="IncNo" id="IncNo">
		<br />
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
		<label for="EFlag">Emergency Flag</label>
		<br />
		<input type="checkbox" name="EFlag" id="EFlag">
		<br />
		<label for="VFlag">Violation Flag</label>
		<br />
		<input type="checkbox" name="VFlag" id="VFlag">
		<br />
		<label for="OFlag">Other Flag</label>
		<br />
		<input type="checkbox" name="OFlag" id="OFlag">
		<br />
		<input type="submit" name="submit" value="Submit">
		<br />
	</form>
</body>

<a href="reports.php">Back to Reports</a>

<?php include "../../templates/footer.php"; ?>