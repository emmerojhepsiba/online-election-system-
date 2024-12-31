<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidate Entry Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #FFB6C1, #87CEFA);
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 300px;
            text-align: center;
        }
        .container h2 {
            color: #4B0082;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
        }
        .form-group input[type="text"],
        .form-group textarea,
        .form-group input[type="file"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            border: none;
            color: white;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Enter Candidate Details</h2>
        <form id="candidateForm" onsubmit="saveCandidate(); return false;">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="branch">Branch:</label>
                <input type="text" id="branch" name="branch" required>
            </div>
            <div class="form-group">
                <label for="id">ID:</label>
                <input type="text" id="id" name="id" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="photo">Upload Photo:</label>
                <input type="file" id="photo" name="photo" accept="image/*" required>
            </div>
            <div class="form-group">
                <label for="voiceNote">Upload Voice Note:</label>
                <input type="file" id="voiceNote" name="voiceNote" accept="audio/*" required>
            </div>
            <div class="form-group">
                <button type="submit">Submit</button>
            </div>
        </form>
        <p id="successMessage" style="color: green; display: none;">Successfully submitted!</p>
    </div>

    <script>
        function saveCandidate() {
            const candidates = JSON.parse(localStorage.getItem('candidates') || '[]');
            const candidate = {
                name: document.getElementById('name').value,
                branch: document.getElementById('branch').value,
                id: document.getElementById('id').value,
                description: document.getElementById('description').value,
                photo: URL.createObjectURL(document.getElementById('photo').files[0]),
                voiceNote: URL.createObjectURL(document.getElementById('voiceNote').files[0])
            };
            candidates.push(candidate);
            localStorage.setItem('candidates', JSON.stringify(candidates));
            document.getElementById('successMessage').style.display = 'block';
            setTimeout(() => document.getElementById('successMessage').style.display = 'none', 2000);
            document.getElementById('candidateForm').reset();
        }
    </script>
</body>
</html>