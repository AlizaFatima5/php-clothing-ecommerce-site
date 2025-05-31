<?php
session_start();
include 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Checkout Page</title>
  <link rel="stylesheet" href="assets/css/footer_style.css">
<style>
  /* ── Container Setup ───────────────────────────────────────────── */
body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background-color: #f8f9fa;
  margin: 0;
  padding: 0;
  color: #333;
}

.container {
  display: flex;
  max-width: 1100px;
  margin: 40px auto;
  background: #fff;
  box-shadow: 0 8px 20px rgba(0,0,0,0.1);
  border-radius: 8px;
  overflow: hidden;
  gap: 40px;
  padding: 30px;
}

/* ── Left Side Form Styling ────────────────────────────────────── */
.checkout-form {
  flex: 1;
  padding-right: 20px;
}

.checkout-form h2 {
  font-size: 28px;
  font-weight: 700;
  margin-bottom: 30px;
  color: #222;
  border-bottom: 3px solid #ff6a00;
  padding-bottom: 8px;
  letter-spacing: 0.05em;
}

.form-group {
  margin-bottom: 20px;
  position: relative;
}

.form-group label {
  display: block;
  font-weight: 600;
  margin-bottom: 8px;
  color: #555;
}

.form-group label span {
  color: #e74c3c;
  margin-left: 4px;
}

.form-group input[type="text"],
.form-group input[type="email"] {
  width: 100%;
  padding: 12px 15px;
  font-size: 16px;
  border: 1.8px solid #ddd;
  border-radius: 6px;
  transition: border-color 0.3s ease;
}

.form-group input[type="text"]:focus,
.form-group input[type="email"]:focus {
  outline: none;
  border-color: #ff6a00;
  box-shadow: 0 0 8px rgba(255, 106, 0, 0.3);
}

/* ── Submit Button ───────────────────────────────────────────── */
.submit-btn {
  background-color: #ff6a00;
  border: none;
  color: white;
  font-size: 18px;
  font-weight: 700;
  padding: 14px 0;
  width: 100%;
  border-radius: 8px;
  cursor: pointer;
  transition: background-color 0.3s ease, transform 0.3s ease;
  margin-top: 10px;
}

.submit-btn:hover {
  background-color: #e65c00;
  transform: translateY(-3px);
}

/* ── Right Side Product Summary ───────────────────────────────── */
.right-side {
  flex: 1;
  border-left: 1px solid #eee;
  padding-left: 30px;
  display: flex;
  flex-direction: column;
  color: #444;
}

.product-summary h3 {
  font-size: 26px;
  font-weight: 700;
  margin-bottom: 25px;
  color: #222;
  border-bottom: 3px solid #ff6a00;
  padding-bottom: 8px;
  letter-spacing: 0.05em;
}

.product-table {
  width: 100%;
  border-collapse: collapse;
  background: #fff;
  border-radius: 8px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.07);
  overflow: hidden;
}

.product-table th, .product-table td {
  padding: 14px 20px;
  text-align: left;
  vertical-align: middle;
}

.product-table th {
  background-color: #ff6a00;
  color: #fff;
  font-weight: 700;
  font-size: 14px;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}

.product-table tbody tr:hover {
  background-color: #fff4e6;
  transition: background-color 0.3s ease;
}

.product-table img {
  width: 70px;
  height: 70px;
  object-fit: cover;
  border-radius: 8px;
  border: 1px solid #ddd;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.product-title {
  font-weight: 600;
  font-size: 17px;
  color: #333;
}

.product-price {
  font-weight: 700;
  font-size: 16px;
  color: #ff6a00;
}

.product-table tfoot td {
  background-color: #fff8f0;
  font-weight: 700;
  font-size: 16px;
  padding: 16px 20px;
}

.delivery-note-cell {
  color: #444;
}

.order-cell {
  text-align: right;
}

.place-order-btn {
  background-color: #ff6a00;
  color: #fff;
  padding: 12px 28px;
  border-radius: 30px;
  text-decoration: none;
  font-weight: 700;
  font-size: 15px;
  display: inline-block;
  transition: background-color 0.3s ease, transform 0.3s ease;
}

.place-order-btn:hover {
  background-color: #e65c00;
  transform: translateY(-3px);
}

/* ── Responsive Design ───────────────────────────────────────── */
@media (max-width: 992px) {
  .container {
    flex-direction: column;
    padding: 20px;
  }
  .right-side {
    border-left: none;
    padding-left: 0;
    margin-top: 40px;
  }
}

@media (max-width: 480px) {
  .submit-btn {
    font-size: 16px;
    padding: 12px 0;
  }
  .product-table img {
    width: 50px;
    height: 50px;
  }
  .product-title {
    font-size: 14px;
  }
  .product-price {
    font-size: 14px;
  }
  .place-order-btn {
    padding: 10px 20px;
    font-size: 14px;
  }
}

