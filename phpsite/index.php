<?php

$table="mytable";

$hello="Hello world";
$date = date('Y/m/d H:i:s');

$serverIP=$_SERVER['SERVER_ADDR'];

$sql="select hello from $table";
$props = parse_ini_file("application.properties");

$conn = new mysqli($props['dbhost'], $props['dbuser'], $props['dbpassword'],$props['database']);
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
