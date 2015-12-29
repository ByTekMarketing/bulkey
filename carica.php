<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Analisi Keywords</title>

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
                <ul class="nav navbar-nav">
                
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="impostazioni.html">Amministrazione</a>
                    </li>
                    <li>
                        <a href="supporto.php">Supporto</a>
                    </li>
                </ul>
            </div>
            <!-- /.menu-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- contenuto pagina -->
    <div class="container">



<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Gestione</h3>
  </div>
  <div class="panel-body">
    Upload file csv per analisi
  </div>
</div>




        <div class="row">

                    <div class="col-md-3">
                
                 <?php include("menu-sx.php"); ?>
                   
                      </div>
                      
                      

            <div class="col-md-9">

                <div class="row carousel-holder">

                    <div class="col-md-12">
                         

<?php
// per prima cosa verifico che il file sia stato effettivamente caricato
if (!isset($_FILES['primo']) || !is_uploaded_file($_FILES['primo']['tmp_name'])) {
  echo 'Non hai inviato nessun file...';
  exit;    
}




//percorso della cartella dove mettere i file caricati dagli utenti
$uploaddir = 'csv/';



//Recupero il percorso temporaneo del file
$userfile_tmp = $_FILES['primo']['tmp_name'];

//recupero il nome originale del file caricato
$userfile_name = $_FILES['primo']['name'];

//rinomino il file in uno.csv
$userfile_name = "uno.csv";

// imposto le estensioni ammesse
$ext_ok = array('csv');
$temp = explode('.', $_FILES['primo']['name']);
$ext = end($temp);
if (!in_array($ext, $ext_ok)) {
  echo 'il primo file non ha un estensione non ammessa!';
  exit;
}

//copio il file dalla sua posizione temporanea alla mia cartella upload
if (move_uploaded_file($userfile_tmp, $uploaddir . $userfile_name)) {

  //Se operazione è andata a buon fine...
  echo 'primo file inviato';
}else{
  //Se l'operazione è fallta...
  echo 'Upload primo file NON valido!'; 

}



?>


<?php
// per prima cosa verifico che il file sia stato effettivamente caricato
if (!isset($_FILES['secondo']) || !is_uploaded_file($_FILES['secondo']['tmp_name'])) {
  echo 'Non hai inviato nessun file...';
  exit;    
}




//percorso della cartella dove mettere i file caricati dagli utenti
$uploaddir = 'csv/';



//Recupero il percorso temporaneo del file
$userfile_tmp = $_FILES['secondo']['tmp_name'];

//recupero il nome originale del file caricato
$userfile_name = $_FILES['secondo']['name'];

//rinomino il file in uno.csv
$userfile_name = "due.csv";

// imposto le estensioni ammesse
$ext_ok = array('csv');
$temp = explode('.', $_FILES['secondo']['name']);
$ext = end($temp);
if (!in_array($ext, $ext_ok)) {
  echo 'Il secondo file ha un estensione non ammessa!';
  exit;
}

//copio il file dalla sua posizione temporanea alla mia cartella upload
if (move_uploaded_file($userfile_tmp, $uploaddir . $userfile_name)) {

  //Se l'operazione è andata a buon fine...
  echo '   secondo file inviato con successo';
}else{
  //Se l'operazione è fallta...
  echo 'Upload NON valido!'; 

}

?>



  </div>                    
                        
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
               