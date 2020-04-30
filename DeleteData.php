<!DOCTYPE html>
<html>
<body>
<style type="text/css">
    body{
      background:pink;
</style>
<h1>DELETE DATA TO DATABASE</h1>
<form>
         <button type="submit" formaction="index.php">HOME</button>
</form>
<ul>
    <form name="DeleteData" action="DeleteData.php" method="POST" >
<li><strong>Employee ID:</strong></li>  <li><input type="text" name="empid" /></li>
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
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=asm2vietphung', 'postgres', '123456');
}  else {
     
   $db = parse_url(getenv("DATABASE_URL"));
   $pdo = new PDO("pgsql:" . sprintf(
        "host=ec2-50-17-21-170.compute-1.amazonaws.com;port=5432;user=olxwlnkizrqbrp;password=de6aa0033cc3d3365e030e7153f52bf97132f16ac347be41eec07c2a28fc40af;dbname=d1lr64rk800aqj",
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
