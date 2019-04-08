<?php 

/**
 * use an html form to create a new member
 * in the database
 */

if (isset($_POST['submit'])) {
    require "../../config.php";
    require "../../common.php";
    
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $new_member = array(
            "FName" => $_POST['FName'],
            "LName" => $_POST['LName'],
            "Gender" => $_POST["Gender"],
            "Phone" => $_POST["Phone"],
            "Email" => $_POST["Email"],
            "Type" => $_POST["Type"]
        );
        
        $sql = "INSERT INTO Member (FName, LName, Gender, Phone, Email, Type) 
                VALUES (:FName, :LName, :Gender, :Phone, :Email, :Type)";
        
        $statement = $connection->prepare($sql);
        $statement->execute($new_member);
    } catch(PDOException $error) {
        echo $sql . "<br/>" . $error->getMessage();
    }
}

?>

<?php include "../../templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
  <?php echo escape($_POST['FName']); ?> successfully added.
<?php } ?>

<body>
	<h1>Create Member</h1>

	<form method="post">
		<label for="FName">First Name</label>
		<br />
		<input type="text" name="FName" id="FName">
		<br />
		<label for="LName">Last Name</label>
		<br />
		<input type="text" name="LName" id="LName">
		<br />
		<label for="Gender">Gender</label>
		<br />		
		<input type="text" name="Gender" id="Gender">
		<br />
		<label for="Phone">Phone Num</label>
		<br />
		<input type="text" name="Phone" id="Phone">
		<br />
		<label for="Email">Email</label>
		<br />
		<input type="text" name="Email" id="Email">
		<br />
		<label for="Type">Member Type</label>
		<br />
		<input type="text" name="Type" id="Type">
		<br />
		<input type="submit" name="submit" value="Submit">
		<br />
	</form>
</body>

<a href="members.php">Back to Members</a>

<?php include "../../templates/footer.php"; ?>