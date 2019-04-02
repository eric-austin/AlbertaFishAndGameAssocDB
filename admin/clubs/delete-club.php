<?php 

/**
 * List all clubs with a link to delete
 */

require "../../config.php";
require "../../common.php";

if (isset($_GET["City"])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $City = $_GET["City"];
        
        $sql = "DELETE FROM Club WHERE City = :City";
        
        $statement = $connection->prepare($sql);
        $statement->bindValue(":City", $City);
        $statement->execute();
        
        $success = "Club successfully deleted.";
    } catch (PDOException $error) {
        echo $sql . "<br/>" . $error->getMessage();
    }
}

try {
    $connection = new PDO($dsn, $username, $password, $options);
    
    $sql = "SELECT * FROM Club";
    
    $statement = $connection->prepare($sql);
    $statement->execute();
    
    $result = $statement->fetchAll();
} catch (PDOException $error) {
    echo $sql . "<br/>" . $error->getMessage();
}

?>

<?php require "../../templates/header.php"; ?>

<body>
	<h1>Delete Club</h1>
	
	<?php if ($success) echo $success; ?>
	
	<table>
  		<thead>
    		<tr>
      			<th>City</th>
      			<th>Address</th>
      			<th># of Members</th>
    		</tr>
  		</thead>
  		<tbody>
  			<?php foreach ($result as $row) : ?>
  				<tr>
  					<td><?php echo escape($row["City"]); ?></td>
        			<td><?php echo escape($row["Address"]); ?></td>
        			<td><?php echo escape($row["NumMemb"]); ?></td>
        			<td><a href="delete-club.php?City=<?php echo escape($row["City"]); ?>">Delete</a></td>
        		</tr>
        	<?php endforeach; ?>
  		</tbody>
  	</table>
</body>

<a href="clubs.php">Back to Clubs</a>

<?php require '../../templates/footer.php'; ?>