<?php
header("Access-Control-Allow-Origin: *");
//	$ney = $_GET['ney'];
    require('conn.php');
    	
		//查询每个月待收货的数量
		$j=1;
		$data['aaData'] = array();
		while($j<12){
            $sql_sel = "SELECT 产品数量  FROM `查询订单详情`WHERE `交易确认状态`='待收货' and `下单时间` BETWEEN '2018-".$j."-01' and '2018-".($j+1)."-01' ";
            $result_sel = $conn->query($sql_sel);
            $i = 0;
            if($result_sel->num_rows > 0)
            {	
                while($row = $result_sel->fetch_assoc())
                {
                    $i++;
                }
            }
            $data['aaData']['wait'][$j] = $i;
			$j++;
  		}
        $sql_sel = "SELECT 产品数量  FROM `查询订单详情`WHERE `交易确认状态`='待收货' and `下单时间` BETWEEN '2018-12-01' and '2019-1-01' ";
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
    	$j=1;
		while($j<12){
            $sql_sel = "SELECT 产品数量  FROM `查询订单详情`WHERE `交易确认状态`='待核实' and `下单时间` BETWEEN '2018-".$j."-01' and '2018-".($j+1)."-01' ";
            $result_sel = $conn->query($sql_sel);
            $i = 0;
            if($result_sel->num_rows > 0)
            {	
                while($row = $result_sel->fetch_assoc())
                {
                    $i++;
                } 
            }
            $data['aaData']['get'][$j] = $i;
            $j++;
       	}
        $sql_sel = "SELECT 产品数量  FROM `查询订单详情`WHERE `交易确认状态`='待核实' and `下单时间` BETWEEN '2018-12-01' and '2019-1-01' ";
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
    	$j=1;
		while($j<12){
            $sql_sel = "SELECT 产品数量  FROM `查询订单详情`WHERE `交易确认状态`='已完成' and `下单时间` BETWEEN '2018-".$j."-01' and '2018-".($j+1)."-01' ";
            $result_sel = $conn->query($sql_sel);
            $i = 0;
            if($result_sel->num_rows > 0)
            {	
                while($row = $result_sel->fetch_assoc())
                {
                    $i++;
                }
            }
            $data['aaData']['question'][$j] = $i;
            $j++;
       }
        $sql_sel = "SELECT 产品数量  FROM `查询订单详情`WHERE `交易确认状态`='已完成' and `下单时间` BETWEEN '2018-12-01' and '2019-1-01' ";
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
    	$j=1;
		while($j<12){
            $sql_sel = "SELECT 产品数量  FROM `查询订单详情`WHERE `下单时间` BETWEEN '2018-".$j."-01' and '2018-".($j+1)."-01' ";
            $result_sel = $conn->query($sql_sel);
            $i = 0;
            if($result_sel->num_rows > 0)
            {	
                while($row = $result_sel->fetch_assoc())
                {
                    $i++;
                }
            }
            $data['aaData']['all'][$j] = $i;
            $j++;
        }
        
        $sql_sel = "SELECT 产品数量  FROM `查询订单详情`WHERE `下单时间` BETWEEN '2018-12-01' and '2019-1-01' ";
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
?>            