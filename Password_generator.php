<?php
error_reporting(0);

function myrandom_char($string)
{
	$ind = random_int(0,strlen($string));
	return $string[$ind];
}

function myrandom_string($length, $char_set)
{
	$output = "";
	for($i=0; $i < $length; $i++){
		$output .= myrandom_char($char_set);
	}
	return $output;
}

function generate_password($options)
{
	$lower = "abcdefghijklmnopqrstuvwxyz";
	$upper = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$numbers = "0123456789";
	$symbols = "~!@#$%^&*()-_=+[]\{}|;':";

	$use_lower=isset($options["lower"]) ? "1" : "0";
	$use_upper=isset($options["upper"]) ? "1" : "0";
	$use_numbers=isset($options["numbers"]) ? "1" : "0";
	$use_symbols=isset($options["symbols"]) ? "1" : "0";

	$chars = "";
	if($use_lower == "1"){ $chars .= $lower; }
	if($use_upper == "1"){ $chars .= $upper; }
	if($use_numbers == "1"){ $chars .= $numbers; }
	if($use_symbols == "1"){ $chars .= $symbols; }

	$length = isset($options["length"]) ? $options["length"] : 8;
	return myrandom_string($length, $chars);
}

$options = array(
	'length' => $_GET["length"],
	'lower' => $_GET["lower"],
	'upper' => $_GET["upper"],
	'numbers' => $_GET["numbers"],
	'symbols' => $_GET["symbols"]
);
$password = generate_password($options);

?> 
<!-- we can also use PHP range()

// $lower = implode(range('a', 'z'));
// $upper = implode(range('A', 'Z'));
// $numbers = implode(range(0, 9));
// $symbols = "$*?!-@";

// $chars = $lower . $upper . $numbers . $symbols;
// echo $chars;
 -->

 <!DOCTYPE html>
 <html>
 <head>
 	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
 	<title>Password Generator</title>
 	<style>
 		body{
 			margin: 100px;
		  background-image: url("bg.png");
		  height: 100%; 
		  background-repeat: no-repeat;
		  background-size: cover;
		  color: white;
 		}
 		.center{
 			font-size: 25px;
 			opacity: 0.9;
 		}

 	</style>
 </head>
 <body>
 	<div class="center">
	 	<p>Generated Password <div style="color: #20c997;"><?php echo $password; ?></div></p>
	 	<form action="" method="get">
	 		Length
	 		<div class="input-group input-group-sm mb-3" style=" width: 35%;">
		 			 <input type="text" class="form-control" name="length" value="<?php if(isset($_GET["length"])) { echo $_GET['length']; } ?>">
				</div> 
	 		<input type="checkbox" name="lower" value="1" <?php if($_GET["lower"] == "1"){ echo 'checked'; } ?> /> Lowercase<br/>
	 		<input type="checkbox" name="upper" value="1" <?php if($_GET["upper"] == "1"){ echo 'checked'; } ?> /> Uppercase<br/>
	 		<input type="checkbox" name="numbers" value="1" <?php if($_GET["numbers"] == "1"){ echo 'checked'; } ?> /> Numbers<br/>
	 		<input type="checkbox" name="symbols" value="1" <?php if($_GET["symbols"] == "1"){ echo 'checked'; } ?> /> Symbols<br/><br/>
	 		<button type="submit" class="btn btn-success">Submit</button>
	 	</form>
 	</div>
 </body>
 </html>