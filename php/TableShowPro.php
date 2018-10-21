<?php
header("Access-Control-Allow-Origin: *");
    $falg = $_GET['falg'];
//  $falg = 'list';
    require('conn.php');
    
    switch ($falg)
    {
        case 'type':
            $sql_sel = "select id,类型名,类型介绍  from 产品类型 where 1=1 ";
            $result_sel = $conn->query($sql_sel);
            $data['aaData'] = array();
            if($result_sel->num_rows > 0)
            {
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
            $TypeId = $_GET['typeId'];
            $sql_sel = "select *  from 产品信息 where 产品类型id='".$TypeId."' ";
            $result_sel = $conn->query($sql_sel);
            $data['aaData'] = array();
            if($result_sel->num_rows > 0)
            {
                $i = 0;
                while($row = $result_sel->fetch_assoc())
                {
                    $data['aaData'][$i]['ProListId'] = $row['id'];
                    $data['aaData'][$i]['ListName'] = $row['产品名称'];
                    $data['aaData'][$i]['ListUnit'] = $row['单位'];
                    $data['aaData'][$i]['ListPrice'] = $row['价格'];
                    $data['aaData'][$i]['ListScore'] = $row['积分倍数'];
                    $data['aaData'][$i]['ListShow'] = $row['产品状态'];
                    $data['aaData'][$i]['ListSta'] = $row['热门状态'];
//                  $MesSta = '否';
//                  if($row['热门状态'] == 1)
//                  {
//                      $MesSta = '是';
//                  }
//                  $data['aaData'][$i]['ListSta'] = $MesSta;
                    
                    $i++;
                }
            }
            $json = json_encode($data);
            echo $json;
            break;
        default:break;
    }
    