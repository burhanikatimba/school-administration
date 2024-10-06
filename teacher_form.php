<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Signup</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: #f0f0f0;
            font-family: Arial, sans-serif;
        }
        .form-container {
            width: 400px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            backdrop-filter: blur(10px);
        }
        input, select, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-sizing: border-box;
        }
        button {
            background: #0078d4;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background: #005fa3;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Teacher Signup</h2>
    <form action="submit_teacher.php" method="POST">
        <input type="text" name="teacherid" placeholder="teacher id" required>
        <input type="text" name="first_name" placeholder="First Name" required>
        <input type="text" name="last_name" placeholder="Last Name" required>
        <input type="text" name="email" placeholder="Email" required>
        <input type="text" name="password" placeholder="password" required>
        <input type="text" name="phone" placeholder="Phone" required>
        <select name="gender" required>
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>
    
        <select name="department" required>
            <option value="">Select Department</option>
            <option value="comp">Computer Science</option>
            <option value="civil">Civil Engineering</option>
            <option value="cyber">Cybersecurity</option>
            <option value="mechani">Mechanical Engineering</option>
            <option value="oil & gas">Oil & Gas</option>
        </select>
        <button type="submit">Submit</button>
    </form>
</div>

</body>
</html>
