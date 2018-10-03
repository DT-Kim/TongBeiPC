<?php
	require("conn.php");
	
//	$account=$_POST['account'];
// 	$password=$_POST['password'];
//// 	$account='admin';
//// 	$password='123456';
//	$sql = "select id from 用户信息 where 用户账号='".$account."' and 用户密码='".$password."'";
//  $result_check = $conn->query($sql)->fetch_assoc();
//	$data['status'] = 'error';
//	if(isset($result_check['id'])){
//		$data['status'] = 'success';
//	}
//	$json = json_encode($data);
// 	echo $json;

	//接收数据
	$account = isset($_POST['account']) ? $_POST['account'] : "";//账号
	$password = isset($_POST['password']) ? $_POST['password'] : "";//密码
	
	//返回信息
	$ret_data = array(
		"state"=>"default",
		"message"=>""
	);
	
	$sql = "SELECT id,真实姓名,用户手机,用户级别id FROM 用户信息 WHERE 用户账号='".$account."' AND 用户密码='".$password."'";
	$result = $conn->query($sql);
	if($result->num_rows>0){
		$ret_data["state"] = "success";
		$ret_data["message"] = "登录成功";
		
		//存入服务器session
		while($row = $result->fetch_assoc()){
			session_start();//打开session会话
			//向session存入数据
			$_SESSION["account"] = $account;
			$_SESSION["realname"] = $row["真实姓名"];
			$_SESSION["phonenumber"] = $row["用户手机"];
			$_SESSION["gradeID"] = $row["用户级别id"];
		}
	}else{
		$ret_data["message"] = "账号或密码错误";
	}
	
	$json = json_encode($ret_data);
	echo $json;
	
?>