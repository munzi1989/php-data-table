<?php
// init PDO w/ url, root, password(default '')
$pdo = new PDO(
    'mysql:host=localhost;port=3306;dbname=products_crud',
    'root',
    
    ''
);
// set any attributes
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>