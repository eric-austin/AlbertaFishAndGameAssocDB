<?php

require "../config.php";
require "../common.php";

$MemNo = $_GET["MemNo"];

try {
    $connection = new PDO($dsn, $username, $password, $options);
    $sql = "SELECT Event.* FROM MemberCard, Event WHERE MemberCard.MemNo=:MemNo AND Event.club=MemberCard.club";

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
	<h1>Events Near Me</h1>

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
<?php echo '<a href="member-page.php?MemNo=' . $MemNo . '"><strong>Back to home</strong></a>'?>

<?php include "../templates/footer.php"; ?>
