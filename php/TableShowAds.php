<?php
    require('conn.php');
    
    $sql = "select * from 广告轮播图 where 有效状态 = 0 order by 位置信息";
    $result = $conn->query($sql);
    $data['aaData'] = array();
    if($result->num_rows>0)
    {
        $i = 0;
        while($row = $result->fetch_assoc())
        {
            $data['aaData'][$i]['url'] = $row['图片地址'];
            $data['aaData'][$i]['else'] = $row['广告说明'];
            $data['aaData'][$i]['place'] = $row['位置信息'];
            $status = '无';
            if($row['热门状态'] == 1)
            {
                $status = '热门';
            }
            $data['aaData'][$i]['status'] = $status;
            $i++;
        }
    }
    $json = json_encode($data);
    echo $json;
    
