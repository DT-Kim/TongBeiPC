<?php
    header("Access-Control-Allow-Origin: *");
	require('conn.php');
	
	$id = $_POST['id'];
    $psta = $_POST['psta'];
    
//  $id = 5;
//  $psta = 3;
    
    $sql_save = "update `用户信息`  set `用户级别id`= '".$psta."'where id = '".$id."'";
    $result_save = $conn->query($sql_save);
//  echo $sql_save;
    $data['status'] = 'error';
    if($result_save){
    	
        $data['status'] = 'success';
    }
    $json = json_encode($data);
    echo $json;
?>