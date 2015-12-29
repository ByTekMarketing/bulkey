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
    Elenco Report
  </div>
</div>




        <div class="row">

                   <div class="col-md-3">
                
                 <?php include("menu-sx.php"); ?>
                   
                      </div>
                      
                      

            <div class="col-md-9">

                <div class="row carousel-holder">

                    <div class="col-md-12">
                    <a href="svuota-report.php" class="btn btn-danger">Elimina Tutto</a>     <a href="index.php" class="btn btn-success">Crea Report</a><br>
                         



<?php
function dir_list($directory = FALSE) {
  $dirs= array();
  $files = array();
  if ($handle = opendir("./" . $directory))
  {
    while ($file = readdir($handle))
    {
      if (is_dir("./{$directory}/{$file}"))
      {
        if ($file != "." & $file != "..") $dirs[] = $file;
      }
      else
      {
        if ($file != "." & $file != "..") $files[] = $file;
      }
    }
  }
  closedir($handle);

  reset($dirs);
  sort($dirs);
  reset($dirs);

  reset($files);
  sort($files);
  reset($files);

  echo "<h3>Lista report creati</h3>\n<ul class='list-group'>";
  while(list($key, $value) = each($dirs))
  {
    $d++;
    echo "<li class='list-group-item'><a href=\"{$value}\">{$value}/</a>\n";
    
  }
  echo "</ul>\n";
  
  while(list($key, $value) = each($files))
  {
    $f++;
    echo "<li class='list-group-item'><a href=\"{$directory}{$value}\">{$value}</a>\n";
  }
  echo "</ul>\n";
  if (!$d) $d = "0";
  if (!$f) $f = "0";
  
}
dir_list("report/");
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