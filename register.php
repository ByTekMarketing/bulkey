<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Prevent the user visiting the logged in page if he/she is already logged in
if(isUserLoggedIn()) { header("Location: account.php"); die(); }

//Forms posted
if(!empty($_POST))
{
	$errors = array();
	$email = trim($_POST["email"]);
	$username = trim($_POST["username"]);
	$displayname = trim($_POST["displayname"]);
	$password = trim($_POST["password"]);
	$confirm_pass = trim($_POST["passwordc"]);
	$captcha = md5($_POST["captcha"]);
	
	
	if ($captcha != $_SESSION['captcha'])
	{
		$errors[] = lang("CAPTCHA_FAIL");
	}
	if(minMaxRange(5,25,$username))
	{
		$errors[] = lang("ACCOUNT_USER_CHAR_LIMIT",array(5,25));
	}
	if(!ctype_alnum($username)){
		$errors[] = lang("ACCOUNT_USER_INVALID_CHARACTERS");
	}
	if(minMaxRange(5,25,$displayname))
	{
		$errors[] = lang("ACCOUNT_DISPLAY_CHAR_LIMIT",array(5,25));
	}
	if(!ctype_alnum($displayname)){
		$errors[] = lang("ACCOUNT_DISPLAY_INVALID_CHARACTERS");
	}
	if(minMaxRange(8,50,$password) && minMaxRange(8,50,$confirm_pass))
	{
		$errors[] = lang("ACCOUNT_PASS_CHAR_LIMIT",array(8,50));
	}
	else if($password != $confirm_pass)
	{
		$errors[] = lang("ACCOUNT_PASS_MISMATCH");
	}
	if(!isValidEmail($email))
	{
		$errors[] = lang("ACCOUNT_INVALID_EMAIL");
	}
	//End data validation
	if(count($errors) == 0)
	{	
		//Construct a user object
		$user = new User($username,$displayname,$password,$email);
		
		//Checking this flag tells us whether there were any errors such as possible data duplication occured
		if(!$user->status)
		{
			if($user->username_taken) $errors[] = lang("ACCOUNT_USERNAME_IN_USE",array($username));
			if($user->displayname_taken) $errors[] = lang("ACCOUNT_DISPLAYNAME_IN_USE",array($displayname));
			if($user->email_taken) 	  $errors[] = lang("ACCOUNT_EMAIL_IN_USE",array($email));		
		}
		else
		{
			//Attempt to add the user to the database, carry out finishing  tasks like emailing the user (if required)
			if(!$user->userCakeAddUser())
			{
				if($user->mail_failure) $errors[] = lang("MAIL_ERROR");
				if($user->sql_failure)  $errors[] = lang("SQL_ERROR");
			}
		}
	}
	if(count($errors) == 0) {
		$successes[] = $user->success;
	}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Amministrazione Pagine</title>

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
                    
                    <!-- inizio modulo registrazione -->
                    
                    <?php echo resultBlock($errors,$successes); ?>
                    
                 <form class='form-horizontal' name='newUser' action=''.$_SERVER['PHP_SELF'].'' method='post'>
<fieldset>

<!-- Form Name -->
<legend>Crea Account</legend>

<!-- Text input-->
<div class='form-group'>
  <label class='col-md-4 control-label' for='User name'>user name</label>  
  <div class='col-md-4'>
  <input id='User name' type='text' name='username' placeholder='user name' class='form-control input-md'>
    
  </div>
</div>

<!-- Text input-->
<div class='form-group'>
  <label class='col-md-4 control-label' for='Nome visualizzato'>nome visualizzato</label>  
  <div class='col-md-4'>
  <input id='Nome visualizzato' type='text' name='displayname' placeholder='nome visualizzato' class='form-control input-md'>
    
  </div>
</div>

<!-- Password input-->
<div class='form-group'>
  <label class='col-md-4 control-label' for='password'>Password</label>
  <div class='col-md-4'>
    <input id='password' type='password' name='password' placeholder='password' class='form-control input-md'>
    
  </div>
</div>

<!-- Password input-->
<div class='form-group'>
  <label class='col-md-4 control-label' for='password'>Conferma</label>
  <div class='col-md-4'>
    <input id='password' type='password' name='passwordc' placeholder='re-inserisci la password' class='form-control input-md'>
    
  </div>
</div>

<!-- Text input-->
<div class='form-group'>
  <label class='col-md-4 control-label' for='Email'>Email</label>  
  <div class='col-md-4'>
  <input id='Email' type='text' name='email' placeholder='la tua email' class='form-control input-md'>
    
  </div>
</div>

<!-- antispam immagine-->
<div class='form-group'>
  <label class='col-md-4 control-label' for='Email'>Antispam</label>  
  <div class='col-md-4'>
  <img src='models/captcha.php'>
    
  </div>
</div>

<!-- antispam campo testo-->
<div class='form-group'>
  <label class='col-md-4 control-label' for='Email'>Verifica</label>  
  <div class='col-md-4'>
  
   <input id='captcha' name='captcha' type='text' placeholder='digita codice sopra riportato' class='form-control input-md'>
  
    
  </div>
</div>

<!-- Button (Double) -->
<div class='form-group'>
  <label class='col-md-4 control-label' for='button1id'></label>
  <div class='col-md-8'>
    <button id='button1id' name='button1id' type='submit' class='btn btn-success'>Registrati</button>
    
  </div>
</div>

</fieldset>
</form>


                    
                    <!-- fine modulo registrazione -->
                         
        


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