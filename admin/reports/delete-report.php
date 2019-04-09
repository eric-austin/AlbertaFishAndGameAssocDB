<?php 

/**
 * List all events with a link to delete
 */

require "../../config.php";
require "../../common.php";

if (isset($_GET["Name"])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $IncNo = $_GET["IncNo"];
        
        $sql = "DELETE FROM Incident WHERE IncNo = :IncNo";
        
        $statement = $connection->prepare($sql);
        $statement->bindValue(":IncNo", $Name);
        $statement->execute();
        
        $success = "Incident successfully deleted.";
    } catch (PDOException $error) {
        echo $sql . "<br/>" . $error->getMessage();
    }
}

try {
    $connection = new PDO($dsn, $username, $password, $options);
    
    $sql = "SELECT * FROM Incident";
    
    $statement = $connection->prepare($sql);
    $statement->execute();
    
    $result = $statement->fetchAll();
} catch (PDOException $error) {
    echo $sql . "<br/>" . $error->getMessage();
}

?>

<?php require "../../templates/header.php"; ?>

<body>
	<h1>Edit Report</h1>
	
	<table>
  		<thead>
    		<tr>
      			<th>Incident Number</th>
      			<th>Date</th>
      			<th>Reporter Name</th>
      			<th>Club</th>
				<th>Emergency Flag</th>
				<th>Violation Flag</th>
				<th>Other Flag</th>
    		</tr>
  		</thead>
  		<tbody>
  			<?php foreach ($result as $row) : ?>
  				<tr>
  					<td><?php echo escape($row["IncNo"]); ?></td>
        			<td><?php echo escape($row["Date"]); ?></td>
        			<td><?php echo escape($row["RName"]); ?></td>
        			<td><?php echo escape($row["EFlag"]); ?></td>
					<td><?php echo escape($row["VFlag"]); ?></td>
					<td><?php echo escape($row["OFlag"]); ?></td>
        			<td><?php echo escape($row["Club"]); ?></td>
        			<td><a href="update-single.php?Name=<?php echo escape($row["IncNo"]); ?>
        							&Date=<?php echo escape($row["Date"]); ?>">Edit</a></td>
        		</tr>
        	<?php endforeach; ?>
  		</tbody>
  	</table>
</body>

<a href="reports.php">Back to Events</a>

<?php require '../../templates/footer.php'; ?>
