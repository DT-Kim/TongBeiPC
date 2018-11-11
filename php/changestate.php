<?php
	header("Access-Control-Allow-Origin: *");
    require('conn.php');
    $ordernum=$_POST['ordernum'];
    $state=$_POST['state'];
    $data['status'] = 'error';
    $sql101="update `订单信息` set `交易确认状态`= '".$state."' where `订单号` = '".$ordernum."'";
    $result101 = $conn->query($sql101);
        if($result101){
            $data['status'] = 'success';
        }
    $json = json_encode($data);
    echo $json;
?>