<?php

	$birth_arr = array();
	$death_arr = array();
	
	$birth_arr[0] = 1901;
	$death_arr[0] = 1973;

	$birth_arr[1] = 1923;
	$death_arr[1] = 1985;

	$birth_arr[2] = 1910;
	$death_arr[2] = 1988;

	$birth_arr[3] = 1952;
	$death_arr[3] = 1983;

	$birth_arr[4] = 1940;
	$death_arr[4] = 1991;

	$birth_arr[5] = 1973;
	$death_arr[5] = 1999;

	// Clear the counting array
	$yr_arr = array();
	
	for ($i = 0; $i <= 100; $i++)
	{
		$yr_arr[$i] = 0;
	}

	// Find out how many people we have dates for
	$arr_size = count($birth_arr);
	
	// Loop through the birth and death dates
	for ($j = 0; $j < $arr_size; $j++)
	{
		$start = ($birth_arr[$j] - 1900);
		$end = ($death_arr[$j] - 1900);
		
		// Increment the years that are covered by the
		// current person's birth and death
		for ($k = $start; $k <= $end; $k++)
		{
			$yr_arr[$k] = ($yr_arr[$k] + 1);
		}
	}
	
	// Find the first highest year
	$top_count = 0;
	$top_year = 0;
	
	for ($m = 0; $m <= 100; $m++)
	{
		if ($yr_arr[$m] > $top_count)
		{
			$top_count = $yr_arr[$m];
			$top_year = $m + 1900;
		}
	}

	print ("Year most people were alive: $top_year");
	
?>
