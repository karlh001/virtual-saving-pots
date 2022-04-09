<?php // connect to the database
include("php/cnx.php");
?>

<!DOCTYPE html>

<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">

<link rel="icon" type="image/x-icon" href="img/icon.png">

<title>Virtual Saving Pots</title>

<!--JQuery-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!--Bootstrap-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>

<!--Icofont-->
<link rel="stylesheet" href="plugins/icofont/icofont.min.css">

<!--Plug-ins-->
<script src="plugins/jquery/inputMeter.js"></script>
<script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="plugins/moneymask/src/jquery.maskMoney.js" type="text/javascript"></script>


</head>

<body>


<style>

	th { font-size: 20px; }
	td { font-size: 20px; }

</style>


	<nav class="navbar navbar-expand-lg navbar-light bg-light">
 
      <a class="navbar-brand" href="accounts.php"><i class="icofont-money-bag"></i> Virtual Saving Pots</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

    </nav>
    
    
     <main role="main" class="container" style="padding-top:10px;">
