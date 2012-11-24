<?php

function load($page)

	{
		//white list of allowed include files
		$allowed_includes = array('home','cases','messages','login','logout','cases_item');

		//include file requested in URL
		$requested_include = $page;

		if (in_array($requested_include,$allowed_includes,true))

		{
			$include = "html/templates/" . $page . ".php";
			return $include;
		}

		else

		{return false;}


	}

?>
