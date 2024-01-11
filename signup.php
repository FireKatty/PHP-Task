<?php  

require "functions.php";

$errors = array();

if($_SERVER['REQUEST_METHOD'] == "POST")
{

	$errors = signup($_POST);

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
        .signup{
            margin-left: 30%;
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
   
	<title>Signup</title>
</head>
<body>
	<h1 class="signup">Signup</h1>

	
	<div>
		<div>
			<?php if(count($errors) > 0):?>
				<?php foreach ($errors as $error):?>
					<?= $error?> <br>	
				<?php endforeach;?>
			<?php endif;?>

		</div>
		<form class="signup" method="post">
			<input class="inputbox" type="text" name="username" placeholder="Username"><br>
			<input class="inputbox" type="email" name="email" placeholder="Email"><br>
			<input class="inputbox" type="password" name="password" placeholder="Password"><br>
			<input class="inputbox" type="password" name="password2" placeholder="Retype Password"><br>
            <input class="inputbox" type="number" name="number" placeholder="Mobile No."><br>
            <input class="inputbox" type="text" name="address" placeholder="Address"><br>
			<br>
			<button className="submitbutton"  type="submit">SignUp</button>
		</form>
	</div>
</body>
</html>