<?php
header("Access-Control-Allow-Origin: *");
    require('conn.php');
    $flag=$_POST['flag'];
    switch($flag){
    	case 'wait':
		//  分组查询，进行对应产品的数量统计
		    $sql="SELECT`产品名称`, SUM(`产品数量`) FROM `查询订单详情`  WHERE `交易确认状态`='待收货' GROUP BY `产品名称`";
		    $result = $conn->query($sql);
		    $data = array();
		    if($result->num_rows>0){
		    	 $i = 0;
		        while($row = $result->fetch_assoc())
		        {  
		             $data[$i]['product']=$row['产品名称'] ;
		             $data[$i]['num']=$row['SUM(`产品数量`)'] ;
		             $i++;
		        }
		        
		    }
	        else{
	        	 $data['product']=0 ;
		         $data['num']=0 ;
//			         $json = json_encode($data);
//			         echo $json;
	        }
	        $json = json_encode($data);
		        echo $json;
		    break;
		    case 'check':
		        $sql="SELECT`产品名称`, SUM(`产品数量`) FROM `查询订单详情`  WHERE `交易确认状态`='待核实' GROUP BY `产品名称`";
			    $result = $conn->query($sql);
			    $data = array();
			    if($result->num_rows>0){
			    	 $i = 0;
			        while($row = $result->fetch_assoc())
			        {  
			             $data[$i]['product']=$row['产品名称'] ;
			             $data[$i]['num']=$row['SUM(`产品数量`)'] ;
			             $i++;
			        }
			        
		        }
		        else{
		        	 $data['product']=0 ;
			         $data['num']=0 ;
//			         $json = json_encode($data);
//			         echo $json;
		        }
		        $json = json_encode($data);
			    echo $json;
		    break;
		    case 'finish':
		        $sql="SELECT`产品名称`, SUM(`产品数量`) FROM `查询订单详情`  WHERE `交易确认状态`='已完成' GROUP BY `产品名称`";
			    $result = $conn->query($sql);
			    $data = array();
			    if($result->num_rows>0){
			    	 $i = 0;
			        while($row = $result->fetch_assoc())
			        {  
			             $data[$i]['product']=$row['产品名称'] ;
			             $data[$i]['num']=$row['SUM(`产品数量`)'] ;
			             $i++;
			        } 
		        } 
		        else{
		        	 $data['product']=0 ;
			         $data['num']=0 ;
//			         $json = json_encode($data);
//			         echo $json;
		        }
		        $json = json_encode($data);
			        echo $json;
		    break;
		    case 'sum':
		        $y=$_POST['year'];
//				$y='2015';
//		        输出每个月的所有相关变量
		        $m=1;
				$data['aaData'] = array();
				while($m<12){
		            $sql_sel = "SELECT 产品数量  FROM `查询订单详情`WHERE `交易确认状态`='待收货' and `下单时间` BETWEEN '".$y."-".$m."-01' and '".$y."-".($m+1)."-01' ";
		            $result_sel = $conn->query($sql_sel);
		            $i = 0;
		            if($result_sel->num_rows > 0)
		            {	
		                while($row = $result_sel->fetch_assoc())
		                {
		                    $i++;
		                }
		            }
		            $data['aaData']['wait'][$m] = $i;
					$m++;
		  		}
		        $sql_sel = "SELECT 产品数量  FROM `查询订单详情`WHERE `交易确认状态`='待收货' and `下单时间` BETWEEN '".$y."-12-01' and '".($y+1)."-1-01'";
		        $result_sel = $conn->query($sql_sel);
		        $i = 0;
		        if($result_sel->num_rows > 0)
		        {	
		            while($row = $result_sel->fetch_assoc())
		            {
		                $i++;
		            }
		        }
		        $data['aaData']['wait'][12] = $i;
		          		
				//查询每个月已完成的数量
		    	$m=1;
				while($m<12){
		            $sql_sel = "SELECT 产品数量  FROM `查询订单详情`WHERE `交易确认状态`='待核实' and `下单时间` BETWEEN '".$y."-".$m."-01' and '".$y."-".($m+1)."-01' ";
		            $result_sel = $conn->query($sql_sel);
		            $i = 0;
		            if($result_sel->num_rows > 0)
		            {	
		                while($row = $result_sel->fetch_assoc())
		                {
		                    $i++;
		                } 
		            }
		            $data['aaData']['get'][$m] = $i;
		            $m++;
		       	}
		        $sql_sel = "SELECT 产品数量  FROM `查询订单详情`WHERE `交易确认状态`='待核实' and `下单时间` BETWEEN '".$y."-12-01' and '".($y+1)."-1-01'";
		        $result_sel = $conn->query($sql_sel);
		        $i = 0;
		        if($result_sel->num_rows > 0)
		        {	
		            while($row = $result_sel->fetch_assoc())
		            {
		                $i++;
		            }
		        }
		        $data['aaData']['get'][12] = $i;
		               
				//查询每个月已完成的数量
		    	$m=1;
				while($m<12){
		            $sql_sel = "SELECT 产品数量  FROM `查询订单详情`WHERE `交易确认状态`='已完成' and `下单时间` BETWEEN '".$y."-".$m."-01' and '".$y."-".($m+1)."-01' ";
		            $result_sel = $conn->query($sql_sel);
		            $i = 0;
		            if($result_sel->num_rows > 0)
		            {	
		                while($row = $result_sel->fetch_assoc())
		                {
		                    $i++;
		                }
		            }
		            $data['aaData']['question'][$m] = $i;
		            $m++;
		       }
		        $sql_sel = "SELECT 产品数量  FROM `查询订单详情`WHERE `交易确认状态`='已完成' and `下单时间` BETWEEN '".$y."-12-01' and '".($y+1)."-1-01' ";
		        $result_sel = $conn->query($sql_sel);
		        $i = 0;
		        if($result_sel->num_rows > 0)
		        {	
		            while($row = $result_sel->fetch_assoc())
		            {
		                $i++;
		            }
		        }
		        $data['aaData']['question'][12] = $i;
		        
		        //查询每个月全部订单的数量
		    	$m=1;
				while($m<12){
		            $sql_sel = "SELECT 产品数量  FROM `查询订单详情`WHERE `下单时间` BETWEEN '".$y."-".$m."-01' and '".$y."-".($m+1)."-01' ";
		            $result_sel = $conn->query($sql_sel);
		            $i = 0;
		            if($result_sel->num_rows > 0)
		            {	
		                while($row = $result_sel->fetch_assoc())
		                {
		                    $i++;
		                }
		            }
		            $data['aaData']['all'][$m] = $i;
		            $m++;
		        }
		        
		        $sql_sel = "SELECT 产品数量  FROM `查询订单详情`WHERE `下单时间` BETWEEN '".$y."-12-01' and '".($y+1)."-1-01' ";
		        $result_sel = $conn->query($sql_sel);
		        $i = 0;
		        if($result_sel->num_rows > 0)
		        {	
		            while($row = $result_sel->fetch_assoc())
		            {
		                $i++;
		            }
		        }
		        $data['aaData']['all']['12'] = $i;
		            
		        $json = json_encode($data);
		        echo $json;
		    break;
		    default:break;
    
    }
?>