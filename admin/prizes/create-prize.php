<?php 

/**
 * use an html form to create a new prize
 * in the database
 */

if (isset($_POST['submit'])) {
    require "../../config.php";
    require "../../common.php";
    
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $new_prize = array(
            "PrizeName" => $_POST['PrizeName'],
            "Member" => $_POST['Member'],
            "EventName" => $_POST["EventName"],
            "EventDate" => $_POST["EventDate"],
            "Animal" => $_POST["Animal"]
        );
        
        $sql = "INSERT INTO Prize (PrizeName, Member, EventName, EventDate, Animal) 
                VALUES (:PrizeName, :Member, :EventName, :EventDate, :Animal)";
        
        $statement = $connection->prepare($sql);
        $statement->execute($new_prize);
    } catch(PDOException $error) {
        echo $sql . "<br/>" . $error->getMessage();
    }
}

?>

<?php include "../../templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
  <?php echo escape($_POST['PrizeName']); ?> successfully added.
<?php } ?>

<body>
	<h1>Create Prize</h1>
	
	<form method="post">
		<label for="PrizeName">Prize Name</label>
		<br />
		<input type="text" name="PrizeName" id="PrizeName">
		<br />
		<label for="Member">Member #</label>
		<br />
		<input type="number" name="Member" id="Member">
		<br />
		<label for="EventName">Event Name</label>
		<br />
		<input type="text" name="EventName" id="EventName">
		<br />
		<label for="EventDate">Event Date</label>
		<br />
		<input type="date" name="EventDate" id="EventDate">
		<br />
		<label for="Animal">Animal Tag #</label>
		<br />
		<input type="number" name="Animal" id="Animal">
		<br />
		<input type="submit" name="submit" value="Submit">
	</form>
</body>

<a href="prizes.php">Back to Prizes</a>

<?php include "../../templates/footer.php"; ?>