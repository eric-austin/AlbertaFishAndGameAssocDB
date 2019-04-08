<?php

require "../config.php";
require "../common.php";

try {
    $connection = new PDO($dsn, $username, $password, $options);
    $MemNo = $_GET["MemNo"];
    $sql = "SELECT member.* FROM member, login WHERE :MemNo=Member.MemNo";


    $statement = $connection->prepare($sql);
    $statement->bindValue(":MemNo", $MemNo);
    $statement->execute();

    $result = $statement->fetchAll();
} catch (PDOException $error) {
    echo $sql . "<br/>" . $error->getMessage();
}

?>

<?php require "../templates/header.php"; ?>

<body>
	<h1>Membership Details</h1>

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
        		</tr>
        	<?php endforeach; ?>
  		</tbody>
  	</table>
</body>

<?php include "../templates/footer.php"; ?>
