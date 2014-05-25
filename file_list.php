<?php
	header("Content-type: text/html; charset=utf-8");
	include("DB_con.php");
	//加入連結

	session_start();
	//啟用Session
	
	$sql = "SELECT * FROM file_list";

	$data = mysqli_query($con, $sql);
	
		echo '<table frame="box" rules="all" align="center">';
		echo '<tr bgcolor = "AFD6FF">';
		echo'<td >NO.</td> <td >File ID</td> <td >File Name</td> <td>File Size</td> <td>Preview</td> <td>Download</td>';
		echo '</tr>';
		while ($row = mysqli_fetch_array($data))
		{
			$flag = 1;
			//Display the score data
			echo '<tr><td>'.$flag.'</td>';
			echo '<td>'.$row['FID'].'</td>';
			echo '<td>'.$row['file_name'].'</td>';
			echo '<td>'.number_format($row['file_size']/1024, 2, '.', '').' Kb</td>';
			echo '<td><a href="pdf_file_preview.php?FID='.$row['FID'].'">預覽</a></td>';
			echo '<td><a href="file_download.php?FID='.$row['FID'].'">下載</a></td>';

			$flag++;
		}
		echo '</table>';
		
		mysqli_close($con);
		
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN""http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<html>
<body>
<ul>
	<li><a href="http://localhost/file_manager/file_list.php">Refresh</a></li>
	<li><a href="http://localhost/file_manager/file_upload_form.html">Upload</a></li>
</ul>

	<div align = "center">
	<form action="file_delete.php" method="post" enctype="multipart/form-data">

	Delete File By File ID:
		<input type="text" name="FID" placeholder="Please Insert File ID">
		<input type="submit" name="submit" value="Delete">
	
	</form>
	</div>
</body>
</html>
