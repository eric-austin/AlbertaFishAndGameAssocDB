<?php 

/**
 * use an html form to create a new animal
 * in the database
 */

if (isset($_POST['submit'])) {
    require "../../config.php";
    require "../../common.php";
    
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $new_animal = array(
            "TagNo" => $_POST['TagNo'],
            "Weight" => $_POST['Weight'],
            "Species" => $_POST["Species"],
            "Gender" => $_POST["Gender"],
            "Type" => $_POST["Type"],
            "Hunter" => $_POST["Hunter"],
            "WeaponUsed" => $_POST["WeaponUsed"]
        );
        
        $sql = "INSERT INTO Animal (TagNo, Weight, Species, Gender, Type, Hunter, WeaponUsed) 
                VALUES (:TagNo, :Weight, :Species, :Gender, :Type, :Hunter, :WeaponUsed)";
        
        $statement = $connection->prepare($sql);
        $statement->execute($new_animal);
    } catch(PDOException $error) {
        echo $sql . "<br/>" . $error->getMessage();
    }
}

?>

<?php include "../../templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
  <?php echo escape($_POST['TagNo']); ?> successfully added.
<?php } ?>

<body>
	<h1>Create Animal</h1>
	
	<form method="post">
		<label for="TagNo">Tag Number</label>
		<input type="number" name="TagNo" id="TagNo">
		<label for="Weight">Weight</label>
		<input type="number" name="Weight" id="Weight">
		<label for="Species">Species</label>
		<input type="text" name="Species" id="Species">
		<label for="Gender">Gender</label>
		<input type="text" name="Gender" id="Gender">
		<label for="Type">Type</label>
		<input type="text" name="Type" id="Type">
		<label for="Hunter">Hunter #</label>
		<input type="number" name="Hunter" id="Hunter">
		<label for="WeaponUsed">Weapon Used</label>
		<input type="text" name="WeaponUsed" id="WeaponUsed">
		<input type="submit" name="submit" value="Submit">
	</form>
</body>

<a href="animals.php">Back to Animals</a>

<?php include "../../templates/footer.php"; ?>