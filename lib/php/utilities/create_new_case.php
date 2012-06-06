<?php //Creates a new case in database
session_start();
require('../auth/session_check.php');
require('../../../db.php');

function create_new_case_number($dbh)
{
	$m = CC_CASE_NUMBER_MASK;
	$error = "Error Creating Case Number: Please check your config";

	if (stristr($m, 'YYYY'))
	{
		$year = date('Y');
		$result = str_replace('YYYY', $year, $m);

		//get position of year in mask
		if (preg_match('/\b-YYYY-\b/', $m) > 0)
			{$pos = 'middle';}
		elseif (preg_match('/\bYYYY-\b/', $m) > 0)
			{$pos = 'beginning';}
		elseif (preg_match('/\b-YYYY\b/', $m) > 0)
			{$pos = 'end';}
		else
			{return $error;};
	}
	elseif (stristr($m, 'YY'))
	{
		$year = date('y');
		$result = str_replace('YY', $year, $m);

		//get position of year in mask
		if (preg_match('/\b-YY-\b/', $m) > 0)
			{$pos = 'middle';}
		elseif (preg_match('/\bYY-\b/', $m) > 0)
			{$pos = 'beginning';}
		elseif (preg_match('/\b-YY\b/', $m) > 0)
			{$pos = 'end';}
		else
			{return $error;}
	}
	else {return $error;}

	if (stristr($m, 'Number'))
	{
		//Set search value based on year position
		if ($pos === 'beginning')
			{$search = $year . '-%';}
		elseif ($pos === 'middle')
			{$search = '%-' . $year . '-%';}
		else
			{$search = '%-' . $year;}

		//check and see if a case has been opened already this year
		$q = $dbh->prepare("SELECT MAX(clinic_id) FROM cm WHERE  `clinic_id` LIKE  '$search'");
		$q->execute();
		$r = $q->fetch(PDO::FETCH_ASSOC);
		if (!$r['MAX(clinic_id)'])
		{
			$number = '00001';
		}
		else
		{
			$last_number = preg_match('/[0-9][0-9][0-9][0-9][0-9]/', $r['MAX(clinic_id)'],$matches);
			$n = $matches[0] + 1;
			$number = str_pad($n, 5,'0', STR_PAD_LEFT);
		}

		$result = str_replace('Number', $number, $result);

	}
	else {return $error;}

	//return preg_replace("/[^0-9-]/", "",$result); //strip out rest of mask (alpha characters) for now.
	return $result;
}

$new_case_number =  create_new_case_number($dbh);

$user = $_SESSION['login'];

//Check to see if user has permission to do this.
if (!$_SESSION['permissions']['add_cases'] == "1")
	{
		$response = array('error' => true,'message' => 'Sorry, you do not have permission to add cases.');
		echo json_encode($response);
	}

$q = $dbh->prepare("INSERT INTO `cm` (`id`, `clinic_id`,`organization`, `date_open`,`opened_by`) VALUES (NULL, ?, 'New Case', CURDATE(),?);");

$q->bindParam(1,$new_case_number);

$q->bindParam(2,$user);

$q->execute();

$error = $q->errorInfo();

if (!$error[1])
{
	$new_id = $dbh->lastInsertId();

	$response = array('error' => false,'newId' => $new_id);

	echo json_encode($response);
}