</style>


</head>
<body>

  <div class="container">
    <!-- Left Side Form -->
    <div class="checkout-form">
      <h2>Checkout Form</h2>
      <form action="#" method="post">
        <div class="form-group">
          <label for="firstname">First Name<span>*</span></label>
          <input type="text" id="firstname" name="firstname" required>
        </div>
        <div class="form-group">
          <label for="lastname">Last Name<span>*</span></label>
          <input type="text" id="lastname" name="lastname" required>
        </div>
        <div class="form-group">
          <label for="country">Country<span>*</span></label>
          <input type="text" id="country" name="country" required>
        </div>
        <div class="form-group">
          <label for="street">Street Address<span>*</span></label>
          <input type="text" id="street" name="street_address" required>
        </div>
        <div class="form-group">
          <label for="city">City<span>*</span></label>
          <input type="text" id="city" name="city" required>
        </div>
        <div class="form-group">
          <label for="phone">Phone<span>*</span></label>
          <input type="text" id="phone" name="phone" required>
        </div>
        <div class="form-group">
          <label for="email">Email Address<span>*</span></label>
          <input type="email" id="email" name="email_address" required>
        </div>
        <button class="submit-btn" type="submit" name="submit">Submit</button>
      </form>
    </div>
<?php
include 'admin/config/connection.php';
if(isset($_POST['submit'])){
  $firstname=$_POST['firstname'];
  $lastname=$_POST['lastname'];
  $country=$_POST['country'];
  $street_address=$_POST['street_address'];
  $city=$_POST['city'];
  $phone=$_POST['phone'];
  $email_address=$_POST['email_address'];
  $insertQuery="insert into checkout(firstname,lastname,country,street_address,city,phone,email_address) Values('$firstname','$lastname','$country','$street_address','$city','$phone','email_address')";
  $query=mysqli_Query($con,$insertQuery);
  // if($query){
  //   echo "insertion successful";
  // }
  // else{
  //   echo " insertion failed";
  // }
}
?>

    <!-- Right Side (Empty for now) -->
 <div class="right-side">

  <?php
  // include 'admin/config/connection.php';

  $sql    = "SELECT title, image, product_price FROM cart";
  $result = mysqli_query($con, $sql);

  if (mysqli_num_rows($result) > 0) {
      echo '<div class="product-summary">';
      echo '  <h3>Product Summary</h3>';
      echo '  <table class="product-table">';
      echo '    <thead>';
      echo '      <tr>';
      echo '        <th>Product Image</th>';
      echo '        <th>Product Title</th>';
      echo '        <th>Price</th>';
      echo '      </tr>';
      echo '    </thead>';
      echo '    <tbody>';
      while ($row = mysqli_fetch_assoc($result)) {
          echo '    <tr>';
          echo '      <td><img src="admin/' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['title']) . '"></td>';
          echo '      <td><span class="product-title">' . htmlspecialchars($row['title']) . '</span></td>';
          echo '      <td><span class="product-price">PKR ' . number_format($row['product_price']) . '</span></td>';
          echo '    </tr>';
      }
      echo '    </tbody>';
      // footer row for delivery note + place order button
      echo '    <tfoot>';
      echo '      <tr>';
      echo '        <td colspan="2" class="delivery-note-cell">Pay with Cash on Delivery</td>';
      echo '        <td class="order-cell">';
      echo '          <a href="final.php" class="place-order-btn">Place Order</a>';
      echo '        </td>';
      echo '      </tr>';
      echo '    </tfoot>';
      echo '  </table>';
      echo '</div>';
  } else {
      echo '<p>No products in cart.</p>';
  }
  
  ?>

</div>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
 /* ── Container ───────────────────────────────────────────────────────────── */
 body,html{
  padding: 0;
  margin: 0;
  box-sizing: border-box;
 }
/* Container Setup - Full Width */
.container {
  max-width: 1100px;
  width: 100%;
  margin: 40px auto;
  background: #ffffff;
  box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
  border-radius: 12px;
  display: flex;
  gap: 40px;
  padding: 30px;
  box-sizing: border-box;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  color: #222;
}

/* Left Side - Checkout Form */
.checkout-form {
  flex: 1;
  padding-right: 25px;
}

.checkout-form h2 {
  font-size: 30px;
  font-weight: 700;
  margin-bottom: 30px;
  color: #004d40; /* Dark teal */
  border-bottom: 3px solid #009688; /* Teal */
  padding-bottom: 10px;
  letter-spacing: 0.06em;
}

/* Form Groups */
.form-group {
  margin-bottom: 22px;
}

.form-group label {
  display: block;
  font-weight: 600;
  margin-bottom: 8px;
  color: #00796b; /* Medium teal */
}

.form-group label span {
  color: #d32f2f; /* Red for required */
  margin-left: 4px;
}

