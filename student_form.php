<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Signup</title>
    <style>
        /* Body and Background Styling */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: #f0f0f0;
            font-family: Arial, sans-serif;
        }

        /* Container Styling */
        .signup-container {
            width: 100%;
            max-width: 600px; /* Adjust container width for smaller screens */
            padding: 20px;
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            backdrop-filter: blur(10px);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        /* Hover Effect for Container */
        .signup-container:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }

        /* Input Fields and Button Styling */
        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-sizing: border-box;
        }

        /* Button Styling */
        button {
            width: 100%;
            padding: 10px;
            background: #0078d4;
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        /* Button Hover Effect */
        button:hover {
            background: #005fa3;
        }

        /* Grid Layout for Form Fields */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr; /* Two columns */
            gap: 20px;
        }

        /* Full width for fields that should span both columns */
        .full-width {
            grid-column: span 2;
        }

        /* Responsive Design for Smaller Screens */
        @media (max-width: 600px) {
            .form-grid {
                grid-template-columns: 1fr; /* Switch to single column layout */
            }
        }
    </style>
</head>
<body>

<div class="signup-container">
    <h2>Student Signup</h2>
    <form id="studentForm" action="submit_student.php" method="POST">
        <!-- Grid Container for Form Fields -->
        <div class="form-grid">
            <!-- First Name and Last Name Side by Side -->
            <input type="text" name="studentid" placeholder="student id" required>
            <input type="text" name="first_name" placeholder="First Name" required>
            <input type="text" name="last_name" placeholder="Last Name" required>

            <!-- Email and Password Side by Side -->
            <input type="text" name="Email" placeholder="Email" required>
            <input type="text" name="password" placeholder="Password" required>

            <!-- Phone and Gender Side by Side -->
            <input type="text" name="Phone" placeholder="Phone" required>
            <select name="gender" required>
                <option value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>

            <!-- Class and Department Side by Side -->
            <select id="classSelect" name="Class" required>
                <option value="">Select Class</option>
            </select>
            <select id="departmentSelect" name="department" required>
                <option value="">Select Department</option>
                <option value="comp">Computer Science</option>
                <option value="cyber">Cyber Security</option>
                <option value="civil">Civil Engineering</option>
                <option value="mechani">Mechanical Engineering</option>
                <option value="oil & gas">Oil & Gas</option>
            </select>

            <!-- Course Field Takes Full Width -->
            <select id="courseSelect" name="course" required >
                <option value="">Select Course</option>
            </select>

            <!-- Submit Button Takes Full Width -->
            <button type="submit" class="full-width">Create Account</button>
        </div>
    </form>
</div>

<script>
    // Object containing courses for each department
    const departmentCourses = {
        "comp": ["Introduction to Computer Science", "Data Structures", "Algorithms", "Operating Systems"],
        "civil": ["Structural Analysis", "Geotechnical Engineering", "Fluid Mechanics"],
        "cyber": ["Cybersecurity Basics", "Network Security", "Cryptography"],
        "mechani": ["Thermodynamics", "Fluid Mechanics", "Machine Design"],
        "oil & gas": ["Petroleum Geology", "Reservoir Engineering", "Drilling Engineering"]
    };

    const classes = {
        "comp": "BENG",
        "cyber": "BENG",
        "civil": "OD",
        "mechani": "OD",
        "oil & gas": "OD"
    };

    // Add event listener to update classes and courses based on department selection
    const departmentSelect = document.getElementById('departmentSelect');
    const classSelect = document.getElementById('classSelect');
    const courseSelect = document.getElementById('courseSelect');

    departmentSelect.addEventListener('change', function() {
        const selectedDepartment = this.value;
        classSelect.innerHTML = '<option value="">Select Class</option>'; // Clear previous options
        courseSelect.innerHTML = '<option value="">Select Course</option>'; // Clear previous options

        if (selectedDepartment) {
            // Populate the class dropdown
            const classValue = classes[selectedDepartment];
            const option = document.createElement('option');
            option.value = classValue;
            option.textContent = classValue;
            classSelect.appendChild(option);

            // Populate the course dropdown with courses for the selected department
            if (departmentCourses[selectedDepartment]) {
                departmentCourses[selectedDepartment].forEach(course => {
                    const option = document.createElement('option');
                    option.value = course;
                    option.textContent = course;
                    courseSelect.appendChild(option);
                });
            }
        }
    });
</script>

</body>
</html>
