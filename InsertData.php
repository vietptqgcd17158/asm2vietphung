<!DOCTYPE html>
<html>
    <head>
<title>Insert data to PostgreSQL with php - creating a simple web application</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
    body{
      background: pink;
</style>
</head>
<body>
<h1>INSERT DATA TO DATABASE</h1>
<form>
         <button type="submit" formaction="index.php">HOME</button>
</form>
<h2>Enter data into employee table:</h2>
<ul>
    <form name="InsertData" action="InsertData.php" method="POST" >
<li><strong>Employee ID:</strong></li>  <li><input type="text" name="empid" /></li>
<li><strong>Full name:</strong></li>    <li><input type="text" name="empname" /></li>
<li><strong>Email:</strong></li><li>    <input type="text" name="empemail" /></li>
<li><strong>Phone number:</strong></li>    <li><input type="text" name="empphone" /></li>
<li><input type="submit" value="INSERT"></li>
</form>
</ul>
<?php
if (empty(getenv("DATABASE_URL"))){
    echo '<p>The DB does not exist</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=asm2vietphung', 'postgres', '1234');
}  else {
     
   $db = parse_url(getenv("DATABASE_URL"));
   $pdo = new PDO("pgsql:" . sprintf(
         "host=ec2-52-44-55-63.compute-1.amazonaws.com;port=5432;user=tagmvfarecjwkt;password=619b93c5bfa6b590c5a0c417a865476d8e0ae80922e4445112f93f4f6013fd9f;dbname=dfbgqnn2jcnotp",
        $db["host"],
        $db["port"],
        $db["user"],
        $db["pass"],
        ltrim($db["path"], "/")
   ));
}  
if($pdo === false){
     echo "ERROR: Could not connect Database";
}
$sql = "INSERT INTO employee(empid, empname, empemail, empphone)"
        . " VALUES('$_POST[empid]','$_POST[empname]','$_POST[empemail]','$_POST[empphone]')";
$stmt = $pdo->prepare($sql);
//$stmt->execute();
 if (is_null($_POST[empid])) {
   echo "Employee must be not null";
 }
 else
 {
    if($stmt->execute() == TRUE){
        echo "Record inserted successfully.";
    } else {
        echo "Error inserting record: ";
    }
 }
?>
</body>
</html>
