<?php 
error_reporting(0);
function detect_any_uppercase($string)
{
	return strtolower($string) != $string;
}

function detect_any_lowercase($string)
{
	return strtoupper($string) != $string;
}

function count_numbers($string)
{
	return preg_match_all("/[0-9]/", $string);
}

function count_symbols($string)
{
	$regex = "/[" . preg_quote("~!@#$%^&*()-_=+[]\{}|;':") . "]/";
	return preg_match_all($regex, $string);
}

function password_strength($password)
{
	$strength = 0;
	$possible_points = 12;
	$length = strlen($password);

	if(detect_any_uppercase($password))
	{
		$strength+= 1;
	}
	if(detect_any_lowercase($password))
	{
		$strength+= 1;
	}

	$strength += min(count_numbers($password), 2);
	$strength += min(count_symbols($password), 2); 

	if($length >= 8)
	{
		$strength += 2;
		$strength += min(($length -8) * 0.5, 4);
	}

	$strength_percent = $strength / (float)$possible_points;
	$rating = floor($strength_percent * 10);
	return $rating;
}

$password = $_POST['rate'];
$rating = password_strength($password);

?>
<!DOCTYPE html>
 <html>
 <head>
 	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
 	<title>Password Strength Meter</title>
 	<style>
 		body{
 			margin: 100px;
		  background-image: url("bg.png");
		  height: 100%; 
		  background-repeat: no-repeat;
		  background-size: cover;
		  color: white;
 		}
 		#meter div {
 			height: 30px; width: 30px;
 			margin: 0 1px 0 0; padding 0;
 			float: left; background-color: #DDDDDD;
 		}
 		#meter div.rating-1, #meter div.rating-2 {
 			background-color: green;
 		}
 		#meter div.rating-3, #meter div.rating-4 {
 			background-color: blue;
 		}
 		#meter div.rating-5, #meter div.rating-6 {
 			background-color: yellow;
 		}
 		#meter div.rating-7, #meter div.rating-8 {
 			background-color: orange;
 		}
 		#meter div.rating-9, #meter div.rating-10 {
 			background-color: red;
 		}
 		.center{
 			font-size: 30px;
 			opacity: 0.9;
 		}
 	</style>
 </head>
 <body>
 	<div class="center">
	 	<p>Your password rating is <div style="margin-left: 130px;"><?php echo $rating; ?></div></p>

	 	<div id="meter">
	 		<?php 
	 		for($i=0; $i<10; $i++)
	 		{
	 			echo "<div"; 
	 			if($rating > $i)
	 			{
	 				echo " class=\"rating-{$rating}\" ";
	 			}
	 			echo"></div>";
	 		}
	 		?>
	 	</div>
	 <br style="clear: both;"/>

	 	<p>Rate the strength of your password</p>
	 	<form action="" method="POST">
	 		Password 
	 		<div class="input-group input-group-sm mb-3" style=" width: 35%;">
	 			 <input type="text" class="form-control" name="rate">
			</div>
	 		<button type="submit" class="btn btn-success">Submit</button>
	 	</form>
 </div>
 </body>
 </html>