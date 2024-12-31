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
    $new_user_id = htmlspecialchars(trim($_POST['candidate_id']));  // Ensure the key matches the form input
    $new_password = htmlspecialchars(trim($_POST['pin_code'])); // Ensure the key matches the form input

    // Validate input
    if (!empty($new_user_id) && !empty($new_password)) {
        // Check if the user already exists in the database
        $sql = "SELECT * FROM candidates WHERE candidate_id = :candidate_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['candidate_id' => $new_user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // User already exists
            $error_message = "Candidate ID already exists. You can only submit once.";
        } else {
            // Hash the password before storing
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Insert new user into the database
            $sql = "INSERT INTO candidates (candidate_id, pin_code) VALUES (:candidate_id, :pin_code)";
            $stmt = $conn->prepare($sql);
            $stmt->execute(['candidate_id' => $new_user_id, 'pin_code' => $hashed_password]);

            // Redirect after successful insertion
            $success_message = "Candidate added successfully!";
            header("Location: candidateinput.php"); // redirect to a success page
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
    <title>Candidate Nomination</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #ff7e5f, #feb47b);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        .nomination-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            width: 350px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        h2 {
            margin-bottom: 25px;
            color: #333;
            font-size: 24px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 15px;
            color: #444;
            font-weight: 600;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            font-size: 15px;
            border: 2px solid #ddd;
            border-radius: 10px;
            outline: none;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #ff7e5f;
            box-shadow: 0 0 10px rgba(255, 126, 95, 0.5);
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #43cea2, #185a9d);
            color: #fff;
            font-size: 17px;
            font-weight: 600;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .submit-btn:hover {
            background: linear-gradient(135deg, #2ecc71, #27ae60);
            transform: translateY(-3px);
        }

        .submit-btn:active {
            transform: translateY(1px);
            background: linear-gradient(135deg, #27ae60, #16a085);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .message {
            margin-bottom: 15px;
            color: red;
        }

        .success {
            color: green;
        }
    </style>
</head>
<body>
    <div class="nomination-container">
        <h2>Candidate Nomination</h2>
        <form action="" method="POST">
            <div class="input-group">
                <label for="candidate_id">Candidate ID</label>
                <input type="text" id="candidate_id" name="candidate_id" placeholder="Enter Candidate ID" required>
            </div>
            <div class="input-group">
                <label for="pin-code">PIN Code</label>
                <input type="password" id="pin-code" name="pin_code" placeholder="Enter PIN Code" required>
            </div>
            <button type="submit" class="submit-btn" name="add_user">Submit Nomination</button>
        </form>
        <?php if (isset($success_message)) echo "<p class='success'>$success_message</p>"; ?>
        <?php if (isset($error_message)) echo "<p class='message'>$error_message</p>"; ?>
    </div>
</body>
</html>
