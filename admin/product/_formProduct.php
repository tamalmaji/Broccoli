<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Product Title</label>
        <input type="text" class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>" name="title" placeholder="Enter Title" value="<?php echo $title; ?>">
        <samp class="invalid-feedback"><?php echo $title_err; ?></samp>
    </div>
    <div class="form-group">
        <label for="price">Product Price</label>
        <input type="number" class="form-control <?php echo (!empty($price_err)) ? 'is-invalid' : ''; ?>" name="price" placeholder="Enter Price" value="<?php echo $price; ?>">
        <samp class="invalid-feedback"><?php echo $price_err; ?></samp>
    </div>
    <div class="form-group">
        <label for="discount">Product Discount Price</label>
        <input type="number" class="form-control <?php echo (!empty($discount_err)) ? 'is-invalid' : ''; ?>" name="discount" placeholder="Enter Discount Price" value="<?php echo $discount; ?>">
        <samp class="invalid-feedback"><?php echo $discount_err; ?></samp>
    </div>
    <div class="form-group">
        <label for="qty">Product Quantity</label>
        <input type="number" class="form-control <?php echo (!empty($qty_err)) ? 'is-invalid' : ''; ?>" name="qty" placeholder="Enter Quantity" value="<?php echo $qty; ?>">
        <samp class="invalid-feedback"><?php echo $qty_err; ?></samp>
    </div>
    <div class="form-group">
        <label for="price">Product Description</label>
        <textarea class="form-control <?php echo (!empty($desc_err)) ? 'is-invalid' : ''; ?>" name="desc" id="" cols="30" rows="5" placeholder="Enter Description" value="<?php echo $desc; ?>"><?php echo $desc; ?></textarea>
        <samp class="invalid-feedback"><?php echo $desc_err; ?></samp>
    </div>
    <div class="form-group">
        <div class="mb-3">
            <label class="form-label">Upload Product Image</label>
            <input class="form-control" type="file" name="file">
            <samp class="invalid-feedback"><?php echo $img_err; ?></samp>
        </div>
    </div>
  
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>