<?php
require_once "../../config/_dbconnection.php";
$num_per_page = 10;

$stmt = $pdo->prepare('SELECT * FROM broccoli_catagory');
$stmt->execute();
$noOfPages = $stmt->rowCount();
$total_pages = ceil($noOfPages / $num_per_page);

if (isset($_GET['page']) && !empty($_GET['page'])) {
  $page = $_GET['page'];
  if ($page > $total_pages) {
    //    $page = 1;
    header("Location: catagory.php?page=1");
  }
} else {
  $page = 1;
}

$start_from = ($page - 1) * 05;

$sql = "SELECT * FROM broccoli_catagory limit $start_from, $num_per_page";
if ($statement = $pdo->prepare($sql)) {
  if ($statement->execute()) {
    $catagorys = $statement->fetchAll(PDO::FETCH_ASSOC);
  }
}

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
            <li class="breadcrumb-item active">Catagory</li>
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
        <a href="addCatagory.php" class="btn btn-outline-primary btn-sm">Add Catagory</a>
        <br>
        <br>
      </div>
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> Catagory </h3>
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
                <?php foreach ($catagorys as $i => $catagory) : ?>
                  <tr>
                    <td><?php echo $i + 1 ?></td>
                    <td><?php echo $catagory['catagory_name'] ?></td>
                    <td><?php echo $catagory['create_at'] ?></td>
                    <td>
                      <a href="./updateCatagory.php?id=<?php echo $catagory['catagory_id'] ?>" class="btn btn-info btn-xs">Edit</a>
                      <form action="deleteCatagory.php" method="POST" style="display: inline-block;">
                        <input type="hidden" name="id" value="<?php echo $catagory['catagory_id'] ?>">
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
    <div class="row">
      <div class="col-sm-12 col-md-5">
        <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of <?php echo $noOfPages ?> entries</div>
      </div>
      <div class="col-sm-12 col-md-7">
        <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
          <ul class="pagination">
            <?php if ($page > 1) : ?>
              <li class="paginate_button page-item previous" id="example1_previous"><a href="catagory.php?page=<?php echo ($page - 1) ?>" aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
            <?php endif ?>
            <?php for ($i = 1; $i < $total_pages; $i++) : ?>
              <?php if ($i == $page) { ?>

                <li class="paginate_button page-item active"><a href="catagory.php?page=<?php echo $i ?>" aria-controls="example1" data-dt-idx="1" tabindex="0" class="page-link"><?php echo $i ?></a></li>
              <?php } else { ?>
                <li class="paginate_button page-item"><a href="catagory.php?page=<?php echo $i ?>" aria-controls="example1" data-dt-idx="1" tabindex="0" class="page-link"><?php echo $i ?></a></li>
              <?php } ?>
            <?php endfor ?>
            <?php if ($i > $page) : ?>
              <li class="paginate_button page-item next" id="example1_next"><a href="catagory.php?page=<?php echo ($page + 1) ?>" aria-controls="example1" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li>
            <?php endif ?>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <?php include_once "../basbord-partials/footer.php" ?>