<?php

/**
  * HTML form to search for clubs based
  * on given criteria
  */

require "../../config.php";
require "../../common.php";

if (isset($_GET["City"])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $City = $_GET["City"];
        
        $sql = "DELETE FROM Club WHERE City = :City";
        
        $statement = $connection->prepare($sql);
        $statement->bindValue(":City", $City);
        $statement->execute();
        
        $success = "Club successfully deleted.";
    } catch (PDOException $error) {
        echo $sql . "<br/>" . $error->getMessage();
    }
}

if (isset($_POST["submit"])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $sql = "SELECT *
                FROM Club
                WHERE City = :City";
        
        $City = $_POST["City"];
        
        $statement = $connection->prepare($sql);
        $statement->bindParam(":City", $City, PDO::PARAM_STR);
        $statement->execute();
        
        $result = $statement->fetchAll();
    } catch (PDOException $error) {
        echo $sql . "<br/>" . $error->getMessage();
    }
}

?>

<?php require "../../templates/header.php"; ?>

<body>

<?php
if (isset($_POST['submit'])) {
  if ($result && $statement->rowCount() > 0) { ?>
    <h2>Results</h2>

    <table>
      <thead>
			<tr>
				<th>City</th>
				<th>Address</th>
				<th># of Members</th>
			</tr>
		</thead>
      <tbody>
  		<?php foreach ($result as $row) { ?>
			<tr>
				<td><?php echo escape($row["City"]); ?></td>
				<td><?php echo escape($row["Address"]); ?></td>
				<td><?php echo escape($row["NumMemb"]); ?></td>
				<td><a href="update-single.php?City=<?php echo escape($row["City"]); ?>">Edit</a></td>
				<td><a href="search-club.php?City=<?php echo escape($row["City"]); ?>">Delete</a></td>
			</tr>
			<?php } ?>
      </tbody>
  </table>
  <?php } else { ?>
    > No results found for <?php echo escape($_POST['City']); ?>.
  <?php }
} ?>

<?php if ($success) echo $success; ?>

	<h1>Search Clubs</h1>
	
	<form method="post">
		<label for="City">City</label>
		<input type="text" name="City" id="City">
		<input type="submit" name="submit" value="View Results">
	</form>
</body>

<a href="clubs.php">Back to Clubs</a>

<?php require '../../templates/footer.php'; ?>
