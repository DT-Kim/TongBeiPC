<?php
header("Access-Control-Allow-Origin: *");
	require("conn.php");
	$username=$_POST['user'];
   	$password=$_POST['password'];
	if ($username && $password){
		$Query = "Select count(*) as AllNum from 用户信息  where  用户账号='".$username."' and 用户密码='".$password."'"; 
///							echo $Query;
		$a = mysqli_query( $conn, $Query ); 
		$b = mysqli_fetch_assoc( $a ); 
	  if($b['AllNum']){
	  	$sql = "select * from 用户信息  where 用户账号='".$username."'";
	  	$result = $conn->query($sql);
			while($row = $result->fetch_assoc()) {
          	$user=$row['用户账号'];
	   						}
     session_start();
     $_SESSION["user"]=$user;
//	   	header("refresh:0;url=xmgl.php");//跳转页面，注意路径
	   echo $_SESSION["user"];
	   	exit;
	 }
	  else{
	  	echo "<script language=javascript>alert('用户名密码错误');history.back();</script>";
	  }
	 
	}else {
	 echo "<script language=javascript>alert('用户名密码不能为空');history.back();</script>";
	}
?>