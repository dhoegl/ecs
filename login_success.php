<?php 
session_start();
if(!$_SESSION['logged in'])
{
header("location:welcome.php");
}
else 
{
	header("location:welcome.php");
}
?>


<html>
// Check if session is not registered , redirect back to main page. 
// Put this code in first line of web page. 
<body>
Login successful
</body>
</html>
