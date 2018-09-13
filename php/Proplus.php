<?php
	require('conn.php');
	$id=$_POST['id'];
//	$id = "1";
	$sql_sel = "select `产品名称`,`单位`,`价格`,`介绍`,`展示图` from 产品信息  where id ='".$id."'";
	$result_sel = $conn->query($sql_sel);
	$data= array();
       if($result_sel->num_rows > 0)
        {
            $i = 0;
            while($row = $result_sel->fetch_assoc())
            {
                $data['proname'] = $row['产品名称'];
                $data['prounit'] = $row['单位'];
                $data['proprice'] = $row['价格'];
                $data['prointro'] = $row['介绍'];
                $data['prophoto'] = $row['展示图'];
//              $data['aaData'][$i]['exc'] = $row['积分倍数'];
//              $data['aaData'][$i]['prohot'] = $row['热门状态'];
//              $data['aaData'][$i]['prosta'] = $row['产品状态'];
                $i++;
            }
        }
//      echo $data;
    $json = json_encode($data);
    echo $json;
?>