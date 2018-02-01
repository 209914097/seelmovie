<?php

$dbhost = 'localhost:3306'; 
$dbuser = 'root';            
$dbpass = '535470al';         
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);

$film_name= $_POST['film_name'];
$score = $_POST['score'];
$order =$_POST['order'];
	if($film_name!=""){
		$sql = "INSERT INTO movie ".
				"(film_name,score) ".
				"VALUES ".
				"('$film_name','$score')";
		
		mysqli_select_db($conn, 'seel_db' );
		$retval = mysqli_query( $conn, $sql );
	}
    else
	{
		$id=mysqli_insert_id($conn);
		$sql = 'DELETE FROM movie
        WHERE $id';
 
		mysqli_select_db( $conn, 'seel_db' );
		$retval = mysqli_query( $conn, $sql );		
	}	
$sql = ('SELECT id,film_name, score
        FROM movie
		ORDER BY  score ').$order;

mysqli_select_db( $conn, 'seel_db' );
$retval = mysqli_query( $conn, $sql );

echo "<?xml version=\"1.0\"?>\n";
echo "<response>\n";

	while($row = mysqli_fetch_array($retval, MYSQL_ASSOC)){
		$row['film_name'] = htmlspecialchars(stripslashes($row['film_name']));
		echo "\t<message>\n";
		echo "\t\t<film_name>$row[film_name]</film_name>\n";
		echo "\t\t<score>$row[score]</score>\n";
		echo "\t</message>\n";
	}

echo "</response>";
mysqli_close($conn);
?>