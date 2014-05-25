<?php
	header("Content-type: text/html; charset=utf-8");
	
	$FID = $_GET["FID"];
	//接收參數FID

	include("DB_con.php");
	//加入連結

	$sql = "SELECT * FROM file_list WHERE FID = $FID";
	$data = mysqli_query($con, $sql);
	//執行SQL
	
	$row = mysqli_fetch_row($data);
	//讀出資料

	$file_path = $row['3']; // 實際檔案的路徑+檔名
	$file_name = $row['1']; // 下載的檔名

	$file_path_con = mb_convert_encoding($file_path,"BIG-5","UTF-8");

	ob_end_clean();//解決中文亂碼
	
	//指定類型
	header("Content-type: ".filetype("$file_path_con"));

	//指定下載時的檔名
	header("Content-Disposition: attachment; filename=".$file_name."");

	//輸出下載的內容。
	readfile($file_path_con);
?>
