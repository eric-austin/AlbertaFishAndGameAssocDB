<?php

/**
  * List all eventss with a link to edit
  */

try {
  require "../../config.php";
  require "../../common.php";

  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT * FROM Event";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>

<?php require "../../templates/header.php"; ?>

<body>
	<h1>Edit Event</h1>
	
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
        			<td><a href="update-single.php?Name=<?php echo escape($row["Name"]); ?>
        							&Date=<?php echo escape($row["Date"]); ?>">Edit</a></td>
        		</tr>
        	<?php endforeach; ?>
  		</tbody>
  	</table>
</body>

<a href="events.php">Back to Events</a>

<?php require '../../templates/footer.php'; ?>