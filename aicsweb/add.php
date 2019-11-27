<html>
<head>
	<title>Add Data</title>
</head>

<body>
<?php
//including the database connection file
include_once("config.php");

if(isset($_POST['Submit'])) {	
	$FirstName = $_POST['FirstName'];
	$LastName = $_POST['LastName'];
	$Gender = $_POST['Gender'];
	$DateEnrolled = $_POST['DateEnrolled'];
		
	// checking empty fields
	if(empty($FirstName) || empty($LastName) || empty($Gender) || empty($DateEnrolled)) {
				
		if(empty($FirstName)) {
			echo "<font color='red'>First Name field is empty.</font><br/>";
		}
		
		if(empty($LastName)) {
			echo "<font color='red'>Last Name field is empty.</font><br/>";
		}
		
		if(empty($Gender)) {
			echo "<font color='red'>Gender field is empty.</font><br/>";
		}

		if(empty($DateEnrolled)) {
			echo "<font color='red'>Date Enrolled field is empty.</font><br/>";
		}

		
		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else { 
		// if all the fields are filled (not empty) 
			
		//insert data to database		
		$sql = "INSERT INTO aics(FirstName, LastName, Gender, DateEnrolled) VALUES(:fname, :lname, :gen, :date)";
		$query = $dbConn->prepare($sql);
				
		$query->bindparam(':fname', $FirstName);
		$query->bindparam(':lname', $LastName);
		$query->bindparam(':gen', $Gender);
		$query->bindparam(':date', $DateEnrolled);
		$query->execute();
		
		// Alternative to above bindparam and execute
		// $query->execute(array(':name' => $name, ':email' => $email, ':age' => $age));
		
		//display success message
		echo "<font color='green'>Data added successfully.";
		echo "<br/><a href='index.php'>View Result</a>";
	}
}
?>
</body>
</html>
