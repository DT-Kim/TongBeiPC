<?php
	header("Access-Control-Allow-Origin: *");
    require('conn.php');
	
	$flag = isset($_REQUEST["my_flag"])? $_REQUEST["my_flag"] :"";
//	$flag = 'all';
	
	switch($flag){
		case "all":
			$sql_sel = "SELECT * FROM `用户信息`";
		    $result_sel = $conn->query($sql_sel);
		    $data['aaData'] = array();
		    if($result_sel->num_rows > 0)
		    {
		        $i = 0;
		        while($row = $result_sel->fetch_assoc())
		        {
		            $data['aaData'][$i]['id'] = $row['id'];
		            $data['aaData'][$i]['useacc'] = $row['用户账号'];
		            $data['aaData'][$i]['usepasw'] = $row['用户密码'];
		            $data['aaData'][$i]['usename'] = $row['真实姓名'];
		            $data['aaData'][$i]['usepho'] = $row['用户手机'];
		            switch($row['用户级别id']){
                        case 0://vip
                            $data['aaData'][$i]['uselev'] = 'vip用户';
                        break;
                        case 1://管理员
                            $data['aaData'][$i]['uselev'] = '管理员';
                        break;
                        case 2://用户
                            $data['aaData'][$i]['uselev'] = '普通用户';
                        break;
                        case 3://物流员
                            $data['aaData'][$i]['uselev'] = '物流员';
                        break;
                        default:break;
                    }
		            $data['aaData'][$i]['usetime'] = $row['注册时间'];
		            $data['aaData'][$i]['useprov'] = $row['省'];
		            $data['aaData'][$i]['usecity'] = $row['市'];
		            $data['aaData'][$i]['usearea'] = $row['县'];
		
		            $i++;
		        }
		    }
		    $json = json_encode($data);
		    echo $json;
			break;
		case "user":
			$sql_sel = "SELECT * FROM `用户信息` WHERE (用户级别id='0' OR 用户级别id='2') ";
		    $result_sel = $conn->query($sql_sel);
		    $data['aaData'] = array();
		    if($result_sel->num_rows > 0)
		    {
		        $i = 0;
		        while($row = $result_sel->fetch_assoc())
		        {
		            $data['aaData'][$i]['id'] = $row['id'];
		            $data['aaData'][$i]['useacc'] = $row['用户账号'];
		            $data['aaData'][$i]['usepasw'] = $row['用户密码'];
		            $data['aaData'][$i]['usename'] = $row['真实姓名'];
		            $data['aaData'][$i]['usepho'] = $row['用户手机'];
		            switch($row['用户级别id']){
		                case 0://vip
		                    $data['aaData'][$i]['uselev'] = 'vip用户';
		                break;
		                case 1://管理员
		                    $data['aaData'][$i]['uselev'] = '管理员';
                        break;
                        case 2://用户
                            $data['aaData'][$i]['uselev'] = '普通用户';
                        break;
                        case 3://物流员
                            $data['aaData'][$i]['uselev'] = '物流员';
                        break;
                        default:break;
		            }
		            $data['aaData'][$i]['usetime'] = $row['注册时间'];
		            $data['aaData'][$i]['useprov'] = $row['省'];
		            $data['aaData'][$i]['usecity'] = $row['市'];
		            $data['aaData'][$i]['usearea'] = $row['县'];
		
		            $i++;
		        }
		    }
		    $json = json_encode($data);
		    echo $json;
			break;
		case "logistician":
			$sql_sel = "SELECT * FROM `用户信息` WHERE 用户级别id='3' ";
		    $result_sel = $conn->query($sql_sel);
		    $data['aaData'] = array();
		    if($result_sel->num_rows > 0)
		    {
		        $i = 0;
		        while($row = $result_sel->fetch_assoc())
		        {
		            $data['aaData'][$i]['id'] = $row['id'];
		            $data['aaData'][$i]['useacc'] = $row['用户账号'];
		            $data['aaData'][$i]['usepasw'] = $row['用户密码'];
		            $data['aaData'][$i]['usename'] = $row['真实姓名'];
		            $data['aaData'][$i]['usepho'] = $row['用户手机'];
		            switch($row['用户级别id']){
                        case 0://vip
                            $data['aaData'][$i]['uselev'] = 'vip用户';
                        break;
                        case 1://管理员
                            $data['aaData'][$i]['uselev'] = '管理员';
                        break;
                        case 2://用户
                            $data['aaData'][$i]['uselev'] = '普通用户';
                        break;
                        case 3://物流员
                            $data['aaData'][$i]['uselev'] = '物流员';
                        break;
                        default:break;
                    }
		            $data['aaData'][$i]['usetime'] = $row['注册时间'];
		            $data['aaData'][$i]['useprov'] = $row['省'];
		            $data['aaData'][$i]['usecity'] = $row['市'];
		            $data['aaData'][$i]['usearea'] = $row['县'];
		
		            $i++;
		        }
		    }
		    $json = json_encode($data);
		    echo $json;
			break;
		case "admin":
			$sql_sel = "SELECT * FROM `用户信息` WHERE 用户级别id='1' ";
		    $result_sel = $conn->query($sql_sel);
		    $data['aaData'] = array();
		    if($result_sel->num_rows > 0)
		    {
		        $i = 0;
		        while($row = $result_sel->fetch_assoc())
		        {
		            $data['aaData'][$i]['id'] = $row['id'];
		            $data['aaData'][$i]['useacc'] = $row['用户账号'];
		            $data['aaData'][$i]['usepasw'] = $row['用户密码'];
		            $data['aaData'][$i]['usename'] = $row['真实姓名'];
		            $data['aaData'][$i]['usepho'] = $row['用户手机'];
		            switch($row['用户级别id']){
                        case 0://vip
                            $data['aaData'][$i]['uselev'] = 'vip用户';
                        break;
                        case 1://管理员
                            $data['aaData'][$i]['uselev'] = '管理员';
                        break;
                        case 2://用户
                            $data['aaData'][$i]['uselev'] = '普通用户';
                        break;
                        case 3://物流员
                            $data['aaData'][$i]['uselev'] = '物流员';
                        break;
                        default:break;
                    }
		            $data['aaData'][$i]['usetime'] = $row['注册时间'];
		            $data['aaData'][$i]['useprov'] = $row['省'];
		            $data['aaData'][$i]['usecity'] = $row['市'];
		            $data['aaData'][$i]['usearea'] = $row['县'];
		
		            $i++;
		        }
		    }
		    $json = json_encode($data);
		    echo $json;
			break;
		default :
			echo '{"sError":"标志位不对","aaData":[]}';
		    break;
	}
    
    
?>