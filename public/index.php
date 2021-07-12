<?php


// include pdo connection
require_once '../views/partials/pdo.php';  

$searchText = $_GET['search'] ?? '';

// if search text, filter title or price based on search text
if ($searchText) {
    $statement = $pdo->prepare(
        'SELECT * FROM products WHERE title LIKE :title OR price LIKE :price ORDER BY create_date DESC'
    );
    // need quotes and %n% for mySQL LIKE attribute
    $statement->bindValue(':title', "%$searchText%");
    $statement->bindValue(':price', "%$searchText%");
    $statement->execute();
    $products = $statement->fetchAll(PDO::FETCH_ASSOC);
} else {
    // else, pull all data from products in descending order
    $statement = $pdo->prepare(
        'SELECT * FROM products ORDER BY create_date DESC'
    );
    $statement->execute();
    $products = $statement->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!-- include HTML header -->
<?php include_once '../views/partials/header.php'; ?>

<body>
    <h1>Products CRUD</h1>
    <hr>

    <!-- leave action blank for GET request -->
    <form action="">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search for Products" name="search"
                value="<?php $searchText; ?>">
            <button class="btn btn-outline-secondary" type="submit">Search</button>

        </div>
        <!-- if search, show clear search button -->
        <?php if ($searchText): ?>
        <button style="width: 100%" class="btn btn-secondary" onclick=(<?php $searchText =
            ''; ?>)>Clear
            Search</button>
        <br>
        <?php endif; ?>
    </form>
    <br>
    <!-- push to create.php to create product -->
    <a href="create.php" class="btn btn-lg btn-success">Create Product</a>
    <br><br>


<!-- table of products -->
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Title</th>
                <th scope="col">Price</th>
                <th scope="col">Description</th>
                <th scope="col">Create Date</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- loop through $products array and display -->
            <?php foreach ($products as $i => $item) { ?>
            <tr>

                <th scope="row"><?php echo $i + 1; ?> </th>
                <td>
                    <img class="thumb-img" src="<?php echo $item[
                        'image'
                    ]; ?>" alt="No Photo">
                </td>
                <td><?php echo $item['title']; ?></td>
                <td><?php echo $item['price']; ?></td>
                <td><?php echo $item['description']; ?></td>
                <td><?php echo $item['create_date']; ?></td>
                <td>
                    <!-- edit button - push to update.php-->
                    <a href="update.php?id=<?php echo $item[
                        'id'
                    ]; ?>" class="btn btn-outline-primary btn-sm">Edit</a>
                    <form style="display: inline-block" method="post" action="delete.php">
                        <input type="hidden" name='id' value="<?php echo $item[
                            'id'
                        ]; ?>">
                        <!-- delete button -->
                        <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                    </form>

                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

</body>

</html>