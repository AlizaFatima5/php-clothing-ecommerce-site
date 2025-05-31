<?php
include 'admin/config/connection.php';
// session_start(); // agar already nahi kiya
$user_id = $_SESSION['user_id'];
$query = "SELECT SUM(quantity) AS total_quantity FROM cart WHERE user_id = '$user_id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);

// Agar result null ho to default 0
$cart_quantity = $row['total_quantity'] ?? 0;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALI BABA Clothing Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="assets/css/header_style.css">
<style>
    .cart-icon {
  position: relative;
  display: inline-block;
  font-size: 24px; /* adjust icon size */
  color: #333;
}

.cart-badge {
  position: absolute;
  top: -18px; /* was -8px */
  right: -10px;
  background-color: #ff4d4d;
  color: white;
  font-size: 12px;
  font-weight: bold;
  width: 20px;
  height: 20px;
  border-radius: 50%;
  text-align: center;
  line-height: 20px;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
  transition: transform 0.3s ease-in-out;
}


.cart-icon:hover .cart-badge {
  transform: scale(1.1);
}

</style>

</head>

<body>
    <header>
        <div id="top-bar">
            <div class="scroll-text">
                <marquee>ہمارے پاس ہر قسم کی ورائٹی موسم کے مطابق دستیاب ہے</marquee>
            </div>
            <div class="top-icons">
            <a href="https://wa.me/923176450772" target="_blank"><i class="fa-brands fa-whatsapp" id="watsup"></i></a>
            <a href="tel:+923336458577"><i class="fa fa-phone"></i></a>
            <a href="logout.php"><i class="fa fa-user"></i></a>
            </div>
        </div>
        <div id="pri-bar">
            <div id="lft-icon">
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <ul class="main-menu">
                    <li class="menu-item">
                        <a href="#"><b>WINTER</b></a>
                        <div class="mega-dropdown">
                            <ul>
                                <li class="sub-menu-item">
                                    <a href="#">Mens</a>
                                    <div class="sub-dropdown">
                                        <ul>
                                            <li><a href="#">Pure Lawn</a></li>
                                            <li><a href="#">Pure Cotton</a></li>
                                            <li><a href="#">Karandi</a></li>
                                            <li><a href="#">Doria</a></li>
                                            <li><a href="#">Wash & Wear</a></li>
                                            <li><a href="#">Khaddar</a></li>
                                            <li><a href="#">Chiffon</a></li>
                                            <li><a href="#">Silk</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="sub-menu-item">
                                    <a href="#">Womens</a>
                                    <div class="sub-dropdown">
                                        <ul>
                                            <li><a href="#">Pure Lawn</a></li>
                                            <li><a href="#">Pure Cotton</a></li>
                                            <li><a href="#">Karandi</a></li>
                                            <li><a href="#">Doria</a></li>
                                            <li><a href="#">Wash & Wear</a></li>
                                            <li><a href="#">Khaddar</a></li>
                                            <li><a href="#">Chiffon</a></li>
                                            <li><a href="#">Silk</a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="menu-item">
                        <a href="#"><b>SUMMER</b></a>
                        <div class="mega-dropdown">
                            <ul>
                                <li class="sub-menu-item">
                                    <a href="#">Mens</a>
                                    <div class="sub-dropdown">
                                        <ul>
                                            <li><a href="#">Pure Lawn</a></li>
                                            <li><a href="#">Pure Cotton</a></li>
                                            <li><a href="#">Karandi</a></li>
                                            <li><a href="#">Doria</a></li>
                                            <li><a href="#">Wash & Wear</a></li>
                                            <li><a href="#">Khaddar</a></li>
                                            <li><a href="#">Chiffon</a></li>
                                            <li><a href="#">Silk</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="sub-menu-item">
                                    <a href="#">Womens</a>
                                    <div class="sub-dropdown">
                                        <ul>
                                            <li><a href="#">Pure Lawn</a></li>
                                            <li><a href="#">Pure Cotton</a></li>
                                            <li><a href="#">Karandi</a></li>
                                            <li><a href="#">Doria</a></li>
                                            <li><a href="#">Wash & Wear</a></li>
                                            <li><a href="#">Khaddar</a></li>
                                            <li><a href="#">Chiffon</a></li>
                                            <li><a href="#">Silk</a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            <a href="index.php" id="logo-link">
                <img src="final.png" alt="ALI BABA Clothing Store" id="logo">
            </a>
            <div id="rt-icon">
                <div class="lg-bag">
                    <a href="shop.php"><i class="fas fa-shopping-bag"></i></a>
                </div>
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search here..">
                </div>
                <div class="lg-bag">
                  <a href="addtocart.php" class="cart-icon">
  <i class="fa fa-shopping-cart"></i>
  <span class="cart-badge"><?php echo $cart_quantity; ?></span>
</a>

                  
                </div>
            </div>
        </div>
    </header>


</body>

</html>
