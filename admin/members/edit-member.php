<?php

/**
  * List all members with a link to edit
  */

try {
  require "../../config.php";
  require "../../common.php";

  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT * FROM Member";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>

<?php require "../../templates/header.php"; ?>

<body>
	<h1>Edit Member</h1>
	
	<table>
  		<thead>
    		<tr>
      			<th>Member #</th>
      			<th>First Name</th>
      			<th>Last Name</th>
      			<th>Gender</th>
      			<th>Phone #</th>
      			<th>Email</th>
      			<th>Member Type</th>
    		</tr>
  		</thead>
  		<tbody>
  			<?php foreach ($result as $row) : ?>
  				<tr>
  					<td><?php echo escape($row["MemNo"]); ?></td>
        			<td><?php echo escape($row["FName"]); ?></td>
        			<td><?php echo escape($row["LName"]); ?></td>
        			<td><?php echo escape($row["Gender"]); ?></td>
        			<td><?php echo escape($row["Phone"]); ?></td>
        			<td><?php echo escape($row["Email"]); ?></td>
        			<td><?php echo escape($row["Type"]); ?></td>
        			<td><a href="update-single.php?MemNo=<?php echo escape($row["MemNo"]); ?>">Edit</a></td>
        		</tr>
        	<?php endforeach; ?>
  		</tbody>
  	</table>
</body>

<a href="members.php">Back to Members</a>

<?php require '../../templates/footer.php'; ?>