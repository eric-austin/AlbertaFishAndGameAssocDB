<?php 

/**
 * List all members with a link to delete
 */

require "../../config.php";
require "../../common.php";

if (isset($_GET["TagNo"])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $TagNo = $_GET["TagNo"];
        
        $sql = "DELETE FROM Animal WHERE TagNo = :TagNo";
        
        $statement = $connection->prepare($sql);
        $statement->bindValue(":TagNo", $TagNo);
        $statement->execute();
        
        $success = "Animal successfully deleted.";
    } catch (PDOException $error) {
        echo $sql . "<br/>" . $error->getMessage();
    }
}

try {
    $connection = new PDO($dsn, $username, $password, $options);
    
    $sql = "SELECT * FROM Animal";
    
    $statement = $connection->prepare($sql);
    $statement->execute();
    
    $result = $statement->fetchAll();
} catch (PDOException $error) {
    echo $sql . "<br/>" . $error->getMessage();
}

?>

<?php require "../../templates/header.php"; ?>

<body>
	<h1>Delete Animal</h1>
	
	<?php if ($success) echo $success; ?>
	
	<table>
  		<thead>
    		<tr>
      			<th>Tag #</th>
      			<th>Weight</th>
      			<th>Species</th>
      			<th>Gender</th>
      			<th>Type</th>
      			<th>Hunter #</th>
      			<th>Weapon Used</th>
    		</tr>
  		</thead>
  		<tbody>
  			<?php foreach ($result as $row) : ?>
  				<tr>
  					<td><?php echo escape($row["TagNo"]); ?></td>
        			<td><?php echo escape($row["Weight"]); ?></td>
        			<td><?php echo escape($row["Species"]); ?></td>
        			<td><?php echo escape($row["Gender"]); ?></td>
        			<td><?php echo escape($row["Type"]); ?></td>
        			<td><?php echo escape($row["Hunter"]); ?></td>
        			<td><?php echo escape($row["WeaponUsed"]); ?></td>
        			<td><a href="delete-animal.php?TagNo=<?php echo escape($row["TagNo"]); ?>">Delete</a></td>
        		</tr>
        	<?php endforeach; ?>
  		</tbody>
  	</table>
 
</body>

<a href="animals.php">Back to Animals</a>

<?php require '../../templates/footer.php'; ?>