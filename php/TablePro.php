<?php
header("Access-Control-Allow-Origin: *");
    require('conn.php');
           $sql_sel = "SELECT * FROM `查询产品信息`  ";
            $result_sel = $conn->query($sql_sel);
            $data['aaData'] = array();
            if($result_sel->num_rows > 0)
            {
                $i = 0;
                while($row = $result_sel->fetch_assoc())
                {
                    $data['aaData'][$i]['id'] = $row['id'];
                    $data['aaData'][$i]['proname'] = $row['产品名称'];
                    $data['aaData'][$i]['prounit'] = $row['单位'];
                    $data['aaData'][$i]['proprice'] = $row['价格'];
                    $data['aaData'][$i]['prointro'] = $row['介绍'];
                    $data['aaData'][$i]['prophoto'] = $row['展示图'];
                    $data['aaData'][$i]['proexc'] = $row['积分倍数'];
                    $data['aaData'][$i]['prohot'] = $row['热门状态'];
                    $data['aaData'][$i]['typename'] = $row['类型名'];
                    $data['aaData'][$i]['typeintro'] = $row['类型介绍'];

                    $i++;
                }
            }
//       
            
            $json = json_encode($data);
            echo $json;
    
?>