<?php 
require_once "../../config/_dbconnection.php";
$sql = 'SELECT * FROM broccoli_users ORDER BY user_id DESC';
$statement  = $pdo->prepare($sql);
$statement->execute();
$users = $statement ->fetchAll(PDO::FETCH_ASSOC);

?>
<?php include_once "../basbord-partials/header.php" ?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <a href="adduser.php" class="btn btn-outline-primary btn-sm">Add user</a>
            <br>
            <br>
        </div>
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> User Type </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Image</th>
                      <th>Title</th>
                      <th>Email</th>
                      <th>Type</th>
                      <th>Creat Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php foreach ($users as $i => $user) : ?>
                          <tr>
                            <td><?php echo $i+1 ?></td>
                            <td><?php echo 'image' ?></td>
                            <td><?php echo $user['user_nicename'] ?></td>
                            <td><?php echo $user['user_email'] ?></td>
                            <td><?php echo $user['user_type'] ?></td>
                            <td><?php echo $user['create_at'] ?></td>
                            <td >
                              <a href="./updateuser.php?id=<?php echo $user['user_id'] ?>" class="btn btn-info btn-xs">Edit</a>
                              <form action="deleteuser.php" method="POST" style="display: inline-block;">
                                  <input type="hidden" name="id" value="<?php echo $user['user_id'] ?>">
                                  <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                              </form>
                            </td>
                          </tr>
                     <?php endforeach ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
    </div>
</div>

<?php include_once "../basbord-partials/footer.php" ?>