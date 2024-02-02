<!-- postjobform.php -->

<!DOCTYPE html>
<html>
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
    <h1>Post Job Vacancy</h1>
    <br>
    <br>

    <form method="post" action="postjobprocess.php"> 
      <label for="positionId">Position ID:</label>
      <input type="text" id="positionId" name="positionId" placeholder="e.g. P0001" maxlength="5">
      
     

      <br>
      <br>
      <label for="title">Title:</label>
      <input type="text" id="title" name="title" placeholder="e.g. IT Manager" maxlength="20" d>
      
      <br>
      <br>
      <label for="description">Description:</label>
      <textarea id="description" name="description" placeholder="Maximum 260 characters" rows="4" maxlength="260" ></textarea>
      

      <br>
      <br>
      <label for="closingDate">Closing Date:</label>
      <input type="text" id="closingDate" name="closingDate" value="<?php echo date('d/m/y'); ?>" >
    

      <br>
      <br>
      <label for="position">Position:</label>
      <input type="radio" id="fullTime" name="position" value="Full Time" > Full Time
      <input type="radio" id="partTime" name="position" value="Part Time" > Part Time
    

      <br>
      <br>
      <label for="contract">Contract:</label>
      <input type="radio" id="onGoing" name="contract" value="On-going" > On-going
      <input type="radio" id="fixedTerm" name="contract" value="Fixed term" > Fixed term
     

      <br>
      <br>
      <label>Accept Application by:</label>
      <input type="checkbox" id="post" name="acceptBy[]" value="Post"> Post
      <input type="checkbox" id="email" name="acceptBy[]" value="Email"> Email
      

      <br>
      <br>
      <label for="location">Location:</label>
      <select id="location" name="location">
        <option value="">---</option>
        <option value="ACT">ACT</option>
        <option value="NSW">NSW</option>
        <option value="NT">NT</option>
        <option value="QLD">QLD</option>
        <option value="SA">SA</option>
        <option value="TAS">TAS</option>
        <option value="VIC">VIC</option>
        <option value="WA">WA</option>
      </select>
      

      <br>
      <div class="center"> 
        <input type="submit" value="Submit">
        <input type="reset" value="Reset">
      </div>
    </form>
    <br>
    <br>
    <a id="returnhome" href="index.php">Return to Home Page</a>

</div>
</body>
</html>