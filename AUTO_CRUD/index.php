<?php


require('config.php');
$p = isset($_GET['p']) ? $_GET['p'] : '';

switch ( $p ) {	
  case 'generator':
    $data = array();
	$data['title'] = 'ADEL CI4 CRUD GENERATOR';
	$data['databases'] = $engine->getDatabases();
    $viewLoader->load_template('generator', $data);
    break;	
  default:
    $data = array();
	$data['title'] = 'ADEL CI4 CRUD GENERATOR';	
    $viewLoader->load_template('home', $data);
}
