<?php

require_once "../../config/_dbconnection.php";

$id = $_GET['id'] ?? NULL;
if (!$id) {
    header('Location: product.php');
    exit;
}

$sqli = 'SELECT * FROM broccoli_product WHERE product_id  = :id';
$statement = $pdo->prepare($sqli);
$statement->bindValue(':id', $id);
$statement->execute();
$product = $statement->fetch(PDO::FETCH_ASSOC);

$sql = 'SELECT * FROM broccoli_product_images WHERE product_id  = :id';
$statements = $pdo->prepare($sql);
$statements->bindValue(':id', $id);
$statements->execute();
$products = $statements->fetchAll(PDO::FETCH_ASSOC);
?>
<?php include_once "../basbord-partials/header.php" ?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <a href="../product/product.php" class="btn btn-outline-primary">Back to Product</a>
        </div>
        <div class="col-12 mt-5 mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1><?php echo $product['product_name'] ?></h1>
                        <a href="./addproImg.php?id=<?php echo $product['product_id'] ?>" class="btn btn-info ">Add Images</a>
                        <hr class="mb-5">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"> Product </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Images</th>
                                            <th>Create Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($products as $i => $pro) : ?>
                                            <tr>
                                                <td> <?php echo $i + 1; ?> </td>
                                                <td>
                                                    <img src="../../public/<?php echo $pro['images'] ?>" alt="" style="width: 150px;">
                                                </td>
                                                <td> <?php echo $pro['create_at']; ?> </td>
                                                <td>
                                                    <a href="./updateproImg.php?id=<?php echo $pro['id'] ?>" class="btn btn-info btn-xs">Edit</a>
                                                    <form action="deleteproImg.php" method="POST" style="display: inline-block;">
                                                        <input type="hidden" name="id" value="<?php echo $pro['id'] ?>">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once "../basbord-partials/footer.php" ?>