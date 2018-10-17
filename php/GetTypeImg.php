<?php
    $TypeId = $_POST['TypeId'];
//  $TypeId = 2;
    
    require'conn.php';
    
    //select
    $sql = "select * from 产品类型 where id = '".$TypeId."'";
    $result = $conn->query($sql)->fetch_assoc();
    
    $data['status'] = 'error';
    if($result)
    {
        $data['status'] = 'success';
        $data['TypeLogo'] = $result['图标地址'];
        $data['TypePic'] = $result['图片地址'];
    }
    
    $json = json_encode($data);
    echo $json;
