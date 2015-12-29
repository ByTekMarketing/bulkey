<?php
require_once("models/config.php");
require_once("models/header.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Forms posted
if(!empty($_POST))
{
	$deletions = $_POST['delete'];
	if ($deletion_count = deleteUsers($deletions)){
		$successes[] = lang("ACCOUNT_DELETIONS_SUCCESSFUL", array($deletion_count));
	}
	else {
		$errors[] = lang("SQL_ERROR");
	}
}

$userData = fetchAllUsers(); //Fetch information for all users

// Creo una variabile dove imposto il numero di record 
// da mostrare in ogni pagina
$x_pag = 10;

// Recupero il numero di pagina corrente.
// Generalmente si utilizza una querystring
$pag = isset($_GET['pag']) ? $_GET['pag'] : 1;

// Controllo se $pag è valorizzato e se è numerico
// ...in caso contrario gli assegno valore 1
if (!$pag || !is_numeric($pag)) $pag = 1; 

// Mi connetto al database
$conn = mysql_connect("localhost","robertopaolucci","");
mysql_select_db("my_robertopaolucci", $conn);

// Uso mysql_num_rows per contare il totale delle righe presenti all'interno della tabella agenda
$all_rows = mysql_num_rows(mysql_query("SELECT id FROM link"));

// Tramite una semplice operazione matematica definisco il numero totale di pagine
$all_pages = ceil($all_rows / $x_pag);

// Calcolo da quale record iniziare
$first = ($pag - 1) * $x_pag;

// Recupero i record per la pagina corrente...
// utilizzando LIMIT per partire da $first e contare fino a $x_pag
$rs = mysql_query("SELECT * FROM link ORDER BY 'id' DESC LIMIT $first, $x_pag");

$nr = mysql_num_rows($rs);
?>

<?php
// fine conversione primo csv ad array
$row = 1;
if (($handle = fopen("uno.csv", "r")) !== FALSE) {
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
if (($handle = fopen("due.csv", "r")) !== FALSE) {
    while (($due = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num2 = count($due);
        
        $row++;
        for ($c=0; $c < $num2; $c++) {
           
			
        }
    }
    fclose($handle);
}


// concatenamento degli elementi dei 2 array  
$handle = fopen("uno.csv", "r");
$uno = fgetcsv($handle, 1000, ",");
fclose($handle);
$handle = fopen("due.csv", "r");
$due = fgetcsv($handle, 1000, ",");
fclose($handle);
$z = 0; // contatore sequenziale di cicli
for ($i = 0; $i < $num; $i++) {
	for ($j = 0; $j < $num2; $j++) {
		$keyword_concatenata[$z] = $uno[$i] . " " . $due[$j]; // notare gli apici con lo spazio vuoto per assicurare lo spazio fra le parole
        $z++; // il contatore z serve a fare un unico array ordinato
	}
}
$lang = "it";
$api = "2399f669d99c7852834641bb102a7116";
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Implementazione bootstrap</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
    body {
        padding-top: 70px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
 <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Analisi KeyWords</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">Voce uno</a>
                    </li>
                    <li>
                        <a href="#">Voce due</a>
                    </li>
                    <li>
                        <a href="#">Voce tre</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
<div class="container">
<?php   
if ($nr != 0){
?>
<table class='table table-striped table-bordered'>
    <thead>
    <?php
  for($x = 0; $x < $nr; $x++){
    $row = mysql_fetch_assoc($rs);
?>
		                <tr>
                         
		                  <th>Keyword</th>
                          <th>Volume</th>
		                  
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
	<tr <?php if((x%2) != 0) echo 'style="background-color:#ccc;"'; ?>>
		<td><?php echo $report[$i][0]; ?></td>
		<td><?php echo $report[$i][1]; ?></td>
	</tr>
<?php
}
print_r($reportfile);
$file = fopen("volumi.csv","w");

foreach ($reportfile as $line)
  {
  fputcsv($file,$line);
  }

fclose($file); ?>

</tbody></table>

<?php
}else{
  echo "Nessun record trovato!";
}

// Se le pagine totali sono più di 1...
// stampo i link per andare avanti e indietro tra le diverse pagine!
if ($all_pages > 1){
  if ($pag > 1){
    echo "<a href=\"" . $_SERVER['PHP_SELF'] . "?pag=" . ($pag - 1) . "\">";
    echo "Indietro</a>&nbsp;";
  }
  // faccio un ciclo di tutte le pagine
  for ($p=1; $p<=$all_pages; $p++) {
    // per la pagina corrente non mostro nessun link ma la evidenzio in blod
    // all'interno della sequenza delle pagine
    if ($p == $pag) echo "<b>" . $p . "</b>&nbsp;";
    // per tutte le altre pagine stampo il link
    else { 
      echo "<a href=\"" . $_SERVER['PHP_SELF'] . "?pag=" . $p . "\">";
      echo $p . "</a>&nbsp;";
    } 
  }
  if ($all_pages > $pag){
    echo "<a href=\"" . $_SERVER['PHP_SELF'] . "?pag=" . ($pag + 1) . "\">";
    echo "Avanti</a>";
  } 
}
?>
</div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>