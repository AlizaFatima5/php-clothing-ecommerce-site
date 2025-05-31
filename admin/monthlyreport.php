<?php
include 'config/connection.php';

// Get month filter from GET (format: YYYY-MM), default to current month if empty
$filterMonth = $_GET['month'] ?? date('Y-m');

// Prepare SQL with optional month filtering
$sql = "
    SELECT 
        DATE_FORMAT(c.created_at, '%Y-%m') AS sale_month,
        p.product_title,
        u.fullname AS user_name,
        c.quantity,
        c.created_at
    FROM cart c
    JOIN products p ON c.product_id = p.product_id
    JOIN users u ON c.user_id = u.id
    WHERE DATE_FORMAT(c.created_at, '%Y-%m') = ?
    ORDER BY c.created_at DESC
";

$stmt = $con->prepare($sql);
$stmt->bind_param("s", $filterMonth);
$stmt->execute();
$result = $stmt->get_result();

// Calculate previous month for quick links
$prevMonth = date('Y-m', strtotime("$filterMonth -1 month"));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Monthly Sales Report</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f7f9;
            padding: 30px;
            color: #333;
        }
        h2 {
            margin-bottom: 20px;
            color: #2c3e50;
        }
        .filter-form {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .filter-form label {
            font-weight: 600;
        }
        input[type="month"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        button {
            padding: 9px 18px;
            background: #007bff;
            border: none;
            border-radius: 5px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        button:hover {
            background: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 2px 8px rgb(0 0 0 / 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        thead {
            background: #007bff;
            color: white;
        }
        thead th {
            padding: 12px 15px;
            text-align: left;
            font-weight: 700;
        }
        tbody td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
        }
        tbody tr:hover {
            background: #f1faff;
        }
        .no-records {
            text-align: center;
            padding: 20px;
            color: #777;
        }
        .quick-links {
            margin-bottom: 25px;
        }
        .quick-links a {
            margin-right: 15px;
            text-decoration: none;
            color: #007bff;
            font-weight: 600;
        }
        .quick-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Monthly Sales Report</h2>
    
    <div class="quick-links">
        <a href="?month=<?= date('Y-m') ?>">Current Month</a>
        <a href="?month=<?= $prevMonth ?>">Previous Month</a>
        <a href="?month=all">All Records</a>
    </div>

    <form method="get" class="filter-form">
        <label for="month">Select Month:</label>
        <input type="month" id="month" name="month" value="<?= htmlspecialchars($filterMonth) ?>">
        <button type="submit">Filter</button>
        
    </form>

    <table>
        <thead>
            <tr>
                <th>Sale Month</th>
                <th>Product</th>
                <th>User Name</th>
                <th>Quantity</th>
                <th>Sale Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Handle 'all' case separately
            if ($filterMonth === 'all') {
                $allSql = "
                    SELECT 
                        DATE_FORMAT(c.created_at, '%Y-%m') AS sale_month,
                        p.product_title,
                        u.fullname AS user_name,
                        c.quantity,
                        c.created_at
                    FROM cart c
                    JOIN products p ON c.product_id = p.product_id
                    JOIN users u ON c.user_id = u.id
                    ORDER BY c.created_at DESC
                ";
                $allResult = $con->query($allSql);

                if ($allResult && $allResult->num_rows > 0) {
                    while ($row = $allResult->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['sale_month']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['product_title']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['user_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='no-records'>No sales records found.</td></tr>";
                }

            } else {
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['sale_month']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['product_title']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['user_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='no-records'>No sales records found for this month.</td></tr>";
                }
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php
$con->close();
?>
