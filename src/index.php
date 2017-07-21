<?php

$table="mytable";

$hello="Hello world";
$date = date('Y/m/d H:i:s');

$serverIP=$_SERVER['SERVER_ADDR'];

$sql="select hello from $table";

$dbhost=$_ENV["DBHOST"];
$database=$_ENV["DATABASE"];
$dbuser=$_ENV["DBUSER"];
$dbpassword=$_ENV["DBPASSWORD"];

if (empty($dbhost) || empty($database) || empty($dbuser) || empty($dbpassword) ) {
    echo 'Missing environment variables: you need to set DBHOST, DATABASE, DBUSER and DBPASSWORD';
    exit();
}

$conn = new mysqli($dbhost, $dbuser, $dbpassword,$database);
// check connection
if ($conn->connect_error) {
    echo 'Unable to connect to DB. Error: '  . $conn->connect_error;
    exit();
}

$rs=$conn->query($sql);

if($rs === false) {
    echo "Unable to retrieve data: ".$conn->error;
} else {
    $rs->data_seek(0);
    $row = $rs->fetch_row();
}

?>

<html>
<body>
<h2>
<?php echo $hello; ?>
</h2>
<p>The time is <?php echo $date; ?></p>
<p>Server IP is <?php echo $serverIP; ?></p>
<p>Content of the first table row: <?php echo $row[0]; ?></p>
</body>
</html>
