<?php

/**
  * HTML form to search for members based
  * on given criteria
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

if (isset($_POST["submit"])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $sql = "SELECT *
                FROM Member
                WHERE LName = :LName";
        
        $LName = $_POST["LName"];
        
        $statement = $connection->prepare($sql);
        $statement->bindParam(":LName", $LName, PDO::PARAM_STR);
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
        			<td><a href="update-single.php?MemNo=<?php echo escape($row["MemNo"]); ?>">Edit</a></td>
        			<td><a href="search-member.php?MemNo=<?php echo escape($row["MemNo"]); ?>">Delete</a></td>
        		</tr>
        	<?php endforeach; ?>
  		</tbody>
  	</table>
    
  <?php } else { ?>
    > No results found for <?php echo escape($_POST['LName']); ?>.
  <?php }
} ?>

<?php if ($success) echo $success; ?>

	<h1>Search Members</h1>
	
	<form method="post">
		<label for="LName">Last Name</label>
		<input type="text" name="LName" id="LName">
		<input type="submit" name="submit" value="View Results">
	</form>
</body>

<a href="members.php">Back to Members</a>

<?php require '../../templates/footer.php'; ?>
