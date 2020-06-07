<?php 

// for reading file where words are stored. our filename goes into function parameter
function  read_dictionary($filename="")
{
	// can use full path or relative path
	$dictionary_file = "{$filename}";

	return file($dictionary_file, FILE_IGNORE_NEW_LINES |FILE_SKIP_EMPTY_LINES);
}

function pick_random($array)
{
	$ind = random_int(0, count($array)-1);
	return $array[$ind];
}

function pick_random_symbol()
{
	$symbols = "$*?!-@#&^()";
	$ind = random_int(0, strlen($symbols)-1);
	return $symbols[$ind];
}

function pick_random_numbers($digits=1)  // if no digit is passed so default set to 1 digit
{
	$min = pow(10, ($digits-1)); //e.g. 1000
	$max = pow(10, $digits) - 1; //e.g. 9999
	return strval(random_int($min, $max));
}
 
 // selecting only that words that matches our length
function filter_words_by_length($array, $length)
{
	$selected_words = array();
	foreach($array as $word)
	{
		if(strlen($word) == $length)
		{
			$selected_words[] = $word;
		}
	}
	return $selected_words;
}

function pick_random_word($words, $length)
{
	$selected_words = filter_words_by_length($words, $length);
	return pick_random($selected_words);
}

$basic_words = read_dictionary("friendly_words.txt");
$brand_words = read_dictionary("brand_words.txt");

$words = array_merge($brand_words, $basic_words);

$length = 12;
$word_count = 2;
$digit_count = 2;
$symbol_count = 1;
$avg_wlength = ($length - $digit_count -$symbol_count) / $word_count;

$password="";

$next_wlength = random_int($avg_wlength -1, $avg_wlength +1);

$password  .= pick_random_word($words, $next_wlength);
$password  .= pick_random_symbol();
$password  .= pick_random_numbers($digit_count);
$next_wlength = $length - strlen($password);
$password  .= pick_random_word($words, $next_wlength);

echo "Friendly password: " . $password . "<br/>";
echo "Length: " . strlen($password) . "<br/>";
?>