
<?php 

/**
 * use an html form to login
 * 
 */



if (isset($_POST['submit'])) {
    require "config.php";
    require "common.php";
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        $sql = "SELECT *
                FROM Login
                WHERE username = :username AND password = :password";
        
        $statement = $connection->prepare($sql);
        $statement->bindValue(":username", $username);
        $statement->bindValue(":password", $password);
        $statement->execute();
        
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        
        if($result["MemberID"] > 0) {
            if($result["role"] == "admin") {
                header("Location: ./admin/admin-page.php");
                exit;
            } else {
                $MemNo = escape($result["MemberID"]);
                header("Location: ./member/member-page.php?MemNo=" . $MemNo);
                exit;
            }
        } else {
            $failure = "Invalid username or password.";
        }
    } catch (PDOException $error) {
        echo $sql . "<br/>" . $error->getMessage();
    }
    
}

?>


<?php include "templates/header.php" ?>



<body>
	<h1>Login</h1>
	
	<?php if ($failure) echo $failure?>
	
	<form method="post">
		Username: <br /><input type="text" name="username" id="username"/><br />
		Password: <br /><input type="text" name="password" id="password"/><br />
		<input type="submit" name="submit" value="Submit"> 
	</form>
</body>

<?php include "templates/footer.php" ?>