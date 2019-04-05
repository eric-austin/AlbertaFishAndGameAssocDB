<?php
   define('DB_SERVER', 'localhost:3306');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_DATABASE', 'afga');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   session_start();
   
   if(isset($_POST['login_btn'])) {
      // username and password sent from form 
      
      $myusername = ($_POST['username']);
      $mypassword = ($_POST['password']); 
      
      $sql = "SELECT * FROM login WHERE username = '$myusername' and password = '$mypassword'";
	  $result = mysqli_query($db,$sql);
	  $row_cnt = mysqli_num_rows($result);
	  
	  if($row_cnt == 1){  
		  $role = mysqli_fetch_array($result);
		  if($role['role'] == 'member') {
			  header('location: ../member/member-page.php');
		  }
		  if($role['role'] == 'admin'){
			  header('location: ../admin/admin-page.php');
		  }else{
			  $error = "Your Login Name or Password is invalid";
		  }
      }
   }
?>

<?php include "../templates/header.php"; ?>	

<body>
	<div class="header">
		<h2>Login</h2>
	</div>
	<form method="post" action="login.php">

		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" >
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="login_btn">Login</button>
		</div>
	</form>
</body>

<?php include "../templates/header.php"; ?>	