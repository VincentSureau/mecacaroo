<?php
/**
** activation theme
**/
function theme_enqueue_styles() {
 wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
/*
* Add bootstrap to a template
*/
function add_bootstrap(){
    wp_register_style( 'Bootstrap_CSS', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' );
    wp_enqueue_style('Bootstrap_CSS');
    
    wp_enqueue_script('Jquery', 'https://code.jquery.com/jquery-3.2.1.slim.min.js', array(), null, true);
    wp_enqueue_script('Popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', array(), null, true);
    wp_enqueue_script('Bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', array(), null, true);
    
    add_action( 'wp_enqueue_scripts', 'wp_add_bootstrap' );
}
/*
* Get connexion to the car database
*/
function getPDO(){
    return new PDO('mysql:host=localhost:3306;dbname=mecacarro_voitures', 'mecacarro', 'Ogame91180*');
}
/*
* return the list of the brands in the database ordered by name
*/
function getBrands() {

    $pdo = getPDO();
    
    $sql = 'SELECT DISTINCT
            `rappel_marque` AS marque,
            `image`
            FROM `vehicules`
            ORDER BY marque ASC
    ';
    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement->execute();
    $results = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

    return $results;
}
/*
*return the list of every model for a brand
*/
function getModels(){
	if(!isset($_GET['marque']) || empty($_GET['marque'])){
		return;
	}
	
	$marque = filter_var($_GET['marque'], FILTER_SANITIZE_STRING);
		
	$pdo = getPDO();
	$sql = 'SELECT DISTINCT
			`rappel_modele` AS modele,
			`image_modele` AS image
			FROM `vehicules`
			WHERE `rappel_marque` = :marque
            ORDER BY modele ASC
	';
	$pdoStatement = $pdo->prepare($sql);
	$pdoStatement->bindValue(':marque', $marque, PDO::PARAM_STR);
	$pdoStatement->execute();
    $results = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    
    return $results;
}
/*
* return the list of every generation of a model
*/
function getGeneration(){
	if(!isset($_GET['model']) || empty($_GET['model'])){
		return null;
	}

	
	$model = filter_var($_GET['model'], FILTER_SANITIZE_STRING);
			
	$pdo = getPDO();
	$sql = 'SELECT DISTINCT
            `rappel_modele` as modele,
			`generation`
			FROM `vehicules`
			WHERE `rappel_modele` = :model
	';
	$pdoStatement = $pdo->prepare($sql);
	$pdoStatement->bindValue(':model', $model, PDO::PARAM_STR);
	$pdoStatement->execute();
    $results = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}
/*
* return energies available for a model generation
*/
function getCarEnergies(){
    if  (!isset($_GET['generation']) || empty($_GET['generation'])) {
        return null;
    }
    $generation = filter_var($_GET['generation'], FILTER_SANITIZE_STRING);

    if(!isset($_GET['model']) || empty($_GET['model'])){
		return null;
    }
    $model = filter_var($_GET['model'], FILTER_SANITIZE_STRING);

    $pdo = getPDO();
    $sql = 'SELECT DISTINCT
            `energie`,
            `rappel_modele` AS modele,
            `generation`
            FROM `vehicules`
            WHERE `rappel_modele` = :model
            AND `generation` = :generation
    ';
    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement->bindValue(':model', $model, PDO::PARAM_STR);
    $pdoStatement->bindValue(':generation', $generation, PDO::PARAM_STR);
    $pdoStatement->execute();
    $results = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}
/*
* return data of the current model
*/
function getCarData(){
	if(!isset($_GET['model']) || empty($_GET['model'])){
		return null;
	}	
	$model = filter_var($_GET['model'], FILTER_SANITIZE_STRING);
	$pdo = getPDO();
	$sql = 'SELECT 
			`image_modele` AS image,
            `rappel_modele` AS modele,
			`rappel_marque` AS marque
			FROM `vehicules`
			WHERE `rappel_modele` = :model
			LIMIT 1
	';
	$pdoStatement = $pdo->prepare($sql);
	$pdoStatement->bindValue(':model', $model, PDO::PARAM_STR);
	$pdoStatement->execute();
	$data = $pdoStatement->fetch(PDO::FETCH_ASSOC);
	return $data;
}
/*
* return data of a car by ID
*/
function getCarDataById(){

	if(!isset($_GET['voiture']) || empty($_GET['voiture'])){
		return null;
	}
	
	$voiture = filter_var($_GET['voiture'], FILTER_SANITIZE_STRING);
		
	$pdo = getPDO();
	$sql = 'SELECT *

			FROM `vehicules`
			WHERE `id` = :voiture
			limit 1
	';
	$pdoStatement = $pdo->prepare($sql);
	$pdoStatement->bindValue(':voiture', $voiture, PDO::PARAM_INT);
	$pdoStatement->execute();
    $data = $pdoStatement->fetch(PDO::FETCH_ASSOC);
    
    return $data;
}
/*
* return list of every model for a car model, generation and energie
*/
function getCarVersions(){
    if  (!isset($_GET['generation']) || empty($_GET['generation'])) {
        return null;
    }
    $generation = filter_var($_GET['generation'], FILTER_SANITIZE_STRING);

    if(!isset($_GET['model']) || empty($_GET['model'])){
		return null;
    }
    $model = filter_var($_GET['model'], FILTER_SANITIZE_STRING);

    if (!isset($_GET['energie']) || empty($_GET['energie'])) {
        return null;
    }
    $energie = filter_var($_GET['energie'], FILTER_SANITIZE_STRING);

    $pdo = getPDO();
    $sql = 'SELECT DISTINCT
            *
            FROM `vehicules`
            WHERE `rappel_modele` = :model
            AND `generation` = :generation
            AND `energie` = :energie
            ORDER BY `vehicules`.`version` ASC
    ';
    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement->bindValue(':model', $model, PDO::PARAM_STR);
    $pdoStatement->bindValue(':generation', $generation, PDO::PARAM_STR);
    $pdoStatement->bindValue(':energie', $energie, PDO::PARAM_STR);
    $pdoStatement->execute();
    $results = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}