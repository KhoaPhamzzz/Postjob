<!-- postjobprocess.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Khoa Pham" />
    <title>Post Job Vacancy</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
<div class="container">
<div class="center">
    <h1>Process Page</h1>

    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $positionId = $_POST["positionId"];
    $title = $_POST["title"];
    $description = $_POST["description"];
    $closingDate = $_POST["closingDate"];
    $location = $_POST["location"];

    
    // Check if acceptBy field is set in $_POST array
    if (isset($_POST["acceptBy"]) && isset($_POST["position"]) && isset($_POST["contract"])) {
        $acceptBy = $_POST["acceptBy"];
        $position = $_POST["position"];
        $contract = $_POST["contract"];
    
    } else {
        // Handle the error, e.g. display an error message
        echo "</br>";  
        echo "</br>";  
        echo "Error: All fields are mandatory. Please fill in all fields.";
        echo "</br>";  
        echo "</br>";  
        echo "</br>";  
        echo "<br><a href='index.php'>Return to Home Page</a>";
        echo "<br><a href='postjobform.php'>Return to Post Job Vacancy page</a>";
        exit; // stop further execution of the code
    }
    

    // Check if all fields are filled
    if (empty($positionId) || empty($title) || empty($description) || empty($closingDate) || empty($position) || empty($contract) || empty($acceptBy) || empty($location)) {
        echo "</br>";  
        echo "</br>";
        echo "Error: All fields are mandatory. Please fill in all fields.";
        echo "</br>";  
        echo "</br>";  
        echo "</br>"; 
        echo "<br><a href='index.php'>Return to Home Page</a>";
        echo "<br><a href='postjobform.php'>Return to Post Job Vacancy page</a>";
        exit;
    }

    // Validate Title format
    if (!preg_match('/^[A-Za-z0-9 ,.!]*$/', $title)) {
        echo "</br>";
        echo "</br>";
        echo "Error: Title can only contain alphanumeric characters, spaces, commas, periods, and exclamation marks.";
        echo "</br>";
        echo "</br>";
        echo "</br>";
        echo "<br><a href='index.php'>Return to Home Page</a>";
        echo "<br><a href='postjobform.php'>Return to Post Job Vacancy page</a>";
        exit;
    }

    // Validate Position ID format
    if (!preg_match('/^P\d{4}$/', $positionId)) {
        echo "</br>";
        echo "</br>";
        echo "Error: Position ID must start with 'P' followed by 4 digits.";
        echo "</br>";
        echo "</br>";
        echo "</br>";
        echo "<br><a href='index.php'>Return to Home Page</a>";
        echo "<br><a href='postjobform.php'>Return to Post Job Vacancy page</a>";
        exit;
    }

    // Validate date format
    $dateRegex = '/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/\d{2}$/';
    if (!preg_match($dateRegex, $closingDate)) {
        echo "</br>";  
        echo "</br>";  
        echo "Error: Closing Date must be in dd/mm/yy format.";
        echo "</br>";  
        echo "</br>";  
        echo "</br>";  
        echo "<br><a href='index.php'>Return to Home Page</a>";
        echo "<br><a href='postjobform.php'>Return to Post Job Vacancy page</a>";
        exit;
    }

    // Check for uniqueness of Position ID
    $jobsFile = "../../data/jobposts/jobs.txt";
    if (file_exists($jobsFile)) {
        $jobsData = file($jobsFile, FILE_IGNORE_NEW_LINES);
        foreach ($jobsData as $job) {
            $jobData = explode("\t", $job);
            if ($jobData[0] == $positionId) {
                echo "</br>";  
                echo "</br>";  
                echo "Error: Position ID already exists. Please choose a different Position ID.";
                echo "</br>";  
                echo "</br>";  
                echo "</br>";  
                echo "<br><a href='index.php'>Return to Home Page</a>";
                echo "<br><a href='postjobform.php'>Return to Post Job Vacancy page</a>";
                exit;
            }
        }
    }

    // Create job vacancy record
    $jobRecord = $positionId . "\t" . $title . "\t" . $description . "\t" . $closingDate . "\t" . $position . "\t" . $contract . "\t" . implode(" and ", $acceptBy) . "\t" . $location . "\n";

    // Create jobposts directory if it doesn't exist
    $jobPostsDir = "../../data/jobposts";
    if (!file_exists($jobPostsDir)) {
        mkdir($jobPostsDir, 0777, true);
    }

    // Write job vacancy record to jobs.txt file
    file_put_contents($jobsFile, $jobRecord, FILE_APPEND | LOCK_EX);

    // Display success message
    echo "</br>";  
    echo "</br>";  
    echo "Job vacancy posted successfully.";
    echo "</br>";  
    echo "</br>";  
    echo "</br>"; 
    echo "<br><a href='index.php'>Return to Home Page</a>";
    echo "<br><a href='postjobform.php'>Return to Post Job Vacancy page</a>";
} else {
    echo "</br>";  
    echo "</br>";  
    echo "Error: Invalid request.";
    echo "</br>";  
    echo "</br>";  
    echo "</br>"; 
    echo "<br><a href='index.php'>Return to Home Page</a>";
    echo "<br><a href='postjobform.php'>Return to Post Job Vacancy page</a>";
}
?>
</div>
</div>
</body>
</html>