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
	$username = sanitize(trim($_POST["username"]));
	$password = trim($_POST["password"]);
	
	//Perform some validation
	//Feel free to edit / change as required
	if($username == "")
	{
		$errors[] = lang("ACCOUNT_SPECIFY_USERNAME");
	}
	if($password == "")
	{
		$errors[] = lang("ACCOUNT_SPECIFY_PASSWORD");
	}

	if(count($errors) == 0)
	{
		//A security note here, never tell the user which credential was incorrect
		if(!usernameExists($username))
		{
			$errors[] = lang("ACCOUNT_USER_OR_PASS_INVALID");
		}
		else
		{
			$userdetails = fetchUserDetails($username);
			//See if the user's account is activated
			if($userdetails["active"]==0)
			{
				$errors[] = lang("ACCOUNT_INACTIVE");
			}
			else
			{
				//Hash the password and use the salt from the database to compare the password.
				$entered_pass = generateHash($password,$userdetails["password"]);
				
				if($entered_pass != $userdetails["password"])
				{
					//Again, we know the password is at fault here, but lets not give away the combination incase of someone bruteforcing
					$errors[] = lang("ACCOUNT_USER_OR_PASS_INVALID");
				}
				else
				{
					//Passwords match! we're good to go'
					
					//Construct a new logged in user object
					//Transfer some db data to the session object
					$loggedInUser = new loggedInUser();
					$loggedInUser->email = $userdetails["email"];
					$loggedInUser->user_id = $userdetails["id"];
					$loggedInUser->hash_pw = $userdetails["password"];
					$loggedInUser->title = $userdetails["title"];
					$loggedInUser->displayname = $userdetails["display_name"];
					$loggedInUser->username = $userdetails["user_name"];
					
					//Update last sign in
					$loggedInUser->updateLastSignIn();
					$_SESSION["userCakeUser"] = $loggedInUser;
					
					//Redirect to user account page
					header("Location: account.php");
					die();
				}
			}
		}
	}
}

require_once("models/header.php");
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
                    
                    
                    
                    <!-- inizio modulo -->
                     <?php echo resultBlock($errors,$successes); ?>
                     
                    <form class='form-horizontal'  action=''.$_SERVER['PHP_SELF'].'' method='post'> 
                    
                    
<fieldset>

<!-- Form Name -->
<legend>Login</legend>

<!-- Text input-->
<div class='form-group'>
  <label class='col-md-4 control-label' for='textinput'>Nome Utente</label>  
  <div class='col-md-4'>
  <input id='textinput' type='text' name='username' placeholder='il tuo user name' class='form-control input-md'>
    
  </div>
</div>

<!-- Password input-->
<div class='form-group'>
  <label class='col-md-4 control-label' for='password'>Password</label>
  <div class='col-md-4'>
    <input id='password' type='password' name='password' placeholder='inserire password' class='form-control input-md'>
    
  </div>
</div>

<!-- Button (Double) -->
<div class='form-group'>
  <label class='col-md-4 control-label' for='button1id'></label>
  <div class='col-md-8'>
    <button id='button1id' name='button1id' class='btn btn-success'>Login</button>
    <a href="register.php" id='Registrati' name='Registrati' class='btn btn-primary'>Registrati</a>
  </div>
</div>

</fieldset>
</form>


                    
                    <!-- fine modulo -->
            


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