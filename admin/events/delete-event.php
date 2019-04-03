<?php 

/**
 * List all events with a link to delete
 */

require "../../config.php";
require "../../common.php";

if (isset($_GET["Name"])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $Name = $_GET["Name"];
        $Date = $_GET["Date"];
        
        $sql = "DELETE FROM Event WHERE Name = :Name AND Date = :Date";
        
        $statement = $connection->prepare($sql);
        $statement->bindValue(":Name", $Name);
        $statement->bindValue(":Date", $Date);
        $statement->execute();
        
        $success = "Event successfully deleted.";
    } catch (PDOException $error) {
        echo $sql . "<br/>" . $error->getMessage();
    }
}

try {
    $connection = new PDO($dsn, $username, $password, $options);
    
    $sql = "SELECT * FROM Event";
    
    $statement = $connection->prepare($sql);
    $statement->execute();
    
    $result = $statement->fetchAll();
} catch (PDOException $error) {
    echo $sql . "<br/>" . $error->getMessage();
}

?>

<?php require "../../templates/header.php"; ?>

<body>
	<h1>Delete Event</h1>
	
	<?php if ($success) echo $success; ?>
	
	<table>
  		<thead>
    		<tr>
      			<th>Name</th>
      			<th>Date</th>
      			<th>City</th>
      			<th>Street Address</th>
      			<th>Club</th>
    		</tr>
  		</thead>
  		<tbody>
  			<?php foreach ($result as $row) : ?>
  				<tr>
  					<td><?php echo escape($row["Name"]); ?></td>
        			<td><?php echo escape($row["Date"]); ?></td>
        			<td><?php echo escape($row["City"]); ?></td>
        			<td><?php echo escape($row["Street"]); ?></td>
        			<td><?php echo escape($row["Club"]); ?></td>
        			<td><a href="delete-event.php?Name=<?php echo escape($row["Name"]); ?>
        							&Date=<?php echo escape($row["Date"]); ?>">Delete</a></td>
        		</tr>
        	<?php endforeach; ?>
  		</tbody>
  	</table>
</body>

<a href="events.php">Back to Events</a>

<?php require '../../templates/footer.php'; ?>
