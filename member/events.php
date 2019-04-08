<?php

/**
 * List all events in the same city as member
 */

require "../config.php";
require "../common.php";

try {
    $connection = new PDO($dsn, $username, $password, $options);
//not done
    $sql = "SELECT * FROM Event";

    $statement = $connection->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll();
} catch (PDOException $error) {
    echo $sql . "<br/>" . $error->getMessage();
}

?>

<?php require "../templates/header.php"; ?>

<body>
	<h1>Events</h1>

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
        	<?php endforeach; ?>
  		</tbody>
  	</table>
</body>


<?php include "../templates/footer.php"; ?>
