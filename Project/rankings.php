<?php

$page_roles = array('admin', 'user');

require_once 'login.php';
require_once  'checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

echo <<<_END
	<pre>
	<a href="addRanking.php">Add Ranking</a> <a href="programportal.php">Return to Program Portal</a>	
		
_END;


echo <<<_END
<br>
U of U Program Rankings <br>
_END;

$query="SELECT * FROM rank";
$result=$conn->query($query);
if(!$result) die ($conn->error);

$rows=$result->num_rows;
for($j=0; $j<$rows; $j++) {
	$result->data_seek($j);
	$row=$result->fetch_array(MYSQLI_BOTH);
	
	echo <<<_END
	<pre>
		Team <a href='updateRanking.php?RankID=$row[RankID]'>$row[TeamName]</a>
		Rank $row[Rank]
		Record $row[Record]
		
	</pre>
	
_END;
}

$result->close();
$conn->close();

function get_post($conn, $var) {
	return $conn->real_escape_string($_POST[$var]);
}



?>