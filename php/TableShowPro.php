<?php
    $falg = $_GET['falg'];
//  $falg = 'type';
    require('conn.php');
    
    switch ($falg)
    {
        case 'type':
            $sql_sel = "select id,类型名,类型介绍  from 产品类型 where 1=1 ";
            $result_sel = $conn->query($sql_sel);
            if($result_sel->num_rows > 0)
            {
                $data['aaData'] = array();
                $i = 0;
                while($row = $result_sel->fetch_assoc())
                {
                    $data['aaData'][$i]['id'] = $row['id'];
                    $data['aaData'][$i]['typeName'] = $row['类型名'];
                    $data['aaData'][$i]['typeElse'] = $row['类型介绍'];
                    $i++;
                }
            }
            $json = json_encode($data);
            echo $json;
        break;
        case 'list':
//          $sql_sel = "select 类型名,类型介绍  from 产品类型 where 1=1 ";
            $result_sel = $conn->query($sql_sel);
            if($result_sel->num_rows > 0)
            {
                $data['aaData'] = array();
                $i = 0;
                while($row = $result_sel->fetch_assoc())
                {
//                  $data['aaData'][$i]['typeName'] = $row['类型名'];
//                  $data['aaData'][$i]['typeElse'] = $row['类型介绍'];
//                  $i++;
                }
            }
//          $json = json_encode($data);
//          echo $json;
        break;
        default:break;
    }
    