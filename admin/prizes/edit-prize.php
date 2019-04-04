<?php

/**
  * List all prizes with a link to edit
  */

try {
  require "../../config.php";
  require "../../common.php";

  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT * FROM Prize";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>

<?php require "../../templates/header.php"; ?>

<body>
	<h1>Edit Prize</h1>
	
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
        			<td><a href="update-single.php?PrizeName=<?php echo escape($row["PrizeName"]); ?>
        										&EventName=<?php echo escape($row["EventName"]); ?>
        										&EventDate=<?php echo escape($row["EventDate"])?>">Edit</a></td>
        		</tr>
        	<?php endforeach; ?>
  		</tbody>
  	</table>
</body>

<a href="prizes.php">Back to Prizes</a>

<?php require '../../templates/footer.php'; ?>