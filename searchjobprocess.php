<!DOCTYPE html>
<html>
<head>
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Khoa Pham" />
    <title>Search Job Vacancy Result</title>
    <link rel="stylesheet" href="style/stylesearch.css">
</head>
<body>
<div class="container">
    <h1>Search Job Vacancy Result</h1>
    <br>
    <br>
    <?php
// Check if parameters are set in the query string
if(isset($_GET['jobTitle']) && isset($_GET['jobPosition']) && isset($_GET['jobContract']) && isset($_GET['jobApplication']) && isset($_GET['jobLocation'])) {
    // Sanitize the input by removing any HTML tags and trimming whitespace
    $jobTitle = strip_tags(trim($_GET['jobTitle']));
    $jobPosition = strip_tags(trim($_GET['jobPosition']));
    $jobContract = strip_tags(trim($_GET['jobContract']));
    $jobApplication = strip_tags(trim($_GET['jobApplication']));
    $jobLocation = strip_tags(trim($_GET['jobLocation']));

    // Check if both the job title is empty
    if(empty($jobTitle)) {
        echo "<p>Error: Please enter a job title</p>";
        echo "<br><a href='index.php'>Return to Home Page</a>";
        echo "<br><a href='searchjobform.php'>Return to Search Job Vacancy page</a>";
    } else {
        // Check if the jobs.txt file exists
        if(file_exists("../../data/jobposts/jobs.txt")) {
            // Read the contents of the jobs.txt file
            $jobVacancies = file("../../data/jobposts/jobs.txt", FILE_IGNORE_NEW_LINES);
            $matches = array();

            // Get the current date
            $currentDate = date('d/m/y');

            // Loop through each job vacancy record and search for matches
            foreach($jobVacancies as $jobVacancy) {
                // Split the job vacancy record by "\t" to get job details
                $jobDetails = explode("\t", $jobVacancy);

                // Check if the closing date is greater than or equal to the current date
                $closingDate = DateTime::createFromFormat('d/m/y', $jobDetails[3]);
                if($closingDate >= DateTime::createFromFormat('d/m/y', $currentDate)) {
                    // Check for a case-insensitive match of the search fields
                    if((empty($jobTitle) || stripos($jobDetails[1], $jobTitle) !== false) && (empty($jobPosition) || stripos($jobDetails[4], $jobPosition) !== false) && (empty($jobContract) || stripos($jobDetails[5], $jobContract) !== false) && (empty($jobApplication) || stripos($jobDetails[6], $jobApplication) !== false) && (empty($jobLocation) || stripos($jobDetails[7], $jobLocation) !== false)) {
                        $matches[] = $jobVacancy; // Store the matching job vacancy record
                    }
                }
            }

            // Check if any matches were found
            if(!empty($matches)) {
                // Sort the matches array by date in ascending order
                usort($matches, function($a, $b) {
                    $aDetails = explode("\t", $a);
                    $bDetails = explode("\t", $b);
                    $aDate = DateTime::createFromFormat('d/m/y', $aDetails[3]);
                    $bDate = DateTime::createFromFormat('d/m/y', $bDetails[3]);
                    return $aDate->format('Ymd') - $bDate->format('Ymd');
                });

                // Loop through the matches and display them as separate lines with job details
                foreach($matches as $match) {
                    // Split the job vacancy record by "\t" to get job details
                    $jobDetails = explode("\t", $match);
                    
                    echo "<p>";
                    echo "<strong>Job Title: </strong>" . $jobDetails[1] . "<br>"; // Job Title
                    echo "<strong>Description: </strong>" . $jobDetails[2] . "<br>"; // Description
                    echo "<strong>Closing Date: </strong>" . $jobDetails[3] . "<br>"; // Closing Date
                    echo "<strong>Position: </strong>" . $jobDetails[4] . " - " . $jobDetails[5] . "<br>"; // Position (concatenating both 4 and 5)
                    echo "<strong>Application By: </strong>" . $jobDetails[6] . "<br>"; // Application By
                    echo "<strong>Location: </strong>" . $jobDetails[7] . "<br>"; // Location
                    echo "</p>";
                }
                } else {
                    echo "<p>No matching job vacancies found.</p>";
                }

                echo "<br><a href='index.php'>Return to Home Page</a>";
                echo "<br><a href='searchjobform.php'>Return to Search Job Vacancy page</a>";
            } else {
                echo "<p>Error: Jobs data file not found</p>";
                echo "<br><a href='index.php'>Return to Home Page</a>";
                echo "<br><a href='searchjobform.php'>Return to Search Job Vacancy page</a>";
            }
        }
    } else {
        echo "<p>Error: Invalid search parameters</p>";
        echo "<br><a href='index.php'>Return to Home Page</a>";
        echo "<br><a href='searchjobform.php'>Return to Search Job Vacancy page</a>";
    }
    ?>
</div>
</body>
</html>