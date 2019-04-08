<?php

/**
 * List all members with a link to delete
 */

require "../../config.php";
require "../../common.php";

if (isset($_GET["MemNo"])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);

        $MemNo = $_GET["MemNo"];

        $sql = "DELETE FROM Member WHERE MemNo = :MemNo";

        $statement = $connection->prepare($sql);
        $statement->bindValue(":MemNo", $MemNo);
        $statement->execute();

        $success = "Member successfully deleted.";
    } catch (PDOException $error) {
        echo $sql . "<br/>" . $error->getMessage();
    }
}

try {
    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT * FROM Member";

    $statement = $connection->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll();
} catch (PDOException $error) {
    echo $sql . "<br/>" . $error->getMessage();
}

?>

<?php require "../../templates/header.php"; ?>

<body>
	<h1>Delete Member</h1>

	<?php if ($success) echo $success; ?>

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
        			<td><a href="delete-member.php?MemNo=<?php echo escape($row["MemNo"]); ?>">Delete</a></td>
        		</tr>
        	<?php endforeach; ?>
  		</tbody>
  	</table>
</body>

<a href="members.php">Back to Members</a>

<?php require '../../templates/footer.php'; ?>
