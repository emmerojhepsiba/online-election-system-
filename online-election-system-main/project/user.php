<?php
// Database configuration
$host = 'localhost';
$dbname = 'mydatabase';
$username = 'root'; // Default XAMPP MySQL username
$password = '';     // Default XAMPP MySQL password (empty)

// Create a database connection
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Handle form submission for adding a new user
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_user'])) {
    // Corrected variable names from $_POST
    $new_user_id = htmlspecialchars(trim($_POST['user_Id']));  // Ensure the key matches the form input
    $new_password = htmlspecialchars(trim($_POST['password'])); // Ensure the key matches the form input

    // Validate input
    if (!empty($new_user_id) && !empty($new_password)) {
        // Check if the user already exists in the database
        $sql = "SELECT * FROM users WHERE user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['user_id' => $new_user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // User already exists
            $error_message = "User ID already exists. You can only submit once.";
        } else {
            // Hash the password before storing
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Insert new user into the database
            $sql = "INSERT INTO users (user_id, password) VALUES (:user_id, :password)";
            $stmt = $conn->prepare($sql);
            $stmt->execute(['user_id' => $new_user_id, 'password' => $hashed_password]);

            // Redirect after successful insertion
            $success_message = "User added successfully!";
            header("Location: logininput.php"); // redirect to a success page
            exit();
        }
    } else {
        $error_message = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Voting System</title>
    <style>
        body {
            background: linear-gradient(135deg, #ff7e5f, #feb47b);
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            width: 350px;
            text-align: center;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #666;
            font-size: 14px;
            text-align: left;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            transition: border 0.3s;
        }
        input:focus {
            border-color: #007bff;
        }
        button {
            background: linear-gradient(90deg, #36d1dc, #5b86e5);
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        button:hover {
            background: linear-gradient(90deg, #5b86e5, #36d1dc);
        }
        .container {
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>User Vote</h2>
        <form action="" method="post">
            <label for="user_Id">User ID:</label>
            <input type="text" id="user_Id" name="user_Id" placeholder="Enter your User ID" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your Password" required>

            <button type="submit" name="add_user">Submit</button>
        </form>
        <?php if (isset($error_message)) echo "<p style='color:red;'>$error_message</p>"; ?>
        <?php if (isset($success_message)) echo "<p>$success_message</p>"; ?>
    </div>
</body>
</html>