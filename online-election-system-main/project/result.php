<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F0F8FF;
            color: #333;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow: hidden;
        }
        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            overflow: auto;
        }
        h2 {
            color: #4B0082;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #4B0082;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #d1c4e9;
        }
        .navigation {
            margin-top: 20px;
        }
        button {
            background-color: #4B0082;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }
        button:hover {
            background-color: #5a0085;
        }
    </style>
</head>
<body>
    <h2>Voting Results</h2>
    <table id="resultsTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Branch</th>
                <th>Name</th>
                <th>Votes</th>
            </tr>
        </thead>
        <tbody id="resultsContainer"></tbody>
    </table>
    <div class="navigation">
        <button onclick="clearVotes()">Clear Votes</button>
    </div>

    <script>
        // Retrieve candidates and votes from localStorage
        let candidates = JSON.parse(localStorage.getItem('candidates') || '[]');
        let votes = JSON.parse(localStorage.getItem('votes') || '{}');

        // Display results function
        function displayResults() {
            const resultsContainer = document.getElementById('resultsContainer');
            resultsContainer.innerHTML = ''; // Clear previous results

            // Check if there are any votes stored
            if (Object.keys(votes).length === 0) {
                resultsContainer.innerHTML = "<tr><td colspan='4'>No votes recorded yet.</td></tr>";
                return;
            }

            // Only display candidates who have received at least one vote
            candidates.forEach(candidate => {
                const candidateVotes = votes[candidate.id] || 0;
                if (candidateVotes > 0) { // Display only candidates with votes
                    const candidateRow = document.createElement('tr');
                    candidateRow.innerHTML = `
                        <td>${candidate.id}</td>
                        <td>${candidate.branch}</td>
                        <td>${candidate.name}</td>
                        <td>${candidateVotes}</td>
                    `;
                    resultsContainer.appendChild(candidateRow);
                }
            });

            // If no candidates have votes, display a message
            if (resultsContainer.innerHTML === '') {
                resultsContainer.innerHTML = "<tr><td colspan='4'>No candidates have received votes yet.</td></tr>";
            }
        }

        // Function to clear votes and reset data
        function clearVotes() {
            if (confirm("Are you sure you want to clear all votes? This action cannot be undone.")) {
                // Remove votes from localStorage
                localStorage.removeItem('votes');
                alert("All votes have been cleared.");
                // Clear the displayed results in the table
                const resultsContainer = document.getElementById('resultsContainer');
                resultsContainer.innerHTML = "<tr><td colspan='4'>No votes recorded yet.</td></tr>"; // Reset the table
            }
        }

        // Call displayResults when the page loads
        window.onload = displayResults;
    </script>
</body>
</html>
