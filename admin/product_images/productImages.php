<?php 
require_once "../../config/_dbconnection.php";
$sql = 'SELECT * FROM broccoli_product ORDER BY product_id DESC';
$statement  = $pdo->prepare($sql);
$statement->execute();
$products = $statement ->fetchAll(PDO::FETCH_ASSOC);

?>
<?php include_once "../basbord-partials/header.php" ?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">multiple Images </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Image</th>
                      <th>Title</th>
                      <th>Multiple Img</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php foreach ($products as $i => $product) : ?>
                          <tr>
                            <td><?php echo $i+1 ?></td>
                            <td>
                              <img src="../../public/<?php echo $product['product_img'];?>" alt="" style="width: 50px;">
                            </td>
                            <td><?php echo substr($product['product_name'], 0, 15)."..."; ?></td>
                            <td>
                              <img src="../../public/<?php echo $product['product_img'];?>" alt="" style="width: 50px;">
                            </td>
                            <td >
                              <a href="./addproductImages.php?id=<?php echo $product['product_id'] ?>" class="btn btn-info btn-xs">Add</a>
                              <a href="./updateProduct.php?id=<?php echo $product['product_id'] ?>" class="btn btn-info btn-xs">Edit</a>
                              <form action="deleteProduct.php" method="POST" style="display: inline-block;">
                                  <input type="hidden" name="id" value="<?php echo $product['product_id'] ?>">
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