.form-group input[type="text"],
.form-group input[type="email"] {
  width: 100%;
  padding: 14px 16px;
  font-size: 16px;
  border: 1.5px solid #b2dfdb; /* Light teal border */
  border-radius: 8px;
  transition: border-color 0.3s ease, box-shadow 0.3s ease;
  box-sizing: border-box;
}

.form-group input[type="text"]:focus,
.form-group input[type="email"]:focus {
  outline: none;
  border-color: #00796b; /* Darker teal */
  box-shadow: 0 0 10px rgba(0, 121, 107, 0.3);
}

/* Submit Button */
.submit-btn {
  background-color: #00796b;
  border: none;
  color: white;
  font-size: 18px;
  font-weight: 700;
  padding: 15px 0;
  width: 100%;
  border-radius: 10px;
  cursor: pointer;
  transition: background-color 0.3s ease, transform 0.3s ease;
  margin-top: 15px;
  box-shadow: 0 4px 10px rgba(0, 121, 107, 0.3);
}

.submit-btn:hover {
  background-color: #004d40;
  transform: translateY(-2px);
  box-shadow: 0 6px 14px rgba(0, 77, 64, 0.5);
}

/* Right Side - Product Summary */
.right-side {
  flex: 1;
  border-left: 1px solid #e0f2f1; /* Very light teal border */
  padding-left: 30px;
  display: flex;
  flex-direction: column;
  color: #004d40;
}

.product-summary h3 {
  font-size: 28px;
  font-weight: 700;
  margin-bottom: 28px;
  color: #004d40;
  border-bottom: 3px solid #009688;
  padding-bottom: 10px;
  letter-spacing: 0.06em;
}

/* Product Table */
.product-table {
  width: 100%;
  border-collapse: collapse;
  background: #e0f2f1;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
}

.product-table th, 
.product-table td {
  padding: 16px 24px;
  text-align: left;
  vertical-align: middle;
  font-size: 15px;
}

.product-table th {
  background-color: #00796b;
  color: #e0f2f1;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}

.product-table tbody tr:hover {
  background-color: #b2dfdb;
  transition: background-color 0.3s ease;
}

.product-table img {
  width: 70px;
  height: 70px;
  object-fit: cover;
  border-radius: 12px;
  border: 1.5px solid #004d40;
  box-shadow: 0 3px 8px rgba(0, 77, 64, 0.1);
}

.product-title {
  font-weight: 600;
  font-size: 17px;
  color: #004d40;
}

.product-price {
  font-weight: 700;
  font-size: 16px;
  color: #00796b;
}

.product-table tfoot td {
  background-color: #b2dfdb;
  font-weight: 700;
  font-size: 16px;
  padding: 18px 24px;
}

.delivery-note-cell {
  color: #004d40;
  font-style: italic;
}

.order-cell {
  text-align: right;
}

.place-order-btn {
  background-color: #00796b;
  color: #e0f2f1;
  padding: 12px 30px;
  border-radius: 30px;
  text-decoration: none;
  font-weight: 700;
  font-size: 15px;
  display: inline-block;
  transition: background-color 0.3s ease, transform 0.3s ease;
  box-shadow: 0 3px 10px rgba(0, 121, 107, 0.4);
}

.place-order-btn:hover {
  background-color: #004d40;
  transform: translateY(-3px);
  box-shadow: 0 6px 16px rgba(0, 77, 64, 0.6);
}

/* Footer Link Area (Below Container) */
.footer-link {
  max-width: 1100px;
  width: 100%;
  margin: 30px auto 60px auto;
  padding: 20px;
  background-color: #004d40;
  border-radius: 10px;
  text-align: center;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  box-sizing: border-box;
  color: #e0f2f1;
  font-size: 16px;
  box-shadow: 0 5px 15px rgba(0, 77, 64, 0.5);
}

.footer-link a {
  color: #80cbc4;
  text-decoration: underline;
  font-weight: 600;
  transition: color 0.3s ease;
}

.footer-link a:hover {
  color: #b2dfdb;
  text-decoration: none;
}

/* Responsive */
@media (max-width: 992px) {
  .container {
    flex-direction: column;
    padding: 20px;
  }
  .right-side {
    border-left: none;
    padding-left: 0;
    margin-top: 40px;
  }
}

@media (max-width: 480px) {
  .submit-btn {
    font-size: 16px;
    padding: 12px 0;
  }
  .product-table img {
    width: 50px;
    height: 50px;
  }
  .product-title {
    font-size: 14px;
  }
  .product-price {
    font-size: 14px;
  }
  .place-order-btn {
    padding: 10px 20px;
    font-size: 14px;
  }
  .footer-link {
    font-size: 14px;
    padding: 15px 10px;
  }
}


</style>
</head>
<body>

  
</body>
</html>
