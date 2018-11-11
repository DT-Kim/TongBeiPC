<?php
header("Access-Control-Allow-Origin: *");
    $flag = $_GET['flag'];
//  $flag = 'list';
    require('conn.php');
    
    switch ($flag)
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
//                  $data['aaData'][$i]['exchot'] = $row['热门状态'];
                    $data['aaData'][$i]['excsta'] = $row['商品状态'];
                    $data['aaData'][$i]['exctext'] = $row['详细内容'];
                    $data['aaData'][$i]['excElse'] = $row['商品描述'];
                    $data['aaData'][$i]['prophoto'] = $row['展示图'];
                     $MesSta = '否';
                    if($row['热门状态'] == 1)
                    {
                        $MesSta = '是';
                    }
                    $data['aaData'][$i]['exchot'] = $MesSta;
                    $i++;
                }
            }
            $json = json_encode($data);
            echo $json;
        break;
        case 'list':
            $ExcId = $_GET['excId'];
//			$ExcId = '0';
            $sql_sel2 = "select * from 商品轮播图  where 商品id='".$ExcId."'";
            $result_sel2 = $conn->query($sql_sel2);
            $data['aaData'] = array();
            if($result_sel2->num_rows > 0)
            {
                $i = 0;
                while($row = $result_sel2->fetch_assoc())
                {
                	$data['aaData'][$i]['serialnum'] = ($i+1);
            		$data['aaData'][$i]['id'] = $row['id'];
                    $data['aaData'][$i]['url'] = $row['图片地址'];
                    $data['aaData'][$i]['else'] = $row['图片说明'];
                    $data['aaData'][$i]['phosta'] = $row['图片状态'];
//                  $data['aaData'][$i]['hotsta'] = $row['热门状态'];
                    $data['aaData'][$i]['location'] = $row['位置信息'];
//                  $data['aaData'][$i]['validsta'] = $row['有效状态'];
                    $i++;
                }
            }
            $json = json_encode($data);
            echo $json;
        break;
        default:break;
    }
    
?>