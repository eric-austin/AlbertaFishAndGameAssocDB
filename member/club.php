<?php

require "../config.php";
require "../common.php";

$MemNo = $_GET["MemNo"];

try {
    $connection = new PDO($dsn, $username, $password, $options);
    $sql = "SELECT Club.* FROM MemberCard, Club WHERE MemberCard.MemNo=:MemNo AND Club.city=MemberCard.club";

    $statement = $connection->prepare($sql);
    $statement->bindValue(":MemNo", $MemNo);
    $statement->execute();

    $result = $statement->fetchAll();
} catch (PDOException $error) {
    echo $sql . "<br/>" . $error->getMessage();
}
?>

<?php require "../templates/header.php";?>

<body>
	<h1>My Club Details</h1>

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
<?php echo '<a href="member-page.php?MemNo=' . $MemNo . '"><strong>Back to home</strong></a>'?>

<?php include "../templates/footer.php"; ?>
