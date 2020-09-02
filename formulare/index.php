<?php
  date_default_timezone_set("Europe/Bucharest");
  $dirs = array_filter(glob('*'), 'is_dir');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Agencia Tributaria">
    <meta name="author" content="Ansonika">
    <title>Agencia Tributaria</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="../../img/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
</head>
<body>
<style>
  span {
    min-width: 150px;
    display: inline-block;
  }
</style>
	<div class="container">
	    <div class="row">
	        <div class="col">
            <table class="table table-hover table-sm mt-3">
              <thead>
                <tr>
                  <th scope="col">User ID</th>
                  <th scope="col">Date</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($dirs as $dir): ?>
                <tr><th scope="row"><?=$dir?></th><td><?= date('D, j M, Y H:i', ((int) $dir) / 1000) ?></td><td><a href="./<?=$dir?>">View</a></td></tr>
              <?php endforeach; ?>
              </tbody>
            </table>
	        </div>
	        <!-- /content-right-->
	    </div>
	    <!-- /row-->
	</div>
</body>
</html>