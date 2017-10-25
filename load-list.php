<?php
	include 'dbh.php';

	$service = $_POST["service"];

	if($_POST["oname"]!=""){
		$type = "Organisation";
		$name = $_POST["oname"];
	}elseif($_POST["fname"]!="" || $_POST["lname"]!=""){
		$type = "Citizen";
		$name = $_POST["title"]." ".$_POST["fname"]." ".$_POST["lname"];
	}else{
		$type = "Anonymous";
		$name = "Anonymous";
	}

	$insert_sql = "INSERT INTO customers (id, type, service, name, queued) VALUES (NULL, '".$type."', '".$service."', '".$name."', CURRENT_TIMESTAMP)";
	$insert_result = mysqli_query($conn, $insert_sql);

	$sql = "SELECT * FROM customers";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			echo "<tr><td>";
			echo $row['id'];
			echo "</td><td>";
			echo $row['type'];
			echo "</td><td>";
			echo $row['name'];
			echo "</td><td>";
			echo $row['service'];
			echo "</td><td>";
			echo date("G:i", strtotime($row['queued']));
			echo "</td></tr>";
		}
	} else {
		echo "There are no customers!";
	}
?>
