<?php

/**
  * Use an HTML form to edit an entry in the
  * member table.
  *
  */

require "../../config.php";
require "../../common.php";

if (isset($_POST["submit"])){
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $Member = ["MemNo" => $_POST["MemNo"],
                   "FName" => $_POST["FName"],
                   "LName" => $_POST["LName"],
                   "Gender" => $_POST["Gender"],
                   "Phone" => $_POST["Phone"],
                   "Email" => $_POST["Email"],
                   "Type" => $_POST["Type"]];
        
        $sql = "UPDATE Member
                SET FName = :FName, LName = :LName, Gender = :Gender,
                    Phone = :Phone, Email = :Email, Type = :Type
                WHERE MemNo = :MemNo";
        
        $statement = $connection->prepare($sql);
        $statement->execute($Member);

        $success = "Member updated successfully.";
    } catch (PDOException $error) {
        echo $error->getMessage();
    }
}

if (isset($_GET['MemNo'])) {
  try {
      $connection = new PDO($dsn, $username, $password, $options);
      $MemNo = $_GET["MemNo"];
      
      $sql = "SELECT * FROM Member WHERE MemNo = :MemNo";
      $statement = $connection->prepare($sql);
      $statement->bindValue(":MemNo", $MemNo);
      $statement->execute();
      
      $Member = $statement->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $error) {
      echo $sql . "<br/>" . $error->getMessage();
  }
} else {
    echo "Something went wrong!";
    exit;
}
?>

<?php include "../../templates/header.php"; ?>

<body>
	<h1>Edit a Member</h1>
	
	<?php if ($success) echo $success; ?>
	
	<form method="post">
		<label for="MemNo">Member #</label>
		<input type="number" name="MemNo" id="MemNo" value="<?php echo escape($Member["MemNo"])?>" readonly>
		<label for="FName">First Name</label>
		<input type="text" name="FName" id="FName" value="<?php echo escape($Member["FName"])?>">
		<label for="LName">Last Name</label>
		<input type="text" name="LName" id="LName" value="<?php echo escape($Member["LName"])?>">
		<label for="Gender">Gender</label>
		<input type="text" name="Gender" id="Gender" value="<?php echo escape($Member["Gender"])?>">
		<label for="Phone">Phone #</label>
		<input type="text" name="Phone" id="Phone" value="<?php echo escape($Member["Phone"])?>">
		<label for="Email">Email</label>
		<input type="text" name="Email" id="Email" value="<?php echo escape($Member["Email"])?>">
		<label for="Type">Member Type</label>
		<input type="text" name="Type" id="Type" value="<?php echo escape($Member["Type"])?>">
		<input type="submit" name="submit" value="Submit">
	</form>
</body>

<a href="edit-member.php">Back to Edit Members</a>

<?php include "../../tempates/footer.php"; ?>