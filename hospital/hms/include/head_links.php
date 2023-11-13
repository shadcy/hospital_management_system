<?php
function generate_head_links($theme_code = "3", $short = false)
{

	$out = '<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="/vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="/vendor/fontawesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="/vendor/themify-icons/themify-icons.min.css">
        <link href="/vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="/vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="/vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">';

	if (!$short) {
		$out .= '<link href="/vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
			<link href="/vendor/select2/select2.min.css" rel="stylesheet" media="screen">
			<link href="/vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
			<link href="/vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">';
	}

	$out .= "<link rel=\"stylesheet\" href=\"/assets/css/styles.css\">
		<link rel=\"stylesheet\" href=\"/assets/css/plugins.css\">
		<link rel=\"stylesheet\" href=\"/assets/css/themes/theme-{$theme_code}.css\" id=\"skin_color\" />";

	return $out;
}
