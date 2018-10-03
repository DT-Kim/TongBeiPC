<?php
header("Access-Control-Allow-Origin: *");
    require('conn.php');
    $id=$_GET['id'];
    $sql = "select * from 产品轮播图  where 产品信息id='".$id."' AND 有效状态 = 0 order by 位置信息";
    $result = $conn->query($sql);
    $data['aaData'] = array();
    if($result->num_rows>0)
    {
        $i = 0;
        while($row = $result->fetch_assoc())
        {
        	$data['aaData'][$i]['serialnum'] = ($i+1);
            $data['aaData'][$i]['id'] = $row['id'];
            $data['aaData'][$i]['url'] = $row['图片地址'];
            $data['aaData'][$i]['else'] = $row['图片说明'];
            $data['aaData'][$i]['place'] = $row['位置信息'];
            $data['aaData'][$i]['stament'] = $row['图片状态'];
            $status = '否';
            if($row['热门状态'] == 1)
            {
                $status = '是';
            }
            $data['aaData'][$i]['status'] = $status;
            $i++;
        }
    }
    $json = json_encode($data);
    echo $json;
    
