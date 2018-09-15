<?php

    $falg = $_GET['falg'];
//  $falg = 'type';
    require('conn.php');
    
    switch ($falg)
    {
        case 'exc':
            $sql_sel = "select * from 积分商品 where 1=1 ";
            $result_sel = $conn->query($sql_sel);
            $data['aaData'] = array();
            if($result_sel->num_rows > 0)
            {
                $i = 0;
                while($row = $result_sel->fetch_assoc())
                {
                    $data['aaData'][$i]['id'] = $row['id'];
                    $data['aaData'][$i]['excName'] = $row['商品名称'];
                    $data['aaData'][$i]['excreq'] = $row['积分要求'];
                    $data['aaData'][$i]['excunit'] = $row['单位'];
                    $data['aaData'][$i]['exchot'] = $row['热门状态'];
                    $data['aaData'][$i]['excsta'] = $row['商品状态'];
                    $data['aaData'][$i]['exctext'] = $row['详细内容'];
                    $data['aaData'][$i]['excElse'] = $row['商品描述'];
                    $i++;
                }
            }
            $json = json_encode($data);
            echo $json;
//      break;
//      case 'list':
////         
//          $result_sel = $conn->query($sql_sel);
//          if($result_sel->num_rows > 0)
//          {
//              $data['aaData'] = array();
//              $i = 0;
//              while($row = $result_sel->fetch_assoc())
//              {
////                  $data['aaData'][$i]['typeName'] = $row['类型名'];
////                  $data['aaData'][$i]['typeElse'] = $row['类型介绍'];
////                  $i++;
//              }
//          }
////          $json = json_encode($data);
////          echo $json;
//      break;
        default:break;
    }
    
?>