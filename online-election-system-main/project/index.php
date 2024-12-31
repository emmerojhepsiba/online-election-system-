<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Web Page</title>
    <style>
        body {
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #f0f8ff; /* Soft background color */
}

header {
    text-align: center;
    padding: 20px;
    background-color: #8e44ad; /* Purple header */
    color: white;
}

nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    background-color: white;
}

.button-container {
    display: flex;
    justify-content: center;
    flex-grow: 1;
    position: relative;
    margin-right:15px;
}

button {
    margin: 0 10px;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    background-color: #3498db; /* Vibrant blue */
    color: white;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #2980b9; /* Darker blue on hover */
}

/* Help button aligned to the right */
button.help {
    margin-left: auto;
    background-color: #e74c3c; /* Red for Help button */
}

button.help:hover {
    background-color: #c0392b; /* Darker red on hover */
}

footer {
    text-align: center;
    padding: 20px;
    background-color: #34495e; /* Dark gray-blue footer */
    color:white;
}
</style>
</head>
<body>
    <header>
        <h1>Welcome to Our Voting Website</h1>
    </header>

    <nav>
        <div class="button-container">
            <a href="user.php">User&nbsp&nbsp</a>
            <a href="candidate.php">Candidate&nbsp&nbsp</a>
            <a href="admin.php">Admin</a>
        </div>
        <a class="help" href="help.php">Help</a>
    </nav>

    <img src="https://electionbuddy.com/wp-content/uploads/2022/01/Voting-image-6-scaled.jpg" height="500px" width="100%" alt="Voting Image">

    <footer>
        <p>© 2024 Our Website</p>
    </footer>
</body>
</html>