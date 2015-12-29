<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/

if (!securePage($_SERVER['PHP_SELF'])){die();}

//Links for logged in user
if(isUserLoggedIn()) {
	echo "
	<p class='lead'>Gestione</p>
                <div class='list-group'>
	<a href='crea-report.php' class='list-group-item'><img src='immagini/icone/crea-report.png' width='25'>&nbsp;Crea Report</a>
	<a href='upload.php' class='list-group-item'><img src='immagini/icone/pagine.png' width='25'>&nbsp;Carica Csv</a>
	<a href='elenco-report.php' class='list-group-item'><img src='immagini/icone/download.png' width='25'>&nbsp;Download Report</a>
	<a href='impostazioni.php' class='list-group-item'><img src='immagini/icone/lingua-api.png' width='25'>&nbsp;Lingua e API</a>
	<a href='#' class='list-group-item'><img src='immagini/icone/assistenza.png' width='25'>&nbsp;Assistenza</a>
	</div>
	";
	
	//Links for permission level 2 (default admin)
	if ($loggedInUser->checkPermission(array(2))){
	echo "
	
	<p class='lead'>Amministrazione</p>
                <div class='list-group'>
	<a href='admin_configuration.php' class='list-group-item'><img src='immagini/icone/impostazioni.png' width='25'>&nbsp;Impostazioni</a>
	<a href='admin_users.php' class='list-group-item'><img src='immagini/icone/utenti.png' width='25'>&nbsp;Utenti</a>
	<a href='admin_permissions.php' class='list-group-item'><img src='immagini/icone/permessi.png' width='25'>&nbsp;Permessi</a>
	<a href='admin_pages.php' class='list-group-item'><img src='immagini/icone/pagine.png' width='25'>&nbsp;Pagine</a>
	</div>
	";
	}
} 
//Links for users not logged in
else {
	echo "
	<p class='lead'>Caratteristiche</p>
                <div class='list-group'>
	<a href='#' class='list-group-item'><img src='immagini/icone/pagine.png' width='25'>&nbsp;Analisi Keywords</a>
	<a href='#' class='list-group-item'><img src='immagini/icone/crea-csv.png' width='25'>&nbsp;Upload csv</a>
	<a href='#' class='list-group-item'><img src='immagini/icone/download.png' width='25'>&nbsp;Download Report</a>
	<a href='#' class='list-group-item'><img src='immagini/icone/assistenza.png' width='25'>&nbsp;Assistenza</a>
	</div>";
	
	echo "</ul>";
}

?>
