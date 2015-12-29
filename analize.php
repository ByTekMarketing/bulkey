<?php 
/**
 * SETTING INIZIALE
 */
// Ignora la chiusura della connessione con il client
ignore_user_abort(true);
// Tempo illimitato
ini_set('max_execution_time', 0);
// Misuro il tempo
$time_start = microtime(true);

// Start e Numero di Key analizzate per volta
$start = 0;
$averange = 500;

// Count the number of rows in report table
$number_of_keywords = mysqli->query("SELECT COUNT (*)")
$number_of_steps = (int)$number_of_keywords / 500

// NB: essedo un int non metto <= e gli faccio fare (al più) un cliclo a vuoto
for($j = 0; $j < $number_of_steps, $j++){

	// Get keywords
	$query = "SELECT keyword FROM utenti_report WHERE id LIMIT $start, $averange"
	$keywords = mysqli->query($query);

	foreach ($keywords as $keyword) {
		$i = 0;
		
		$keyword = str_replace(' ', '+', $keyword);
		//$call = 'http://api.semrush.com/?type=phrase_this&key=2399f669d99c7852834641bb102a7116&export_columns=Nq,Co,Nr&phrase=prova&database=it';
		
		$call = "http://api.semrush.com/?type=phrase_this&key=". $api ."&export_columns=Nq,Co,Nr&phrase=". $keyword . "&database=" . $lang;
		$stringhe = preg_split( '/(\s|\n|;)/', file_get_contents($call)); //preg è molto lento. Meglio usare le funzioni base di php
		
		$report[$i][0] = $keyword;
		$report[$i][1] = $stringhe[7];
		
		$reportfile[$i] = array ($keyword,$stringhe[7]);
	}

	// Insert in db

	$start += $averange;
}