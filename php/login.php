<?php
	require("conn.php");
	$account=$_POST['account'];
   	$password=$_POST['password'];
// 	$account='admin';
// 	$password='123456';
	$sql = "select id from 用户信息 where 用户账号='".$account."' and 用户密码='".$password."'";
    $result_check = $conn->query($sql)->fetch_assoc();
	$data['status'] = 'error';
	if(isset($result_check['id'])){
		$data['status'] = 'success';
	}
	$json = json_encode($data);
 	echo $json;
?>