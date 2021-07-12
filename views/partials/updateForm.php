
 <!-- display current image of product if any -->
    <form action="" method="post" enctype="multipart/form-data">
        <?php if ($product['image']): ?>
        <label for="current-img">Current Image</label><br>
        <img name='current-img' class="update-img" src="<?php echo $product[
            'image'
        ]; ?>">
        <?php endif; ?>
        <br><br>
        <!-- upload new image -->
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
            <label for="description" class="form-label">Product Description</label>
            <textarea class="form-control" id="description" name='description'
                ><?php echo $description; ?></textarea>
        </div>
        <!-- Price -->
        <div class="mb-3">
            <label for="price" class="form-label">Product Price</label>
            <input type="number" step="0.01" class="form-control" id="price" name='price' value="<?php echo $price; ?>">
        </div>
        <!-- submit button -->
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
