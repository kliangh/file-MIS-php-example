<?php

session_start();
//啟用Session

$NO = $_SESSION['NO'];
$upload_dir = "uploaded_file/".$_FILES['file']['name'];
$upload_dir_con = iconv("utf-8", "big5", $upload_dir);
//因為move_uploaded_file無法處理utf-8編碼，所必須做一個轉換的動作

$return_url = 'http://localhost/file_manager/file_upload_form.html';
$redirect_url = 'http://localhost/file_manager/file_list.php';

include("DB_con.php");//加入php資料庫連結

$file_name = $_FILES["file"]["name"];
$file_type = $_FILES["file"]["type"];
$file_size = $_FILES["file"]["size"];

$sql = "INSERT INTO file_list(file_name, file_size, file_path) VALUES ('$file_name', '$file_size', '$upload_dir')";

if($_FILES["file"]["error"]>0)
{
	echo "錯誤代碼:".$_FILES["file"]["error"];
	echo '<div align="center">上傳失敗，未選擇檔案</br>';
	echo "將在三秒後回到上一頁</br>";
   	echo "<a href=\"".$return_url."\">如未轉跳到檔案列表請點我</a>";
   	echo '<meta http-equiv=REFRESH CONTENT=2;url='.$return_url.'>';
}

else
{
	echo "File Name:".$file_name."<br/>";
	echo "File Type:".$file_type."<br/>";
	echo "File Size:".($file_size/1024)."Kb<br/>";
	echo "Temporary Name:".$_FILES["file"]["tmp_name"];

	if(file_exists($upload_dir_con))
	{
			echo '<div align="center">上傳失敗，File Already Exists</br>';
			echo "將在三秒後回到上一頁</br>";
   			echo "<a href=\"".$return_url."\">如未轉跳到檔案列表請點我</a>";
   			echo '<meta http-equiv=REFRESH CONTENT=2;url='.$return_url.'>';
	}

	else
	{

		$flag = mysqli_query($con, $sql);

		if($flag)
		{
			move_uploaded_file($_FILES["file"]["tmp_name"], $upload_dir_con);
			echo '<div align="center">上傳成功</br>';
			echo "將在三秒後回到檔案列表</br>";
   			echo "<a href=\"".$return_url."\">如未轉跳到檔案列表請點我</a>";
   			echo '<meta http-equiv=REFRESH CONTENT=2;url='.$redirect_url.'>';


		}
		else
		{
			echo '<div align="center">上傳失敗，Database Error</br>';
			echo "將在三秒後回到上一頁</br>";
   			echo "<a href=\"".$return_url."\">如未轉跳到檔案列表請點我</a>";
   			echo '<meta http-equiv=REFRESH CONTENT=2;url='.$return_url.'>';
		}


		mysqli_close($con);
	}
}
?>
