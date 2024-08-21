<?php
// 1. Koneksi ke Database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tugas_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 2. Pencarian dan Pengambilan Data
$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

$sql = "SELECT * FROM link_data WHERE title LIKE '%$search%'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pencarian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #343a40;
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        input[type="text"] {
            padding: 10px;
            font-size: 16px;
            width: 300px;
            border: 2px solid #343a40;
            border-radius: 5px;
            margin-right: 10px;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #343a40;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Form Pencarian -->
    <h1>Cari Berdasarkan Title</h1>
    <form method="GET" action="">
        <input type="text" name="search" placeholder="Masukkan kata kunci..." value="<?php echo $search; ?>">
        <button type="submit">Cari</button>
    </form>

    <!-- Tabel Data -->
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>URL</th>
            <th>Description</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['title'] . "</td>";
                echo "<td><a href='" . $row['url'] . "' target='_blank'>" . $row['url'] . "</a></td>";
                echo "<td>" . $row['description'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No results found</td></tr>";
        }
        ?>
    </table>

    <?php
    // Menutup Koneksi
    $conn->close();
    ?>
</body>
</html>
