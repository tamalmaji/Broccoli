<form action="" method="post">
<div class="form-group">
        <label for="name">User Name</label>
        <input type="text" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" name="name" placeholder="Enter Name" value="<?php echo $name; ?>">
        <samp class="invalid-feedback"><?php echo $name_err; ?></samp>
    </div>
    <div class="form-group">
        <label for="login">User Login id</label>
        <input type="text" class="form-control <?php echo (!empty($login_err)) ? 'is-invalid' : ''; ?>" name="login" placeholder="Enter login Id" value="<?php echo $login; ?>">
        <samp class="invalid-feedback"><?php echo $login_err; ?></samp>
    </div>
    <div class="form-group">
        <label for="email">User Email</label>
        <input type="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" name="email" placeholder="Enter Email" value="<?php echo $email; ?>">
        <samp class="invalid-feedback"><?php echo $email_err; ?></samp>
    </div>
    <div class="form-group">
        <label for="pwd">User Password</label>
        <input type="password" class="form-control <?php echo (!empty($pwd_err)) ? 'is-invalid' : ''; ?>" name="pwd" placeholder="Enter Password" value="<?php echo $pwd; ?>">
        <samp class="invalid-feedback"><?php echo $pwd_err; ?></samp>
    </div>
    <div class="form-group">
        <label for="pwd">User Confirm Password</label>
        <input type="password" class="form-control <?php echo (!empty($cpwd_err)) ? 'is-invalid' : ''; ?>" name="cpwd" placeholder="Enter Confirm Password" value="<?php echo $cpwd; ?>">
        <samp class="invalid-feedback"><?php echo $cpwd_err; ?></samp>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
