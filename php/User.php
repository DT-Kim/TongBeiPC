<?php
header("Access-Control-Allow-Origin: *");
	require('conn.php');
	$id=$_POST['id'];
    $psta = $_POST['psta'];
    $sql_save = "update `查询用户信息`  set `用户级别`= '".$psta."'where 用户id = '".$id."'";
    $result_save = $conn->query($sql_save);
    $data['status'] = 'error';
    if($result_save){
    	
        $data['status'] = 'success';
    }
    $json = json_encode($data);
    echo $json;
?>