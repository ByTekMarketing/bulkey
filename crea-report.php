<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
require_once("models/header.php");
?>

<?php
// fine conversione primo csv ad array
$row = 1;
if (($handle = fopen("csv/uno.csv", "r")) !== FALSE) {
    while (($uno = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($uno);
   
        $row++;
        for ($c=0; $c < $num; $c++) {
           
        }
    }
    fclose($handle);
}
// converto il secondo csv in un array inizio
$row = 1;
if (($handle = fopen("csv/due.csv", "r")) !== FALSE) {
    while (($due = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num2 = count($due);
        
        $row++;
        for ($c=0; $c < $num2; $c++) {
           
			
        }
    }
    fclose($handle);
}


// concatenamento degli elementi dei 2 array  
$handle = fopen("csv/uno.csv", "r");
$uno = fgetcsv($handle, 1000, ",");
fclose($handle);
$handle = fopen("csv/due.csv", "r");
$due = fgetcsv($handle, 1000, ",");
fclose($handle);
$z = 0; // contatore sequenziale di cicli
for ($i = 0; $i < $num; $i++) {
	for ($j = 0; $j < $num2; $j++) {
		$keyword_concatenata[$z] = $uno[$i] . " " . $due[$j]; // notare gli apici con lo spazio vuoto per assicurare lo spazio fra le parole
        $z++; // il contatore z serve a fare un unico array ordinato
	}
}

// Import in db
//$query = "INSERT INTO report (keyword) VALUES ($keyword_concatenata)";
//mysqli->query($query) or die("Errore nell'inserimento nella tabella report");

// imposto la lingua
$ling = fopen("lingua.txt", "r");
if(!$ling) die ("Errore nella operaione con il file");
$lingua = fread($ling, 10);


// imposto api key
$apicode = fopen("codice-api.txt", "r");
if(!$apicode) die ("Errore nella operaione con il file");
$codapi = fread($apicode, 100);



$lang = $lingua;

$api = $codapi;


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Crea report</title>

    <!-- File CSS per Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/shop-homepage.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
 
</head>

<body>

    <!-- menu di navigazione principale -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- codice gestione navigazione per smartphone e tablet -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Analisi Keyword</a>
            </div>
          
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <?php include("left-nav.php"); ?>
            </div>
            <!-- /.menu-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- contenuto pagina -->
    <div class="container">



<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Crea Report</h3>
  </div>
  <div class="panel-body">
    Da questa area puoi creare un nuovo report di analisi keywords
  </div>
</div>




        <div class="row">

                    <div class="col-md-3">
                
            <?php include("menu-sx.php"); ?>
                   
                      </div>
                      
                      

            <div class="col-md-9">

                <div class="row carousel-holder">

                    <div class="col-md-12">
                    
                    
                    <div class="alert alert-success" role="alert">
                    Report creato con successo 
                    
                    </div>
                    <a href="index.php" class="btn btn-success">Lista Report</a>
                    
                         <table class="table table-striped">
    <thead>
		                <tr>
                         
		                  <th>Keyword</th>
                          <th>Volume Traffico</th>
		                  
		                </tr>
		              </thead>
                      <tbody>

<?php
for ($i = 0; $i < $z; $i++) {
	$keyword = str_replace(' ', '+', $keyword_concatenata[$i]);
	//$call = 'http://api.semrush.com/?type=phrase_this&key=2399f669d99c7852834641bb102a7116&export_columns=Nq,Co,Nr&phrase=prova&database=it';
	$call = "http://api.semrush.com/?type=phrase_this&key=".$api."&export_columns=Nq,Co,Nr&phrase=". $keyword . "&database=" . $lang;
	$stringhe = preg_split( '/(\s|\n|;)/', file_get_contents($call));
	$report[$i][0] = $keyword;
	$report[$i][1] = $stringhe[7];
	$reportfile[$i] = array ($keyword,$stringhe[7]);
	?>
	<tr>
		<td><?php echo $report[$i][0]; ?></td>
		<td><?php echo $report[$i][1]; ?></td>
	</tr>
<?php
}

$dataora= date("F j, Y, g:i a", time());



$file = fopen("report/$dataora.csv","w");

foreach ($reportfile as $line)
  {
  fputcsv($file,$line);
  }

fclose($file); ?>

</tbody>

</table>      
 </div>

                </div>

                <div class="row">

                  
                </div>

            </div>

        </div>

    </div>
  
    <div class="container">

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; By Tek Marketing 2015</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>




</body>

</html>




        
                
                
               