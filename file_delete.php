<?php 
	include("DB_con.php");
	//加入連結

	$fid = $_POST["FID"];
	$return_url = 'http://localhost/file_manager/file_list.php';

	if ( $fid == null)
	{
		echo '<div align="center">請輸入數值</br>';
		echo "將在三秒後重新回到檔案列表</br>";
   		echo "<a href=\"".$return_url."\">如未轉跳到檔案列表請點我</a>";
   		echo "<script language=\"javascript\">setTimeout(\"window.location.href='".$return_url."'\",3000)</script></div>";
	}
	else
	{
		$sql = "SELECT * FROM file_list WHERE FID = '$fid'";
		$data = mysqli_query($con, $sql);
		$row = mysqli_fetch_row($data);
		//利用該SQL去確認該筆資料是否存在

		if( $row != null )
		{
			$sql = "DELETE FROM file_list WHERE FID = '$fid'";

			mysqli_query($con, $sql);
			//執行SQL
			unlink($row['3']);

			echo '<div align="center">刪除成功</br>';
			echo "將在三秒後重新回到檔案列表</br>";
   			echo "<a href=\"".$return_url."\">如未轉跳到檔案列表請點我</a>";
 			echo '<meta http-equiv=REFRESH CONTENT=2;url='.$return_url.'>';
		}
		else
		{
			echo '<div align="center">指定資料不存在，返回檔案列表</br>';
			echo "將在三秒後重新回到檔案列表</br>";
   			echo "<a href=\"".$return_url."\">如未轉跳到檔案列表請點我</a>";
 			echo '<meta http-equiv=REFRESH CONTENT=2;url='.$return_url.'>';
		}
	}

	mysqli_close($con);
?>
