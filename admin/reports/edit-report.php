<?php

/**
  * List all reports with a link to edit
  */

try {
  require "../../config.php";
  require "../../common.php";

  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT *
          FROM Incident, Cause
          WHERE Incident.IncidentNum = Cause.IncidentNum";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>

<?php require "../../templates/header.php"; ?>

<body>
	<h1>Edit Report</h1>
	
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
        		</tr>
        	<?php endforeach; ?>
  		</tbody>
  	</table>
	
</body>

<a href="reports.php">Back to Reports</a>

<?php require '../../templates/footer.php'; ?>