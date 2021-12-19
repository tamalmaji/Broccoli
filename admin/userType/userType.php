<?php 
require_once "../../config/_dbconnection.php";
$sql = 'SELECT * FROM broccoli_usertype ORDER BY userType_id DESC';
$statement  = $pdo->prepare($sql);
$statement->execute();
$userTypes = $statement ->fetchAll(PDO::FETCH_ASSOC);

?>
<?php include_once "../basbord-partials/header.php" ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">DashBord</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="../../public/index.php">Home</a></li>
            <li class="breadcrumb-item active">UserType</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <hr>
<div class="container">
    <div class="row">
        <div class="col-12">
            <a href="addUserType.php" class="btn btn-outline-primary btn-sm">Add UserType</a>
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
                      <th>Title</th>
                      <th>Create Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php foreach ($userTypes as $i => $userType) : ?>
                          <tr>
                            <td><?php echo $i+1 ?></td>
                            <td><?php echo $userType['userType_name'] ?></td>
                            <td><?php echo $userType['create_at'] ?></td>
                            <td >
                              <a href="./updateUserType.php?id=<?php echo $userType['userType_id'] ?>" class="btn btn-info btn-xs">Edit</a>
                              <form action="deleteUserType.php" method="POST" style="display: inline-block;">
                                  <input type="hidden" name="id" value="<?php echo $userType['userType_id'] ?>">
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