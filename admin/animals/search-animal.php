<?php

/**
  * HTML form to search for members based
  * on given criteria
  */

require "../../config.php";
require "../../common.php";

if (isset($_GET["TagNo"])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $TagNo = $_GET["TagNo"];
        
        $sql = "DELETE FROM Animal WHERE TagNo = :TagNo";
        
        $statement = $connection->prepare($sql);
        $statement->bindValue(":TagNo", $TagNo);
        $statement->execute();
        
        $success = "Animal successfully deleted.";
    } catch (PDOException $error) {
        echo $sql . "<br/>" . $error->getMessage();
    }
}

if (isset($_POST["submit"])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $sql = "SELECT *
                FROM Animal
                WHERE Species = :Species";
        
        $Species = $_POST["Species"];
        
        $statement = $connection->prepare($sql);
        $statement->bindParam(":Species", $Species, PDO::PARAM_STR);
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
        			<td><a href="search-animal.php?TagNo=<?php echo escape($row["TagNo"]); ?>">Delete</a></td>
        		</tr>
        	<?php endforeach; ?>
  		</tbody>
  	</table>
    
  <?php } else { ?>
    > No results found for <?php echo escape($_POST['Species']); ?>.
  <?php }
} ?>

<?php if ($success) echo $success; ?>

	<h1>Search Animals</h1>
	
	<form method="post">
		<label for="Species">Species</label>
		<input type="text" name="Species" id="Species">
		<input type="submit" name="submit" value="View Results">
	</form>
</body>

<a href="animals.php">Back to Animals</a>

<?php require '../../templates/footer.php'; ?>
