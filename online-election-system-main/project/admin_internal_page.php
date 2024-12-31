<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidate Voting</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FFFAF0;
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #FFF5EE;
            border: 3px solid #FF4500;
            border-radius: 12px;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.3);
            padding: 20px;
            width: 420px;
            text-align: center;
            color: #333;
        }
        .container h2 {
            color: #FF6347;
            margin-bottom: 15px;
        }
        .detail-item {
            margin: 10px 0;
            color: #4B0082;
        }
        .detail-item img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            border: 2px solid #6A5ACD;
        }
        .navigation {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .action-buttons {
            margin-top: 20px;
            display: flex;
            justify-content: space-around;
        }
        .updated-time {
            font-size: 0.9em;
            color: #FF4500;
            margin-top: 10px;
        }
        button {
            background-color: #4B0082;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        button:hover {
            background-color: #6A5ACD;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container" id="candidateContainer">
        <h2>Candidate Details</h2>
        <div id="updateDate" class="updated-time hidden"></div>
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
            <strong>Photo:</strong>
            <img id="displayPhoto" src="" alt="Candidate Photo">
        </div>
        <div class="detail-item">
            <strong>Voice Note:</strong>
            <audio controls id="displayVoiceNote">
                <source id="audioSource" src="" type="audio/mpeg">
            </audio>
        </div>
        <div class="navigation">
            <button onclick="prevCandidate()">Previous</button>
            <button onclick="nextCandidate()">Next</button>
        </div>
        <div class="action-buttons">
            <button onclick="editCandidate()">Edit</button>
            <button id="saveButton" class="hidden" onclick="saveCandidate()">Save</button><br></br>
            <button onclick="clearCandidate()">Clear</button>
        </div>
        <button onclick="location.href='result.php'">View Results</button><br></br>
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
        document.getElementById('displayPhoto').src = candidate.photo;
        document.getElementById('audioSource').src = candidate.voiceNote;
        document.getElementById('displayVoiceNote').load();
        document.getElementById("updateDate").classList.add("hidden");  // Hide update date initially
    }

    function voteCandidate() {
     alert(`You voted for ${candidates[currentIndex].name}`);
     }


    function nextCandidate() {
        currentIndex = (currentIndex + 1) % candidates.length;
        displayCandidate(currentIndex);
    }

    function prevCandidate() {
        currentIndex = (currentIndex - 1 + candidates.length) % candidates.length;
        displayCandidate(currentIndex);
    }

    function editCandidate() {
        const candidate = candidates[currentIndex];
        const name = prompt("Edit Name:", candidate.name);
        const branch = prompt("Edit Branch:", candidate.branch);
        const id = prompt("Edit ID:", candidate.id);
        const description = prompt("Edit Description:", candidate.description);
        if (name !== null) candidate.name = name;
        if (branch !== null) candidate.branch = branch;
        if (id !== null) candidate.id = id;
        if (description !== null) candidate.description = description;
        displayCandidate(currentIndex);

        document.getElementById("saveButton").classList.remove("hidden");  // Show Save button
    }

    function saveCandidate() {
        localStorage.setItem('candidates', JSON.stringify(candidates));
        alert("Changes saved!");

        const updateDate = new Date().toLocaleString();
        document.getElementById("updateDate").textContent = LastUpdated`${updateDate}`;
        document.getElementById("updateDate").classList.remove("hidden");  // Show update date

        document.getElementById("saveButton").classList.add("hidden");  // Hide Save button
    }

    function clearCandidate() {
        if (confirm("Are you sure you want to clear this candidate's details?")) {
            candidates.splice(currentIndex, 1);
            localStorage.setItem('candidates', JSON.stringify(candidates));
            currentIndex = 0;
            displayCandidate(currentIndex);
        }
    }

    window.onload = () => displayCandidate(currentIndex);

    </script>
</body>
</html>