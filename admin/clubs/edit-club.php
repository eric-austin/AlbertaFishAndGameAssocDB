<?php

/**
  * List all clubs with a link to edit
  */

try {
  require "../../config.php";
  require "../../common.php";

  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT * FROM Club";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>

<?php require "../../templates/header.php"; ?>

<body>
	<h1>Edit Club</h1>
	
	<table>
  		<thead>
    		<tr>
      			<th>City</th>
      			<th>Address</th>
      			<th>Number of Members</th>
    		</tr>
  		</thead>
  		<tbody>
  			<?php foreach ($result as $row) : ?>
  				<tr>
  					<td><?php echo escape($row["City"]); ?></td>
        			<td><?php echo escape($row["Address"]); ?></td>
        			<td><?php echo escape($row["NumMemb"]); ?></td>
        			<td><a href="update-single.php?city=<?php echo escape($row["City"]); ?>">Edit</a></td>
        		</tr>
        	<?php endforeach; ?>
  		</tbody>
  	</table>
</body>

<a href="clubs.php">Back to Clubs</a>

<?php require '../../templates/footer.php'; ?>