<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidate Voting</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F0F8FF;
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
            width: 400px;
            text-align: center;
        }
        .aadhaar-card {
            border: 2px solid #4B0082;
            border-radius: 10px;
            padding: 20px;
            background-color: #f9f9f9;
            position: relative;
        }
        .aadhaar-card img {
            border-radius: 50%;
            width: 80px;
            height: 80px;
            position: absolute;
            top: 20px;
            right: 20px;
        }
        h2 {
            color: #4B0082;
            margin-bottom: 20px;
        }
        .detail-item {
            margin: 10px 0;
            text-align: left;
        }
        .navigation {
            display: flex;
            justify-content: space-between;
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
    <div class="container" id="candidateContainer">
        <h2>Candidate Details</h2>
        <div class="aadhaar-card">
            <img id="displayPhoto" src="" alt="Candidate Photo">
            <div class="detail-item">
                <strong>Name:</strong> <span id="displayName"></span>
            </div>
            <div class="detail-item">
                <strong>Branch:</strong> <span id="displayBranch"></span>
            </div>
            <div class="detail-item">
                <strong>ID:</strong> <span id="displayID"></span>
            </div>
            <div class="detail-item">
                <strong>Description:</strong>
                <p id="displayDescription"></p>
            </div>
            <div class="detail-item">
                <strong>Voice Note:</strong>
                <audio controls id="displayVoiceNote">
                    <source id="audioSource" src="" type="audio/mpeg">
                </audio>
            </div>
        </div>
       
        <div class="navigation">
            <button onclick="prevCandidate()">Previous</button>
            <button onclick="voteCandidate()">Vote</button>
            <button onclick="nextCandidate()">Next</button>
        </div>
    </div>

    <script>
        let candidates = JSON.parse(localStorage.getItem('candidates') || '[]');
        let currentIndex = 0;

        function displayCandidate(index) {
            if (candidates.length === 0) {
                document.getElementById('candidateContainer').innerHTML = "<h2>No Candidates Available</h2>";
                return;
            }
            const candidate = candidates[index];
            document.getElementById('displayName').textContent = candidate.name;
            document.getElementById('displayBranch').textContent = candidate.branch;
            document.getElementById('displayID').textContent = candidate.id;
            document.getElementById('displayDescription').textContent = candidate.description;
            document.getElementById('displayPhoto').src = candidate .photo;
            document.getElementById('audioSource').src = candidate.voiceNote;
            document.getElementById('displayVoiceNote').load();
        }

        function voteCandidate() {
            const voterID = prompt("Please enter your Voter ID:");
            if (voterID) {
                // Update the votes in local storage
                let votes = JSON.parse(localStorage.getItem('votes') || '{}');
                votes[candidates[currentIndex].id] = (votes[candidates[currentIndex].id] || 0) + 1;
                localStorage.setItem('votes', JSON.stringify(votes));

                alert(`You voted for ${candidates[currentIndex].name} with Voter ID: ${voterID}`);
            } else {
                alert("Vote cancelled. No Voter ID entered.");
            }
        }

        function nextCandidate() {
            currentIndex = (currentIndex + 1) % candidates.length;
            displayCandidate(currentIndex);
        }

        function prevCandidate() {
            currentIndex = (currentIndex - 1 + candidates.length) % candidates.length;
            displayCandidate(currentIndex);
        }

        window.onload = () => displayCandidate(currentIndex);
    </script>
</body>
</html>