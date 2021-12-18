<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <div class="mb-3">
            <label class="form-label">Upload Product Related Images</label>
            <input class="form-control" type="file" name="image[]" multiple>
            <samp class="invalid-feedback"><?php echo $imgr_err; ?></samp>
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>