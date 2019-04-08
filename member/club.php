<?php

/**
 * List all details about member's club
 */

require "../config.php";
require "../common.php";

try {
    $connection = new PDO($dsn, $username, $password, $options);
//not done    
    $sql = "SELECT * FROM Club";

    $statement = $connection->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll();
} catch (PDOException $error) {
    echo $sql . "<br/>" . $error->getMessage();
}

?>

<?php require "../templates/header.php"; ?>

<body>
	<h1>Club Details</h1>

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
        	<?php endforeach; ?>
  		</tbody>
  	</table>
</body>


<?php include "../templates/footer.php"; ?>
