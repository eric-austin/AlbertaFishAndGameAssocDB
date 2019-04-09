<?php

require "../config.php";
require "../common.php";

$MemNo = $_GET["MemNo"];

try {
    $connection = new PDO($dsn, $username, $password, $options);
    $sql = "SELECT FiringRange.* FROM MemberCard, FiringRange WHERE MemberCard.MemNo=:MemNo AND FiringRange.club=MemberCard.club";

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
	<h1>Firing Ranges Near Me</h1>

  <table>
      <thead>
        <tr>
            <th>Latitude</th>
            <th>Longitude</th>
						<th>Club</th>

        </tr>
      </thead>
      <tbody>
        <?php foreach ($result as $row) : ?>
          <tr>
            <td><?php echo escape($row["Latitude"]); ?></td>
              <td><?php echo escape($row["Longitude"]); ?></td>
              <td><?php echo escape($row["Club"]); ?></td>

          <?php endforeach; ?>
      </tbody>
    </table>
</body>
<?php echo '<a href="member-page.php?MemNo=' . $MemNo . '"><strong>Back to home</strong></a>'?>

<?php include "../templates/footer.php"; ?>
