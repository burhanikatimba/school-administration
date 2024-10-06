<?php
include 'conect.php'; // Include the database connection

// Fetch students from the database
$sql = "SELECT * FROM Students";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Students</title>
    <style>
        /* Reset and Box Sizing */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
        }

        .container {
            background-color: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 1000px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 500;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        table th, table td {
            padding: 15px;
            text-align: left;
            color: #333;
        }

        table thead {
            background-color: #0078d4;
            color: white;
        }

        table tbody tr:nth-child(even) {
            background-color: #f3f3f3;
        }

        table tbody tr:hover {
            background-color: #eef4fa;
        }

        table td a {
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 500;
        }

        .btn-warning {
            background-color: #f4c542;
            color: white;
            margin-right: 5px;
        }

        .btn-danger {
            background-color: #d9534f;
            color: white;
        }

        .btn-warning:hover, .btn-danger:hover {
            opacity: 0.85;
        }

        @media (max-width: 768px) {
            .container {
                width: 100%;
            }

            table, th, td {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Student List</h1>
        <table>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['FirstName'] . "</td>";
                        echo "<td>" . $row['LastName'] . "</td>";
                        echo "<td>" . $row['Email'] . "</td>";
                        echo "<td>
                                <a href='update_student.php?id=" . $row['UserID'] . "' class='btn btn-warning'>Update</a>
                                <a href='delete_student.php?id=" . $row['UserID'] . "' class='btn btn-danger'>Delete</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No students found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
