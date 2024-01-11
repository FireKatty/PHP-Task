<?php  

require "functions.php";

$errors = array();

if($_SERVER['REQUEST_METHOD'] == "POST")
{

	$errors = login($_POST);

	if(count($errors) == 0)
	{
		header("Location: home.php");
		die;
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<style>
		.login{
			margin-left: 30%;
			margin-top: 10%;
		}
		.inputbox{
            display: block;
            margin: 15px;
            padding: 7px;
            width: 300px;
            border: 3px solid skyblue;
        }

		.submitbutton{
			margin: 25px;
			padding: 10px;
			width: 150px;
			border: 1px solid;
			background-color: skyblue;
			cursor: pointer;

		}


	</style>
	<title>Login</title>
</head>
<body>
	<h1 class="login">Login</h1>
	<div>
		<div>
			<?php if(count($errors) > 0):?>
				<?php foreach ($errors as $error):?>
					<?= $error?> <br>	
				<?php endforeach;?>
			<?php endif;?>

		</div>
		<form class="login" method="post">
			<input class="inputbox" type="email" name="email" placeholder="Email"><br>
			<input class="inputbox" type="password" name="password" placeholder="Password"><br>
			<br>
			<button className="submitbutton" type="submit">Login</button>

			<div>
              <p class="mb-0">Don't have an account? <a href="signup.php" class="text-white-50 fw-bold">Sign Up</a>
              </p>
            </div>


		</form>
	</div>
</body>
</html>