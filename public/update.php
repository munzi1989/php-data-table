<?php



// include pdo connection
require_once '../views/partials/pdo.php';
require_once "../functions/functions.php";


$id = $_GET['id'] ?? null;

// if no id passed in, redirect to home page
if (!$id) {
    header('Location: index.php');
    exit();
}

// fetch product with mathcing id
$statement = $pdo->prepare('SELECT * FROM products WHERE id = :id');
$statement->bindValue(':id', $id);
$statement->execute();
$product = $statement->fetch(PDO::FETCH_ASSOC);

$errors = [];
$title = $product['title'];
$description = $product['description'];
$price = $product['price'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // declare form data to variables
    $title = $_POST['title'];
    $description = $_POST['desc'];
    $price = $_POST['price'];

    // push errors if necessary
    if (!$title) {
        $errors[] = 'Product title is required';
    }
    if (!$price) {
        $errors[] = 'Product price is required';
    }
    if (!is_dir('images')) {
        mkdir('images');
    }
    // if no errors, proceed
    if (empty($errors)) {
        $image = $_FILES['image'] ?? null;
        $imgPath = $product['image'];

        // if image, remove image
        if ($image && $image['tmp_name']) {
            if ($product['image']) {
                unlink($product['image']);
            }
            // create random folder to hold assoc. image
            $imgPath = 'images/' . randomStr(8) . '/' . $image['name'];
            mkdir(dirname($imgPath));
            // push to images folder
            move_uploaded_file($image['tmp_name'], $imgPath);
        }

        // prepare statement w/ instruction and values
        $statement = $pdo->prepare(
            'UPDATE products SET title = :title, image = :image, description = :description, price = :price  WHERE id = :id'
        );

        // bind values to variables
        $statement->bindValue(':title', $title);
        $statement->bindValue(':image', $imgPath);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':id', $id);
        $statement->execute();
        header('Location: index.php');
    }
}


?>

<!-- import header -->
<?php include_once '../views/partials/header.php'; ?>


<body>
    <!-- back button -->
    <p><a href="index.php" class="btn  btn-secondary">
    < Go Back To Products</a>
    </p>
    <h1>Update Product: <b><?php echo $product['title']; ?></b></h1>
   <?php
    require_once "../views/partials/alerts.php"
    ?>
<!-- include update form -->
    <?php include_once '../views/partials/updateForm.php'; ?>
</body>

</html>