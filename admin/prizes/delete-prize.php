<?php 

/**
 * List all prizes with a link to delete
 */

require "../../config.php";
require "../../common.php";

if (isset($_GET["PrizeName"])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $PrizeName = $_GET["PrizeName"];
        $EventName = $_GET["EventName"];
        $EventDate = $_GET["EventDate"];
        
        $sql = "DELETE FROM Prize 
                WHERE PrizeName = :PrizeName AND EventName = :EventName
                        AND EventDate = :EventDate";
        
        $statement = $connection->prepare($sql);
        $statement->bindValue(":PrizeName", $PrizeName);
        $statement->bindValue(":EventName", $EventName);
        $statement->bindValue(":EventDate", $EventDate);
        $statement->execute();
        
        $success = "Prize successfully deleted.";
    } catch (PDOException $error) {
        echo $sql . "<br/>" . $error->getMessage();
    }
}

try {
    $connection = new PDO($dsn, $username, $password, $options);
    
    $sql = "SELECT * FROM Prize";
    
    $statement = $connection->prepare($sql);
    $statement->execute();
    
    $result = $statement->fetchAll();
} catch (PDOException $error) {
    echo $sql . "<br/>" . $error->getMessage();
}

?>

<?php require "../../templates/header.php"; ?>

<body>
	<h1>Delete Prize</h1>
	
	<?php if ($success) echo $success; ?>
	
	<table>
  		<thead>
    		<tr>
      			<th>Prize Name</th>
      			<th>Member #</th>
      			<th>Event Name</th>
      			<th>Event Date</th>
      			<th>Animal #</th>
    		</tr>
  		</thead>
  		<tbody>
  			<?php foreach ($result as $row) : ?>
  				<tr>
  					<td><?php echo escape($row["PrizeName"]); ?></td>
        			<td><?php echo escape($row["Member"]); ?></td>
        			<td><?php echo escape($row["EventName"]); ?></td>
        			<td><?php echo escape($row["EventDate"]); ?></td>
        			<td><?php echo escape($row["Animal"]); ?></td>
        			<td><a href="delete-prize.php?PrizeName=<?php echo escape($row["PrizeName"]); ?>
        										&EventName=<?php echo escape($row["EventName"]); ?>
        										&EventDate=<?php echo escape($row["EventDate"])?>">Delete</a></td>
        		</tr>
        	<?php endforeach; ?>
  		</tbody>
  	</table>
</body>

<a href="prizes.php">Back to Prizes</a>

<?php require '../../templates/footer.php'; ?>