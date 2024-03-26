<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "epitome244";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Array to store the correct answers from the database
$correctAnswers = array();

// Retrieve correct answers from the database
$sql = "SELECT correct_answer FROM oop_mcqs";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($correctAnswers, $row['correct_answer']);
    }
} else {
    echo "Error retrieving correct answers: " . $conn->error;
}
$userAnswers = array();

for ($i = 1; $i <= 5; $i++) {
    $answer = isset($_POST["q$i"]) ? $_POST["q$i"] : "x"; // Assign "x" if not set
    array_push($userAnswers, $answer);
}

// Compare user answers with correct answers
$correctCount = 0;
$totalQuestions = count($correctAnswers);

for ($i = 0; $i < $totalQuestions; $i++) {
    if ($userAnswers[$i] === $correctAnswers[$i]) {
        $correctCount++;
    }
}

// Calculate percentage
$percentage = ($correctCount / $totalQuestions) * 100;

// Display results with CSS styling
echo "
<!DOCTYPE html>
<html lang='en'>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .result-container {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px auto;
            max-width: 600px;
            margin-top:200px;
        }

        h1 {
            color: #333;
        }

        p {
            margin: 10px 0;
        }

        button {
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #555;
        }

        .pass {
            color: green;
        }

        .fail {
            color: red;
        }

        a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        body {
            background: url('background-image.jpg') no-repeat center center fixed;
            background-size: cover;
            background-color: blanchedalmond;
        }
    </style>
</head>
<body>
    <div class='result-container'>
        <h1>Quiz Result</h1>";

if ($percentage >= 60) {
    echo "<p class='pass'><strong>Congratulations! You passed the quiz!</strong></p>";
} else {
    echo "<p class='fail'><strong>Sorry, you didn't pass the quiz. Better luck next time.</strong></p>";
}

echo "<p>You got $correctCount out of $totalQuestions questions correct.</p>";
echo "<p>Your percentage: $percentage%</p>";
echo "<button onclick='window.location.href = \"javatopics.html\";'>Go Back</button>";
echo "<p><a href='https://www.youtube.com/watch?v=KkRn67klEIw'>Refer a YouTube video</a></p>
    </div>
</body>
</html>";

$conn->close();
?>
