<?php

/**
  * HTML form to search for reports based
  * on given criteria
  */

require "../../config.php";
require "../../common.php";

if (isset($_GET["IncidentNum"])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $Number = $_GET["IncidentNum"];
        
        $sql = "DELETE FROM Incident WHERE IncidentNum = :IncidentNum";
        
        $statement = $connection->prepare($sql);
        $statement->bindValue(":IncidentNum", $Number);
        $statement->execute();
        
        $success = "Report successfully deleted.";
    } catch (PDOException $error) {
        echo $sql . "<br/>" . $error->getMessage();
    }
}

if (isset($_POST["submit"])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $sql = "SELECT *
                FROM Incident, Cause
                WHERE Incident.Club = :Club
                AND Incident.IncidentNum = Cause.IncidentNum";
        
        $Club = $_POST["Club"];
        
        $statement = $connection->prepare($sql);
        $statement->bindParam(":Club", $Club, PDO::PARAM_STR);
        $statement->execute();
        
        $result = $statement->fetchAll();
    } catch (PDOException $error) {
        echo $sql . "<br/>" . $error->getMessage();
    }
}

?>

<?php require "../../templates/header.php"; ?>

<body>

<?php
if (isset($_POST['submit'])) {
  if ($result && $statement->rowCount() > 0) { ?>
    <h2>Results</h2>

    <table>
  		<thead>
    		<tr>
      			<th>Incident Number</th>
      			<th>Member #</th>
      			<th>Date</th>
      			<th>Reporter Name</th>
				<th>Emergency Flag</th>
				<th>Violation Flag</th>
				<th>Other Flag</th>
				<th>Club</th>
    		</tr>
  		</thead>
  		<tbody>
  			<?php foreach ($result as $row) : ?>
  				<tr>
  					<td><?php echo escape($row["IncidentNum"]); ?></td>
  					<td><?php echo escape($row["MemNo"]); ?>
        			<td><?php echo escape($row["Date"]); ?></td>
        			<td><?php echo escape($row["ReporterName"]); ?></td>
        			<td><?php echo escape($row["EmergencyFlag"]); ?></td>
					<td><?php echo escape($row["ViolationFlag"]); ?></td>
					<td><?php echo escape($row["OtherFlag"]); ?></td>
        			<td><?php echo escape($row["Club"]); ?></td>
        			<td><a href="update-single.php?IncidentNum=<?php echo escape($row["IncidentNum"]); ?>">Edit</a></td>
        			<td><a href="search-report.php?IncidentNum=<?php echo escape($row["IncidentNum"]); ?>">Delete</a></td>
        		</tr>
        	<?php endforeach; ?>
  		</tbody>
  	</table>
    
  <?php } else { ?>
    > No results found for <?php echo escape($_POST['Club']); ?>.
  <?php }
} ?>

<?php if ($success) echo $success; ?>

	<h1>Search Reports</h1>
	
	<form method="post">
		<label for="Club">Club</label>
		<input type="text" name="Club" id="Club">
		<input type="submit" name="submit" value="View Results">
	</form>
</body>

<a href="reports.php">Back to Reports</a>

<?php require '../../templates/footer.php'; ?>
