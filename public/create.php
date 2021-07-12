<?php

// import partials
require_once '../views/partials/pdo.php';

// import random string function for images
require_once "../functions/functions.php";

$errors = [];
$title = '';
$description = '';
$price = '';

// if no images folder yet, amke one
if (!is_dir('images')) {
    mkdir('images');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // declare form data to variables
    $title = $_POST['title'];
    $description = $_POST['desc'];
    $price = $_POST['price'];
    $date = date('Y-m-d H:i:s');

    if (!$title) {
        $errors[] = 'Product title is required';
    }
    if (!$price) {
        $errors[] = 'Product price is required';
    }
    // if no errors, proceed
    if (empty($errors)) {
        $imgPath = '';
        $image = $_FILES['image'] ?? null;
        if ($image && $image['tmp_name']) {
            // create random name for assoc. image in images folder
            $imgPath = 'images/' . randomStr(8) . '/' . $image['name'];
            mkdir(dirname($imgPath));

            move_uploaded_file($image['tmp_name'], $imgPath);
        }

        // prepare statement w/ instruction and values
        $statement = $pdo->prepare("INSERT INTO products (title, image, description, price, create_date)
    VALUES (:title, :image, :description, :price, :date)");
        // bind values to variables
        $statement->bindValue(':title', $title);
        $statement->bindValue(':image', $imgPath);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':date', $date);
        $statement->execute();
        header('Location: index.php');
    }
}
?>

<!-- import header -->
<?php include_once '../views/partials/header.php'; ?>

<body>
     <p><a href="index.php" class="btn  btn-secondary">
    < Go Back To Products</a>
    </p>
    <h1>Create New Product</h1>
    <!-- include alerts -->
    <?php
    require_once "../views/partials/alerts.php"
    ?>
    <!-- include create form -->
    <?php
    include_once "../views/partials/createForm.php";
    ?>

</body>

</html>