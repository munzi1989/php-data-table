<!-- upload image -->
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="image" class="form-label">Product Image</label>
            <br>
            <input type="file" id="image" name="image">

        </div>
<!-- title -->
        <div class="mb-3">
            <label for="title" class="form-label">Product Title</label>
            <input type="text" class="form-control" id="title" name=title value="<?php echo $title; ?>">
        </div>
        <!-- description -->
        <div class="mb-3">
            <label for="desc" class="form-label">Product Description</label>
            <textarea type="text" class="form-control" id="desc" name='desc'
                value="<?php echo $description; ?>"></textarea>
        </div>
        <!-- price -->
        <div class="mb-3">
            <label for="price" class="form-label">Product Price</label>
            <input type="number" step="0.01" class="form-control" id="price" name='price' value="<?php echo $price; ?>">
        </div>
        <!-- submit button -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>