<?php

require "../config.php";
require "../common.php";

$MemNo = $_GET["MemNo"];

try {
    $connection = new PDO($dsn, $username, $password, $options);
    $sql = "SELECT Newsletter.* FROM Newsletter, SubscribesTo WHERE SubscribesTo.MemNo=:MemNo AND SubscribesTo.IssueNo=Newsletter.IssueNo";

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
	<h1>My Newsletter Subscriptions</h1>

  <table>
      <thead>
        <tr>
            <th>Issue Number</th>
            <th># of Subscribers</th>

        </tr>
      </thead>
      <tbody>
        <?php foreach ($result as $row) : ?>
          <tr>
            <td><?php echo escape($row["IssueNo"]); ?></td>
              <td><?php echo escape($row["NumOfSubs"]); ?></td>

          <?php endforeach; ?>
      </tbody>
    </table>
</body>

<?php include "../templates/footer.php"; ?>
