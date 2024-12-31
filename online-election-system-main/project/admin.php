<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $secretId = $_POST['secretId'];
    $validSecretId = 'j3j7k8l0l2m0'; // Correct Admin Secret ID

    if ($secretId === $validSecretId) {
        $_SESSION['loggedin'] = true; // Set session variable
        header('Location: admin_internal_page.php'); // Redirect to Admin Internal Page
        exit();
    } else {
        $errorMessage = "Invalid ID, please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Online Voting System</title>
    <style>
        /* Your existing styles here */
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Admin Secret ID Login</h2>
        <form method="POST" action="">
            <label for="secretId">Admin Secret ID</label>
            <input type="text" id="secretId" name="secretId" placeholder="Enter Admin Secret ID" required>
            <button type="submit">Login</button>
            <?php if (isset($errorMessage)): ?>
                <p class="error"><?php echo $errorMessage; ?></p>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
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
        .login-container {
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
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>

</html>