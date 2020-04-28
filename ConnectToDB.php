<!DOCTYPE html>
<html>
    <head>
<title>Insert data to PostgreSQL with php - creating a simple web application</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
    body{
      background: green;
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
<li><strong>Commodity ID:</strong></li>  <li><input type="text" name="empid" /></li>
<li><strong>Full name:</strong></li>    <li><input type="text" name="empname" /></li>
<li><strong>Barcode</strong></li><li>    <input type="text" name="empemail" /></li>
<li><strong>Made in:</strong></li>    <li><input type="text" name="empphone" /></li>
<li><input type="submit" value="INSERT"></li>
</form>
</ul>
<?php
if (empty(getenv("DATABASE_URL"))){
    echo '<p>The DB does not exist</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=mydb', 'postgres', '123456');
}  else {
     
   $db = parse_url(getenv("DATABASE_URL"));
   $pdo = new PDO("pgsql:" . sprintf(
        "host=ec2-54-83-192-245.compute-1.amazonaws.com;port=5432;user=vcujfzrpxvdtyx;password=6722ff5be8a5a94e3fb874bb728a7f177eacfb70f9317f010e37a7d1e00d9668;dbname=dfu22a679eqmoc",
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
$sql = "INSERT INTO employee(empid, empname, empmail, empphone)"
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
 <!DOCTYPE html>
<html>
<body>
<style type="text/css">
    body{
      background:green;
</style>
<h1>DELETE DATA TO DATABASE</h1>
<form>
         <button type="submit" formaction="index.php">HOME</button>
</form>
<ul>
    <form name="DeleteData" action="DeleteData.php" method="POST" >
<li><strong>Commodity ID::</strong></li>  <li><input type="text" name="empid" /></li>
<li><input type="submit" value="DELETE" /></li>
</form>
</ul>
<?php
// ini_set('display_errors', 1);
// echo "Insert database!";
?>
<?php
if (empty(getenv("DATABASE_URL"))){
    echo '<p>The DB does not exist</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=mydb', 'postgres', '123456');
}  else {
   $db = parse_url(getenv("DATABASE_URL"));
   $pdo = new PDO("pgsql:" . sprintf(
        "host=ec2-54-83-192-245.compute-1.amazonaws.com;port=5432;user=vcujfzrpxvdtyx;password=6722ff5be8a5a94e3fb874bb728a7f177eacfb70f9317f010e37a7d1e00d9668;dbname=dfu22a679eqmoc",
        $db["host"],
        $db["port"],
        $db["user"],
        $db["pass"],
        ltrim($db["path"], "/")
   ));
}  
$sql = "DELETE FROM employee WHERE empid = '$_POST[empid]'";
$stmt = $pdo->prepare($sql);
if($stmt->execute() == TRUE){
    echo "Record deleted successfully.";
} else {
    echo "Error deleting record: ";
}
?>
</body>
</html>
<!DOCTYPE html>
<html>
<body>
<style type="text/css">
    body{
      background: green;
</style>
<h1>UPDATE DATA TO DATABASE</h1>
<form>
         <button type="submit" formaction="index.php">HOME</button>
</form>

<ul>
li><strong>Commodity ID:</strong></li>  <li><input type="text" name="empid" /></li>
<li><strong>Full name:</strong></li>    <li><input type="text" name="empname" /></li>
<li><strong>Barcode</strong></li><li>    <input type="text" name="empemail" /></li>
<li><strong>Made in:</strong></li>    <li><input type="text" name="empphone" /></li>
<li><input type="submit" value="INSERT"></li>
</form>
</ul>
<?php
// ini_set('display_errors', 1);
// echo "Update database!";
?>
<?php
if (empty(getenv("DATABASE_URL"))){
    echo '<p>The DB does not exist</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=mydb', 'postgres', '123456');
}  else {
     
   $db = parse_url(getenv("DATABASE_URL"));
   $pdo = new PDO("pgsql:" . sprintf(
        "host=ec2-54-83-192-245.compute-1.amazonaws.com;port=5432;user=vcujfzrpxvdtyx;password=6722ff5be8a5a94e3fb874bb728a7f177eacfb70f9317f010e37a7d1e00d9668;dbname=dfu22a679eqmoc",
        $db["host"],
        $db["port"],
        $db["user"],
        $db["pass"],
        ltrim($db["path"], "/")
   ));
}  
//$sql = 'UPDATE student '
//                . 'SET name = :name, '
//                . 'WHERE ID = :id';
// 
//      $stmt = $pdo->prepare($sql);
//      //bind values to the statement
//        $stmt->bindValue(':name', 'Lee');
//        $stmt->bindValue(':id', 'SV02');
        // update data in the database
//        $stmt->execute();
        // return the number of row affected
        //return $stmt->rowCount();
$sql = "UPDATE employee SET empname = '$_POST[empname]', empemail = '$_POST[empemail]', empphone = '$_POST[empphone]' WHERE empid = '$_POST[empid]'";
      $stmt = $pdo->prepare($sql);
if($stmt->execute() == TRUE){
    echo "Record updated successfully.";
} else {
    echo "Error updating record. ";
}   
?>
</body>
</html>
