<?php 
// import pdo connection
require_once "../views/partials/pdo.php";

// pull id from POST request when submitted
$id = $_POST['id'] ?? null;

// if no Id, return to main page
if(!$id){
    header('Location: index.php');
    exit;
}

// prepare->execute pdo 
$statement = $pdo->prepare('DELETE FROM products WHERE id = :id');
$statement->bindValue(':id', $id);
$statement->execute();

// return to main page
header("Location: index.php");