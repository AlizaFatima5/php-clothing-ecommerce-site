<?php
include 'config/connection.php';

// Search input values
$search_id = $_GET['search_id'] ?? '';
$search_name = $_GET['search_name'] ?? '';

// Query for searched record
$searchedResult = null;
$exclude_ids = [];

if (!empty($search_id) || !empty($search_name)) {
    $conditions = [];
    if (!empty($search_id)) $conditions[] = "id = '" . $con->real_escape_string($search_id) . "'";
    if (!empty($search_name)) $conditions[] = "fullname LIKE '%" . $con->real_escape_string($search_name) . "%'";
    $where = implode(" AND ", $conditions);

    $sqlSearch = "SELECT * FROM users WHERE $where";
    $searchedResult = $con->query($sqlSearch);

    // Store matched IDs to exclude from full list later
    if ($searchedResult && $searchedResult->num_rows > 0) {
        while ($row = $searchedResult->fetch_assoc()) {
            $matchedRows[] = $row;
            $exclude_ids[] = $row['id'];
        }
    }
}

// Main query to get all users excluding searched ones (if any)
$sql = "SELECT * FROM users";
if (!empty($exclude_ids)) {
    $exclude_sql = implode(",", array_map('intval', $exclude_ids));
    $sql .= " WHERE id NOT IN ($exclude_sql)";
}
$result = $con->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Registers</title>
    <link rel="stylesheet" href="css/view_register.css">
    <style>
        /* Reset defaults */
body, h2, table, input, button, a {
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    box-sizing: border-box;
}

/* Body styling */
body {
    background-color: #f9f9fb;
    padding: 30px;
    color: #333;
}

/* Heading */
h2 {
    margin-bottom: 20px;
    color: #2c3e50;
}

/* Search form */
form {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-bottom: 20px;
}

input[type="text"] {
    padding: 8px 12px;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 180px;
    transition: border-color 0.3s;
}

input[type="text"]:focus {
    border-color: #3498db;
    outline: none;
}

button {
    padding: 8px 16px;
    background-color: #3498db;
    border: none;
    color: white;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #2980b9;
}

/* Add button */
.add-btn {
    display: inline-block;
    margin-bottom: 20px;
    background-color: #27ae60;
    color: white;
    padding: 8px 14px;
    border-radius: 5px;
    text-decoration: none;
    transition: background-color 0.3s;
}

.add-btn:hover {
    background-color: #1e8449;
}

/* Table styling */
table {
    width: 100%;
    border-collapse: collapse;
    background-color: white;
    box-shadow: 0 0 8px rgba(0, 0, 0, 0.05);
    border-radius: 6px;
    overflow: hidden;
}

thead {
    background-color: #34495e;
    color: white;
}

th, td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #ecf0f1;
}

tbody tr:nth-child(even) {
    background-color: #f4f6f8;
}

tbody tr:hover {
    background-color: #eaf2f8;
}

/* Highlight searched row */
tr[style*="background-color: #eafaf1"] {
    background-color: #d6eaf8 !important;
    font-weight: 600;
}

/* Action links */
td a {
    color: #2980b9;
    text-decoration: none;
    margin-right: 8px;
}

td a:hover {
    text-decoration: underline;
}

    </style>
</head>
<body>

<h2>Users List</h2>

<!-- 🔍 Search Bar -->
<form method="GET" style="margin-bottom: 20px;">
    <input type="text" name="search_id" placeholder="Search by ID" value="<?php echo htmlspecialchars($search_id); ?>">
    <input type="text" name="search_name" placeholder="Search by Name" value="<?php echo htmlspecialchars($search_name); ?>">
    <button type="submit">🔍 Search</button>
    <a href="viewRegister.php" style="margin-left:10px;">Reset</a>
</form>

<a href="add_user.php" class="add-btn">➕ Add New Admin/User</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Password</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <!-- 🔝 Show searched results on top -->
        <?php if (!empty($matchedRows)): ?>
            <?php foreach ($matchedRows as $row): ?>
                <tr style="background-color: #eafaf1; font-weight: bold;">
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['fullname']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['password']; ?></td>
                    <td><?php echo $row['role']; ?></td>
                    <td>
                        <a href="edit_user.php?id=<?php echo $row['id']; ?>">✏️ Edit</a> | 
                        <a href="delete_user.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete?')">🗑️ Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- 🔽 Show all other records -->
        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['fullname']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['password']; ?></td>
            <td><?php echo $row['role']; ?></td>
            <td>
                <a href="edit_user.php?id=<?php echo $row['id']; ?>">✏️ Edit</a> | 
                <a href="delete_user.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete?')">🗑️ Delete</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

</body>
</html>
