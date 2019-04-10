<?php

/**
  * HTML form to search for prizess based
  * on given criteria
  */

require "../../config.php";
require "../../common.php";

if (isset($_GET["PrizeName"])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $PrizeName = $_GET["PrizeName"];
        $EventName = $_GET["EventName"];
        $EventDate = $_GET["EventDate"];
        
        $sql = "DELETE FROM Prize
                WHERE PrizeName = :PrizeName AND EventName = :EventName
                        AND EventDate = :EventDate";
        
        $statement = $connection->prepare($sql);
        $statement->bindValue(":PrizeName", $PrizeName);
        $statement->bindValue(":EventName", $EventName);
        $statement->bindValue(":EventDate", $EventDate);
        $statement->execute();
        
        $success = "Prize successfully deleted.";
    } catch (PDOException $error) {
        echo $sql . "<br/>" . $error->getMessage();
    }
}

if (isset($_POST["submit"])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $sql = "SELECT *
                FROM Prize
                WHERE EventName = :EventName";
        
        $EventName = $_POST["EventName"];
        
        $statement = $connection->prepare($sql);
        $statement->bindParam(":EventName", $EventName, PDO::PARAM_STR);
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
      			<th>Prize Name</th>
      			<th>Member #</th>
      			<th>Event Name</th>
      			<th>Event Date</th>
      			<th>Animal #</th>
    		</tr>
  		</thead>
  		<tbody>
  			<?php foreach ($result as $row) : ?>
  				<tr>
  					<td><?php echo escape($row["PrizeName"]); ?></td>
        			<td><?php echo escape($row["Member"]); ?></td>
        			<td><?php echo escape($row["EventName"]); ?></td>
        			<td><?php echo escape($row["EventDate"]); ?></td>
        			<td><?php echo escape($row["Animal"]); ?></td>
        			<td><a href="update-single.php?PrizeName=<?php echo escape($row["PrizeName"]); ?>
        										&EventName=<?php echo escape($row["EventName"]); ?>
        										&EventDate=<?php echo escape($row["EventDate"])?>">Edit</a></td>
        			<td><a href="search-prize.php?PrizeName=<?php echo escape($row["PrizeName"]); ?>
        										&EventName=<?php echo escape($row["EventName"]); ?>
        										&EventDate=<?php echo escape($row["EventDate"])?>">Delete</a></td>
        		</tr>
        	<?php endforeach; ?>
  		</tbody>
  	</table>
    
  <?php } else { ?>
    > No results found for <?php echo escape($_POST['EventName']); ?>.
  <?php }
} ?>

<?php if ($success) echo $success; ?>

	<h1>Search Prizes</h1>
	
	<form method="post">
		<label for="EventName">Event Name</label>
		<input type="text" name="EventName" id="EventName">
		<input type="submit" name="submit" value="View Results">
	</form>
</body>

<a href="prizes.php">Back to Prizes</a>

<?php require '../../templates/footer.php'; ?>
