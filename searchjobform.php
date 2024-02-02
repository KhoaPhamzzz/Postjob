<!DOCTYPE html>
<html>
<head>
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Khoa Pham" />
    <title>Search Job Vacancy</title>
    <link rel="stylesheet" href="style/stylesearchtwo.css">
</head>
<body>
<div class="container">
    <h1>Search Job Vacancy</h1>
    <form action="searchjobprocess.php" method="GET">

    <div class="form-group">
        <label for="jobTitle">Job Title:</label>
        <input type="text" id="jobTitle" name="jobTitle" placeholder="e.g. IT">
    </div>

    <div class="form-group">
        <label for="jobPosition">Position:</label>
        <input type="text" id="jobPosition" name="jobPosition" placeholder="e.g. Full Time or Part Time">
    </div>

    <div class="form-group">
        <label for="jobContract">Contract:</label>
        <input type="text" id="jobContract" name="jobContract" placeholder="e.g. Fixed term or On-going">
    </div>

    <div class="form-group">
        <label for="jobApplication">Application Type:</label>
        <input type="text" id="jobApplication" name="jobApplication" placeholder="e.g. Post or Email">
    </div>

    <div class="form-group">
        <label for="jobLocation">Location:</label>
        <input type="text" id="jobLocation" name="jobLocation" placeholder="e.g. VIC">
    </div>
        
    <div class="form-grouptwo">    
    <input type="submit" value="Search">
    </div>
       
        <a id="returnhome" href="index.php">Return to Home Page</a>
    </form>
</div>
</body>
</html>
