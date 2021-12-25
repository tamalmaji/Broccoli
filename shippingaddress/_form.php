<form action="" method="post">
    <div class="form-group">
        <label for="title">Full name (First and Last name)</label>
        <input type="text" class="form-control <?php echo (!empty($fName_err)) ? 'is-invalid' : ''; ?>" name="title" value="<?php echo $fName; ?>">
        <samp class="invalid-feedback"><?php echo $fName_err; ?></samp>
    </div>
    <div class="form-group">
        <label for="title">Mobile numbe</label>
        <input type="number" class="form-control <?php echo (!empty($num_err)) ? 'is-invalid' : ''; ?>" name="title" placeholder="10-digit mobile number without prefixes" value="<?php echo $num; ?>" style="height: 65px;">
        <samp class="invalid-feedback"><?php echo $num_err; ?></samp>
    </div>
    <div class="form-group">
        <label for="title">PIN code</label>
        <input type="number" class="form-control <?php echo (!empty($pin_err)) ? 'is-invalid' : ''; ?>" name="title" placeholder="6 digits [0-9] PIN code" value="<?php echo $pin; ?>" style="height: 65px;">
        <samp class="invalid-feedback"><?php echo $pin_err; ?></samp>
    </div>
    <div class="form-group">
        <label for="title">Flat, House no., Building, Company, Apartment</label>
        <input type="text" class="form-control <?php echo (!empty($build_err)) ? 'is-invalid' : ''; ?>" name="title"  value="<?php echo $build; ?>">
        <samp class="invalid-feedback"><?php echo $build_err; ?></samp>
    </div>
    <div class="form-group">
        <label for="title">Area, Colony, Street, Sector, Village</label>
        <input type="text" class="form-control <?php echo (!empty($street_err)) ? 'is-invalid' : ''; ?>" name="title" value="<?php echo $street; ?>">
        <samp class="invalid-feedback"><?php echo $street_err; ?></samp>
    </div>
    <div class="form-group">
        <label for="title">Landmark</label>
        <input type="text" class="form-control <?php echo (!empty($landmark_err)) ? 'is-invalid' : ''; ?>" name="title" placeholder="E.g. Near AIIMS Flyover, Behind Regal Cinema, etc." value="<?php echo $landmark; ?>">
        <samp class="invalid-feedback"><?php echo $landmark_err; ?></samp>
    </div>
    <div class="form-group">
        <label for="title">Town/City</label>
        <input type="text" class="form-control <?php echo (!empty($city_err)) ? 'is-invalid' : ''; ?>" name="title"  value="<?php echo $city; ?>">
        <samp class="invalid-feedback"><?php echo $city_err; ?></samp>
    </div>
    <div class="form-group">
        <label for="title">State / Province / Region</label>
        <input type="text" class="form-control <?php echo (!empty($state_err)) ? 'is-invalid' : ''; ?>" name="title" value="<?php echo $state; ?>">
        <samp class="invalid-feedback"><?php echo $state_err; ?></samp>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>