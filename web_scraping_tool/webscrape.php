<?php
//declare what we are looking for 
set_time_limit(0);
$parenLeft = "(";
$six = "6";
$zero="0";
$one = "1";
$parenRight = ")";
$count = 0;

	$view = file_get_contents("http://www.bing.com/search?q=celectrician+hattiesburg+ms");

//echo $view;



	$split = str_split($view);
//run an array with the variables through the str split array to find all the (601) in the array
for($i = 0; $i < count($split); $i++) {
	if($split[$i] == $parenLeft){
		$j = $i + 1;
		if($split[$j] == $six){
			$k = $j + 1;
			if($split[$k] == $zero){
				$l = $k + 1;
				if($split[$l] == $one){
					$m = $l + 1;
					if($split[$m] == $parenRight) {
						$count += 1;
					}
				}
			}
		}
		
	}
}
//if found a (601) -> count 1 
echo $count;

?>
