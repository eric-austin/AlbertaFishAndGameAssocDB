<?php

/**
  * HTML form to search for eventss based
  * on given criteria
  */

require "../../config.php";
require "../../common.php";

if (isset($_GET["IncNo"])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $Number = $_GET["IncNo"];
        $Date = $_GET["Date"];
        
        $sql = "SELECT * FROM Incidents WHERE IncNo = :IncNo AND Date = :Date";
        
        $statement = $connection->prepare($sql);
        $statement->bindValue(":IncNo", $Name);
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
                FROM Incidents
                WHERE Club = :Club";
        
        $Club = $_POST["Club"];
        
        $statement = $connection->prepare($sql);
        $statement->bindParam(":Club", $Club, PDO::PARAM_STR);
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
      			<th>Incident Number</th>
      			<th>Date</th>
      			<th>Reporter Name</th>
      			<th>Club</th>
				<th>Emergency Flag</th>
				<th>Violation Flag</th>
				<th>Other Flag</th>
    		</tr>
  		</thead>
  		<tbody>
  			<?php foreach ($result as $row) : ?>
  				<tr>
  					<td><?php echo escape($row["IncNo"]); ?></td>
        			<td><?php echo escape($row["Date"]); ?></td>
        			<td><?php echo escape($row["RName"]); ?></td>
        			<td><?php echo escape($row["EFlag"]); ?></td>
					<td><?php echo escape($row["VFlag"]); ?></td>
					<td><?php echo escape($row["OFlag"]); ?></td>
        			<td><?php echo escape($row["Club"]); ?></td>
        			<td><a href="update-single.php?Name=<?php echo escape($row["IncNo"]); ?>
        							&Date=<?php echo escape($row["Date"]); ?>">Edit</a></td>
        			<td><a href="search-report.php?Name=<?php echo escape($row["IncNo"]); ?>
        							&Date=<?php echo escape($row["Date"]); ?>">Delete</a></td>
        		</tr>
        	<?php endforeach; ?>
  		</tbody>
  	</table>
    
  <?php } else { ?>
    > No results found for <?php echo escape($_POST['Club']); ?>.
  <?php }
} ?>

<?php if ($success) echo $success; ?>

	<h1>Search Reports</h1>
	
	<form method="post">
		<label for="Club">Club</label>
		<input type="text" name="Club" id="Club">
		<input type="submit" name="submit" value="View Results">
	</form>
</body>

<a href="reports.php">Back to Reports</a>

<?php require '../../templates/footer.php'; ?>
