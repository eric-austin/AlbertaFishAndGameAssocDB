<?php

/**
  * HTML form to search for eventss based
  * on given criteria
  */

require "../../config.php";
require "../../common.php";

if (isset($_GET["Name"])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $Name = $_GET["Name"];
        $Date = $_GET["Date"];
        
        $sql = "DELETE FROM Event WHERE Name = :Name AND Date = :Date";
        
        $statement = $connection->prepare($sql);
        $statement->bindValue(":Name", $Name);
        $statement->bindValue(":Date", $Date);
        $statement->execute();
        
        $success = "Event successfully deleted.";
    } catch (PDOException $error) {
        echo $sql . "<br/>" . $error->getMessage();
    }
}

if (isset($_POST["submit"])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $sql = "SELECT *
                FROM Event
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
        			<td><a href="update-single.php?Name=<?php echo escape($row["Name"]); ?>
        							&Date=<?php echo escape($row["Date"]); ?>">Edit</a></td>
        			<td><a href="search-event.php?Name=<?php echo escape($row["Name"]); ?>
        							&Date=<?php echo escape($row["Date"]); ?>">Delete</a></td>
        		</tr>
        	<?php endforeach; ?>
  		</tbody>
  	</table>
    
  <?php } else { ?>
    > No results found for <?php echo escape($_POST['City']); ?>.
  <?php }
} ?>

<?php if ($success) echo $success; ?>

	<h1>Search Events</h1>
	
	<form method="post">
		<label for="City">City</label>
		<input type="text" name="City" id="City">
		<input type="submit" name="submit" value="View Results">
	</form>
</body>

<a href="events.php">Back to Events</a>

<?php require '../../templates/footer.php'; ?>
