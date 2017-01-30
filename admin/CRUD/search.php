<?php
include('../../inc/db_con.php');
 if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['logged_in']))
 {
     $message = "Nuk keni akses.";
     echo "<script type='text/javascript'>alert('$message');</script>" ;
      header("refresh:0 url=../index.php");
 }
 else if($_SESSION['mof'] == 0)
 {
      $message = "Nuk keni akses.";
     echo "<script type='text/javascript'>alert('$message');</script>" ;
      header("refresh:0 url=../index.php");
 }
     
 else{ 
     
     $term= null;
    if (!empty($_GET)) 
    {
        $term = $_GET['id'];
    }
    else{
    $term = $_POST['srch-term'];
    
    }
      ?>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="edentist.ico">
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
           <a class="navbar-brand" href= "../index.php?faqe=home" id="logo"></a> 
       </div>
	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
			
                       
		   <div class="collapse navbar-collapse" id="navbar-collapse">
                       
		   <ul class ="nav navbar-nav">
			
                       <li><a href="../index.php" class="hvr-underline-from-left" id="links"                 
                                 ><span      class="glyphicon glyphicon-home"></span></a></li>
                    <li><a href="../index.php" class="hvr-underline-from-left" id="active">TERMINET</a></li>
                           <li><a href="../?admin=vizita" class="hvr-underline-from-left"id="links">VIZITA </a></li>
                    <li><a href="../?admin=userat" class="hvr-underline-from-left" id="links">PERDORUESIT </a></li>
                     <li><a href="../?admin=keshillat" class="hvr-underline-from-left"id="links">KESHILLAT </a></li>
                    <li><a href="../?admin=sherbimet" class="hvr-underline-from-left" id="links">SHERBIMET</a></li>
                 </ul>
             </div>
        </div>
    </div>
<div class ="container" id="content" align="center">
     <div class="container">

            <div class="row">
                <h3>Rezultati i kerkimit</h3>
                <p>Fjala per kerkim: <?php echo $term;?></p>
                
          
            </div>
               
            <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Emri</th>
                      <th>Mbiemri</th>
                      <th>Data</th>
                      <th>Ora</th>
                      <th>E-Mail</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                  <?php
                  $selektimi = "SELECT u.user_id, u.name, u.surname, t.date, t.time, u.email, t.id_termini FROM user AS u INNER JOIN termini AS t ON u.user_id=t.id_users WHERE u.name LIKE '%".$term."%' OR u.surname LIKE '%".$term."%' OR u.username LIKE '%".$term."%' OR u.email LIKE '%".$term."%' OR t.time LIKE '%".$term."%' OR t.date LIKE '%".$term."%'  ORDER BY `t`.`date` ASC, t.time ASC";
                    		$result = mysql_query($selektimi) or die ('invalid query:'. mysql_error());
                                
                       if(mysql_num_rows($result)== 0){

            $message = "Nuk eshte gjetur asnje e dhene. Provoni perseri";
                        echo "<script type='text/javascript'>alert('$message');</script>";
                        header("refresh:0;url=../index.php");
        }
                else{
                       while($row = mysql_fetch_array($result))
		{
			
			list($user_id, $name, $surname,  $date, $time, $email, $termini_id )=$row;
			echo '  <tr>'; 
			echo '<td>'.$name.'</td>'; 
			echo '<td>'.$surname.'</td>'; 
			echo '<td>'.$date.'</td>'; 
			echo '<td>'.$time.'</td>'; 
			echo '<td>'.$email.'</td>'; 
                        echo '<td><a class="btn btn-default" href="read.php?id='.$termini_id.'" ><span class=" 	glyphicon glyphicon-th-list">&thinsp;</span>Lexo</a>';
                        echo ' ';
                        echo '<a class="btn btn-info   " href="update.php?id='.$termini_id.'" ><span class=" 	glyphicon glyphicon-pencil">&thinsp;</span>Ndrysho</a>';
                        echo ' ';
                        echo '<a class="btn btn-danger" href="delete.php?id='.$termini_id.'" ><span class=" 	glyphicon glyphicon-trash">&thinsp;</span>Fshije</a></td>';
			echo '  </tr>'; 
		}
                }
                  ?>
                  </tbody>
            </table>
            </div>
     </div>
        </div>
    </div> <!-- /container -->
    
 <?php }