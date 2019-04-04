<?php

/**
  * List all animalss with a link to edit
  */

try {
  require "../../config.php";
  require "../../common.php";

  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT * FROM Animal";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>

<?php require "../../templates/header.php"; ?>

<body>
	<h1>Edit Animal</h1>
	
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
        			<td><a href="update-single.php?TagNo=<?php echo escape($row["TagNo"]); ?>">Edit</a></td>
        		</tr>
        	<?php endforeach; ?>
  		</tbody>
  	</table>
</body>

<a href="animals.php">Back to Animals</a>

<?php require '../../templates/footer.php'; ?>