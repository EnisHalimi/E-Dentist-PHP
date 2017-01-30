<?php 
   include ('../../inc/db_con.php');
    if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['logged_in']))
 {
     $message = "Nuk keni akses.";
     echo "<script type='text/javascript'>alert('$message');</script>" ;
      header("refresh:0 url=../../?faqe=home");
 }
 else if($_SESSION['mof'] == 0)
 {
      $message = "Nuk keni akses.";
     echo "<script type='text/javascript'>alert('$message');</script>" ;
      header("refresh:0 url=../../?faqe=home");
 }
     
 else{ 
?> 
<style>

    label{float:left;} 
</style>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../edentist.ico">
	<link rel="stylesheet" type="text/css" href="../../css/mystyle.css">
	<link rel="stylesheet" type="text/css" href="../../css/hover.css">  
 

    <title>E-Dentist</title>
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
      <script type="text/javascript" src="../../js/jquery.jSlider.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/script.js"></script>
     <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>   
    </head>
    <body>
    <div class = "navbar navbar-inverse navbar-fixed-top" id="header" >
      <div class = "container">
       <div class="navbar-header">
           <a class="navbar-brand" href= "../../index.php?faqe=home" id="logo"></a> 
       </div>
	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
			
                       
		   <div class="collapse navbar-collapse" id="navbar-collapse">
                       
		   <ul class ="nav navbar-nav">
			
                       <li><a href="../../index.php" class="hvr-underline-from-left" id="links"                 
                                 ><span      class="glyphicon glyphicon-home"></span></a></li>
                    <li><a href="../?admin=terminet" class="hvr-underline-from-left" id="links">TERMINI</a></li>
                    <li><a href="../?admin=vizita" class="hvr-underline-from-left"id="active">VIZITA </a></li>
                     <li><a href="../?admin=diagnoza" class="hvr-underline-from-left"id="links">DIAGNOZA </a></li>
                    <li><a href="../?admin=userat" class="hvr-underline-from-left" id="links">PERDORUESI</a></li>
                     <li><a href="../?admin=keshillat" class="hvr-underline-from-left"id="links">KESHILLA </a></li>
                    <li><a href="../?admin=sherbimet" class="hvr-underline-from-left" id="links">SHERBIMI</a></li>
                 </ul>
             </div>
        </div>
    </div>
    <div class ="container" id="content" align="center">
<div class="span10 offset1">
                    <div class="row">
                        <h3>Krijimi i Vizites</h3>
                    </div>
             
    <div class="col-sm-6">
        
    <form id="vizita_form" method="POST" action = "vizita_insert.php" onsubmit="return validateVizitaForm();" >

      <div class="form-group">
           <label class="required">Termini:</label>
      <?php

    $query = "SELECT id_termini, date, time, name, surname, username FROM `termini` AS t INNER JOIN user AS u ON t.id_users=u.user_id ORDER BY `t`.`date` ASC, t.time ASC  ";
    $result = mysql_query ($query);
    echo "<select value='' class='form-control' id='termin_id' name='termin_id'><option>Termini</option>";
    while($r = mysql_fetch_array($result)) {
        
    echo "<option value=". $r['id_termini']."> ".$r['date']."  |  ".$r['time']."  |  ".$r['name']."  |  ".$r['surname']." (".$r['username'].")</option>"; 
    }
        echo "</select>";
    ?>
       <span id="termini_validation" class="error"></span>
      </div>
      <div class="form-group">
      <label class="required"  for="date">Verejtje:</label>
      <textarea  id="verejtje" name="verejtje"  class="form-control"></textarea>
       <span id="verejtje_validation" class="error"></span>
     
     
    </div>
    <button type="submit" value="Submit" form ="vizita_form"class="btn btn-success"><span class="glyphicon glyphicon-ok">&thinsp;</span>Krijo</button>
     <button type="reset" value="Reset" form ="vizita_form" class="btn btn-warning" ><span class="glyphicon glyphicon-remove">&thinsp;</span>Fshije</button>
    <a class="btn btn-default" href="../?admin=vizita"><span class="glyphicon glyphicon-chevron-left">&thinsp;</span>Kthehu</a>
  </form>
                </div>
 <div class="col-sm-6">
      <span><br></span>
      
      
          <ul class="list-group">
  <li class="list-group-item"> <p>Zgjedheni terminin te cilit doni qe te i shtoni viziten nese pacienti ka ardhur ne terminin te cilin ai e ka caktuar. </p></li>
  <li class="list-group-item"> <p>Shkruani ndonje verejtje te cilen e ka pasur pacienti pasi e ka perfunduar viziten e tij.</p> </li> 
</ul>
       
                </div>
                </div>
    </div>
    </body>
 <?php }
               
