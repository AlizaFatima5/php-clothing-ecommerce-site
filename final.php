<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order Confirmation</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background: linear-gradient(to right, #74ebd5, #acb6e5);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .confirmation-box {
      background: white;
      padding: 40px;
      border-radius: 20px;
      text-align: center;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      animation: fadeIn 1s ease-in-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.95); }
      to { opacity: 1; transform: scale(1); }
    }

    .confirmation-box h1 {
      font-size: 28px;
      color: #4CAF50;
      margin-bottom: 20px;
      animation: popIn 0.6s ease forwards;
    }

    @keyframes popIn {
      0% { opacity: 0; transform: scale(0.8); }
      100% { opacity: 1; transform: scale(1); }
    }

    .confirmation-box p {
      font-size: 18px;
      color: #333;
      margin-bottom: 30px;
    }

    .confirmation-box a {
      display: inline-block;
      text-decoration: none;
      background: #4CAF50;
      color: white;
      padding: 12px 25px;
      border-radius: 30px;
      font-size: 16px;
      transition: background 0.3s ease, transform 0.2s ease;
    }

    .confirmation-box a:hover {
      background: #45a049;
      transform: scale(1.05);
    }
  </style>
</head>
<body>

  <div class="confirmation-box">
    <h1>🎉 Order Confirmed!</h1>
    <p>Your order has been placed successfully.</p>
    <a href="index.php">Continue Shopping</a>
  </div>

</body>
</html>
