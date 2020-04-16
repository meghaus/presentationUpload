<?php

$servername = "localhost";
$username = "slmalk_icbdppt";
$password = "Z&@sYuJBr2#9";
$dbname = "slmalk_icbdppt";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<html>
<head>
	<title>ICBD 2020 Conference - Presentation Uploads</title>
	<style type="text/css">
		body {
			font-size: 15px;
			color: #343d44;
			font-family: "segoe-ui", "open-sans", tahoma, arial;
			padding: 0;
			margin: 0;
		}
		table {
			margin: auto;
			font-family: "Lucida Sans Unicode", "Lucida Grande", "Segoe Ui";
			font-size: 12px;
		}

		h1 {
			margin: 25px auto 0;
			text-align: center;
			text-transform: uppercase;
			font-size: 17px;
		}

		table td {
			transition: all .5s;
		}
		
		/* Table */
		.data-table {
			border-collapse: collapse;
			font-size: 14px;
			min-width: 537px;
		}

		.data-table th, 
		.data-table td {
			border: 1px solid #e1edff;
			padding: 7px 17px;
		}
		.data-table caption {
			margin: 7px;
		}

		/* Table Header */
		.data-table thead th {
			background-color: #508abb;
			color: #FFFFFF;
			border-color: #6ea1cc !important;
			text-transform: uppercase;
		}

		/* Table Body */
		.data-table tbody td {
			color: #353535;
		}
		.data-table tbody td:first-child,
		.data-table tbody td:nth-child(10),
		.data-table tbody td:last-child {
			text-align: right;
		}

		.data-table tbody tr:nth-child(odd) td {
			background-color: #f4fbff;
		}
		.data-table tbody tr:hover td {
			background-color: #ffffa2;
			border-color: #ffff0f;
		}

		/* Table Footer */
		.data-table tfoot th {
			background-color: #e5f5ff;
			text-align: right;
		}
		.data-table tfoot th:first-child {
			text-align: left;
		}
		.data-table tbody td:empty
		{
			background-color: #ffcccc;
		}
	</style>
</head>
<body>
	<h1>ICBD 2020 - Presentation Uploads</h1>
	<table class="data-table">
		<caption class="title"></caption>
		<thead>
			<tr>
				<th>No.</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
        <th>Title</th>        
				<th>Mode</th>
				<th>File</th>
				<th>Uploaded On</th>
			</tr>
		</thead>
		<tbody>
<?php
$sql = "SELECT *
FROM presentations
ORDER BY submitted";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $no 	= 1;
    while($row = $result->fetch_assoc()) {

		$UploadDate = date("Y-m-d", strtotime($row["submitted"]));

    	echo '<tr>
        <td>'.$no.'</td>
        <td>'.$row["first_name"].'</td>
        <td>'.$row["last_name"].'</td>
        <td>'.$row["email"].'</td>        
        <td>'.$row["abstract_title"].'</td>
        <td>'.$row["mode"].'</td>  
        <td><a href="https://slma.lk/icbd2020/presentations/' .$row["file_uploaded"] .'">Download</td>
        <td>'.$UploadDate.'</td>
        </tr>';
       $no++;
    }
} else {
    echo "0 results";
}
$conn->close();
?>

