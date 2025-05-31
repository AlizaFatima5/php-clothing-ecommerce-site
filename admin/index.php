<?php
include 'config/connection.php';
include 'includes/header.php';

// Total Products
$selectQuery = "SELECT SUM(quantity) AS total_quantity FROM products_details";
$resultProducts = mysqli_query($con, $selectQuery);
$totalProducts = 0;
if ($resultProducts && $row = mysqli_fetch_assoc($resultProducts)) {
    $totalProducts = $row['total_quantity'];
}

// Total Orders
$sqlOrders = "SELECT SUM(quantity) AS total_orders FROM cart";
$resultOrders = mysqli_query($con, $sqlOrders);
$totalOrders = 0;
if ($resultOrders && $row = mysqli_fetch_assoc($resultOrders)) {
    $totalOrders = $row['total_orders'];
}

// Available Products
$availableProducts = $totalProducts - $totalOrders;
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">AliBaba Admin Panel</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>

    <div class="row">
        <!-- Total Products Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4 h-100">
                <div class="card-body">
                    <h5>Total Products</h5>
                    <h3><?= $totalProducts ?></h3>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <!-- Total Orders Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4 h-100">
                <div class="card-body">
                    <h5>Total Orders</h5>
                    <h3><?= $totalOrders ?></h3>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <!-- Available Products Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4 h-100">
                <div class="card-body">
                    <h5>Available Products</h5>
                    <h3><?= $availableProducts ?></h3>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <!-- Placeholder 4th Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4 h-100">
                <div class="card-body">
                    <h5>MOnthly Sales Report  </h5>
                    <h3></h3>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="monthlyreport.php">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>
