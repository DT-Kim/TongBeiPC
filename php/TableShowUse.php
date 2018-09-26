<?php
header("Access-Control-Allow-Origin: *");
    require('conn.php');
           $sql_sel = "SELECT * FROM `查询用户信息` ";
            $result_sel = $conn->query($sql_sel);
            $data['aaData'] = array();
            if($result_sel->num_rows > 0)
            {
                $i = 0;
                while($row = $result_sel->fetch_assoc())
                {
                    $data['aaData'][$i]['id'] = $row['用户id'];
                    $data['aaData'][$i]['useacc'] = $row['用户账号'];
                    $data['aaData'][$i]['usepasw'] = $row['用户密码'];
                    $data['aaData'][$i]['usename'] = $row['真实姓名'];
                    $data['aaData'][$i]['usepho'] = $row['用户手机'];
                    $data['aaData'][$i]['uselev'] = $row['用户级别'];
                    $data['aaData'][$i]['usetime'] = $row['注册时间'];
                    $data['aaData'][$i]['levmark'] = $row['级别备注'];
                    $data['aaData'][$i]['useprov'] = $row['省'];
                    $data['aaData'][$i]['usecity'] = $row['市'];
                    $data['aaData'][$i]['usearea'] = $row['县'];

                    $i++;
                }
            }
//       
            
            $json = json_encode($data);
            echo $json;
    
?>