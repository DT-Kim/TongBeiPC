<?php
	$falg = $_GET['falg'];
    require('conn.php');
    
   
    switch ($falg)
    {
    	case 'wait':
            $sql_sel = "SELECT 订单号,产品名称,产品数量,单位,价格,金额,总金额,下单用户姓名,下单用户手机,积分总数,收货地址,下单时间,交易确认状态,物流收货时间,物流员姓名,物流员手机 FROM `查询订单详情`WHERE `交易确认状态`='待收货' ";
            $result_sel = $conn->query($sql_sel);
            $data['aaData'] = array();
            if($result_sel->num_rows > 0)
            {	
            	$i = 0;
                while($row = $result_sel->fetch_assoc())
                {
                    $data['aaData'][$i]['ordnum'] = $row['订单号'];
                    $data['aaData'][$i]['proname'] = $row['产品名称'];
                    $data['aaData'][$i]['pronum'] = $row['产品数量'];
                    $data['aaData'][$i]['prounit'] = $row['单位'];
                    $data['aaData'][$i]['proprice'] = $row['价格'];
                    $data['aaData'][$i]['money'] = $row['金额'];
                    $data['aaData'][$i]['summoney'] = $row['总金额'];
                    $data['aaData'][$i]['usename'] = $row['下单用户姓名'];
                    $data['aaData'][$i]['usephone'] = $row['下单用户手机'];
                    $data['aaData'][$i]['excsum'] = $row['积分总数'];
                    $data['aaData'][$i]['address'] = $row['收货地址'];
                    $data['aaData'][$i]['ordtime'] = $row['下单时间'];
                    $data['aaData'][$i]['ordsta'] = $row['交易确认状态'];
                    $data['aaData'][$i]['gettime'] = $row['物流收货时间'];
                    $data['aaData'][$i]['sendname'] = $row['物流员姓名'];
                    $data['aaData'][$i]['sendnumb'] = $row['物流员手机'];
                    $i++;
                }
            }
//       
            $json = json_encode($data);
            echo $json;
            break;
        case 'get':
        	$sql_sel = "SELECT 订单号,产品名称,产品数量,单位,价格,金额,总金额,下单用户姓名,下单用户手机,积分总数,收货地址,下单时间,交易确认状态,物流收货时间,物流员姓名,物流员手机 FROM `查询订单详情`WHERE `交易确认状态`='已完成' ";
            $result_sel = $conn->query($sql_sel);
            $data['aaData'] = array();
            if($result_sel->num_rows > 0)
            {	
            	$i = 0;
                while($row = $result_sel->fetch_assoc())
                {
                    $data['aaData'][$i]['ordnum'] = $row['订单号'];
                    $data['aaData'][$i]['proname'] = $row['产品名称'];
                    $data['aaData'][$i]['pronum'] = $row['产品数量'];
                    $data['aaData'][$i]['prounit'] = $row['单位'];
                    $data['aaData'][$i]['proprice'] = $row['价格'];
                    $data['aaData'][$i]['money'] = $row['金额'];
                    $data['aaData'][$i]['summoney'] = $row['总金额'];
                    $data['aaData'][$i]['usename'] = $row['下单用户姓名'];
                    $data['aaData'][$i]['usephone'] = $row['下单用户手机'];
                    $data['aaData'][$i]['excsum'] = $row['积分总数'];
                    $data['aaData'][$i]['address'] = $row['收货地址'];
                    $data['aaData'][$i]['ordtime'] = $row['下单时间'];
                    $data['aaData'][$i]['ordsta'] = $row['交易确认状态'];
                    $data['aaData'][$i]['gettime'] = $row['物流收货时间'];
                    $data['aaData'][$i]['sendname'] = $row['物流员姓名'];
                    $data['aaData'][$i]['sendnumb'] = $row['物流员手机'];
                    $i++;
                }
            }
            $json = json_encode($data);
            echo $json;
            break;
            
            case 'question':
        	$sql_sel = "SELECT 订单号,产品名称,产品数量,单位,价格,金额,总金额,下单用户姓名,下单用户手机,积分总数,收货地址,下单时间,交易确认状态,物流收货时间,物流员姓名,物流员手机 FROM `查询订单详情`WHERE `交易确认状态`='待核实' ";
            $result_sel = $conn->query($sql_sel);
            $data['aaData'] = array();
            if($result_sel->num_rows > 0)
            {	
            	$i = 0;
                while($row = $result_sel->fetch_assoc())
                {
                    $data['aaData'][$i]['ordnum'] = $row['订单号'];
                    $data['aaData'][$i]['proname'] = $row['产品名称'];
                    $data['aaData'][$i]['pronum'] = $row['产品数量'];
                    $data['aaData'][$i]['prounit'] = $row['单位'];
                    $data['aaData'][$i]['proprice'] = $row['价格'];
                    $data['aaData'][$i]['money'] = $row['金额'];
                    $data['aaData'][$i]['summoney'] = $row['总金额'];
                    $data['aaData'][$i]['usename'] = $row['下单用户姓名'];
                    $data['aaData'][$i]['usephone'] = $row['下单用户手机'];
                    $data['aaData'][$i]['excsum'] = $row['积分总数'];
                    $data['aaData'][$i]['address'] = $row['收货地址'];
                    $data['aaData'][$i]['ordtime'] = $row['下单时间'];
                    $data['aaData'][$i]['ordsta'] = $row['交易确认状态'];
                    $data['aaData'][$i]['gettime'] = $row['物流收货时间'];
                    $data['aaData'][$i]['sendname'] = $row['物流员姓名'];
                    $data['aaData'][$i]['sendnumb'] = $row['物流员手机'];
                    $i++;
                }
            }
//       
            $json = json_encode($data);
            echo $json;
            break;
            case 'all':
        	$sql_sel = "SELECT 订单号,产品名称,类型名,产品数量,单位,价格,金额,总金额,下单用户姓名,下单用户手机,积分总数,收货地址,下单时间,交易确认状态,物流收货时间,物流员姓名,物流员手机 FROM `查询订单详情`";
            $result_sel = $conn->query($sql_sel);
            $data['aaData'] = array();
            if($result_sel->num_rows > 0)
            {	
            	$i = 0;
                while($row = $result_sel->fetch_assoc())
                {
                    $data['aaData'][$i]['ordnum'] = $row['订单号'];
                    $data['aaData'][$i]['proname'] = $row['产品名称'];
                    $data['aaData'][$i]['protype'] = $row['类型名'];
                    $data['aaData'][$i]['pronum'] = $row['产品数量'];
                    $data['aaData'][$i]['prounit'] = $row['单位'];
                    $data['aaData'][$i]['proprice'] = $row['价格'];
                    $data['aaData'][$i]['money'] = $row['金额'];
                    $data['aaData'][$i]['summoney'] = $row['总金额'];
                    $data['aaData'][$i]['usename'] = $row['下单用户姓名'];
                    $data['aaData'][$i]['usephone'] = $row['下单用户手机'];
                    $data['aaData'][$i]['excsum'] = $row['积分总数'];
                    $data['aaData'][$i]['address'] = $row['收货地址'];
                    $data['aaData'][$i]['ordtime'] = $row['下单时间'];
                    $data['aaData'][$i]['ordsta'] = $row['交易确认状态'];
                    $data['aaData'][$i]['gettime'] = $row['物流收货时间'];
                    $data['aaData'][$i]['sendname'] = $row['物流员姓名'];
                    $data['aaData'][$i]['sendnumb'] = $row['物流员手机'];
                    $i++;
                }
            }
//       
            $json = json_encode($data);
            echo $json;
            break;
               
        default:break;
    }
?>