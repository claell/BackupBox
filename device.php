<?php 
$con = mysqli_connect("localhost","root","root","ping_backupbox_se");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$lines = file("list.csv");

foreach($lines as $line) {
	$parts = explode("\t",$line);
	
	if(count($parts) == 1) {
		$lastVendor = $id = substr($line, 0, 4);
	}
	
	if(count($parts) == 2) {
		$id = substr($line, 1, 5);
		$name = substr($line, 6);
		mysqli_query($con,'INSERT INTO devices (id, vendor, name) VALUES ("'.$id.'","'.$lastVendor.'", "'.$name.'")');
		echo('INSERT INTO devices (id, vendor, name) VALUES ("'.$id.'","'.$lastVendor.'", "'.$name.'")<br />');
	}
	//echo(count($parts)."<br />");
}

mysqli_close($con);
?>