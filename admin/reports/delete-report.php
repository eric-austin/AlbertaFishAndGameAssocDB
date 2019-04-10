<?php 

/**
 * List all events with a link to delete
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

try {
    $connection = new PDO($dsn, $username, $password, $options);
    
    $sql = "SELECT * 
            FROM Incident, Cause
            WHERE Incident.IncidentNum = Cause.IncidentNum";
    
    $statement = $connection->prepare($sql);
    $statement->execute();
    
    $result = $statement->fetchAll();
} catch (PDOException $error) {
    echo $sql . "<br/>" . $error->getMessage();
}

?>

<?php require "../../templates/header.php"; ?>

<body>
	<h1>Delete Report</h1>
	
	<?php if ($success) echo $success; ?>
	
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
        			<td><a href="delete-report.php?IncidentNum=<?php echo escape($row["IncidentNum"]); ?>">Delete</a></td>
        		</tr>
        	<?php endforeach; ?>
  		</tbody>
  	</table>
	
</body>

<a href="reports.php">Back to Reports</a>

<?php require '../../templates/footer.php'; ?>
