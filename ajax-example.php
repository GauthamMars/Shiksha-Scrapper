<!DOCTYPE html>
<html lang="en"><head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
     <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head 
         content must come *after* these tags -->
    <title>Shiksha Scraper</title>
        <!-- Bootstrap -->
     <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
	<link href="css/myStylesg.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap-social.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

    <?php

$dbhost = "localhost";
$dbuser = "gauthamm2015";
$dbpass ="3vXt73bGW7mEcGnI";
$dbname ="shikshaScrape1";
	
//Connect to MySQL Server
mysql_connect($dbhost, $dbuser, $dbpass);
	
//Select Database
mysql_select_db($dbname) or die(mysql_error());

	
//build query
$query = "SELECT * FROM  ScrapeDat ";

$query1="select name FROM ScrapeDat";
$qry_resul1 = mysql_query($query) or die(mysql_error());
$ctr=0;
$cnam1;
while($row = mysql_fetch_array($qry_resul1)){
 
  $cnam[$ctr]=$row;
  $ctr=$ctr+1;
    // echo $ctr;
}
foreach($cnam as $mnam)
{
  // echo $mnam[location]."<br>";
}
$mnam=$cnam[1];
//Execute query
$qry_result = mysql_query($query) or die(mysql_error());


?>
    <header class="jumbotron">

        <!-- Main component for a primary marketing message or call to action -->

        <div class="container">
            <div class="row row-header">
                <div class="col-xs-12 col-sm-8">
                    <h1>Shiksha Scraper </h1>
                    <h2><?php  echo "City:".$mnam[city]; ?> </h2>
                </div>
               
            </div>
        </div>
    </header>
<body >
    <div class="container">
	 <div class="row">
       <div class="col-xs-12 col-sm-10">
	
  <div class="panel-group" id="accordion"
                      role="tablist" aria-multiselectable="true">
<?php
foreach($cnam as $mnam)
{
?>


<div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="<?php $mnam[id];  ?>">
                            <h3 class="panel-title">
                                <a role="button" data-toggle="collapse"
                                     data-parent="#accordion" href="#<?php $mnam[name];  ?>"
                                    >
                                    <?php echo $mnam[name];   ?></a>
                            </h3>
                        </div>
                        <div role="tabpanel" class="panel-collapse collapse in"
                             id="<?php $mnam[name];  ?>"    aria-labelledby="<?php $mnam[id];  ?>">
                            <div class="panel-body">
                                 <p>
       <?php
    echo "location  : ".$mnam[location]."<br>";
    echo "reviews   : ".$mnam[reviews]."<br>";
    echo "facilities: ".$mnam[facilities]."<br>";
    ?>
    </p>
                 </div>
</div>
</div>


 
<?php   }
?>
</div>
</div>
</div>
</div>
</body>
<footer class="row-footer">
        <div class="container">
            <div class="row">             
                <div class="col-xs-5 col-xs-offset-1 col-sm-2 col-sm-offset-1">
                    <h5>Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="https://ide50-gauthamm2015.cs50.io/index.html">Home</a></li>
                        
                    </ul>
                </div>
                
            </div>
        </div>
    </footer>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>