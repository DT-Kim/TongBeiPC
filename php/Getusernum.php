<?php
	header("Access-Control-Allow-Origin: *");
	require('conn.php');
	$sql="SELECT count(id)FROM 用户信息";
	$sql_1="SELECT 省 FROM 用户信息";
	$result = $conn->query($sql)->fetch_assoc();
	$result_1 = $conn->query($sql_1);
//	$num=$result['count(id)'];
//	echo $num;
//  for($i='0';$i<$num;$i++){
    if($result_1->num_rows>0)
    {   $Fujian = 0; $Beijing=0;   $Anhui=0;
    	$Guangdong = 0; $Guangxi = 0; $Chongqing = 0;
    	$Gansu = 0; $Aomen = 0; $Hebei = 0;
    	$Jilin = 0; $Hlj = 0; $Jiangsu = 0;
    	$Jiangxi = 0; $Henan = 0; $Hubei = 0;
    	$Hunan = 0;  $Hainan = 0; $Shanxi = 0;
    	$Nmg = 0; $Liaoning = 0; $Shanghai = 0;
    	$Shandong = 0; $Sichuan = 0; $sx1 = 0;
    	$Qinghai = 0; $Ningxia = 0; $Tianjing = 0;
    	$Zhejiang = 0; $Yunnan = 0; $Xizang = 0;
    	$Xinjiang = 0; $Taiwan = 0; $Hongkong = 0;
    	$Guizhou=0;
        $i = 0;
        while($row = $result_1->fetch_assoc())
        {    
        	/*
        	 * 确定每个省份的用户
        	 */
            
            if($row['省'] == "北京")
            {
                $Beijingng++;
            }
            if($row['省'] == "安徽")
            {
                $Anhui++;
            }
            if($row['省'] == "福建")
            {
                $Fujian++;
            }
            if($row['省'] == "广东")
            {
                $Guangdong++;
            }
            if($row['省'] == "广西")
            {
                $Guangxi++;
            }
            if($row['省'] == "重庆")
            {
                $Chongqing++;
            }
            if($row['省'] == "贵州")
            {
                $Guizhou++;
            }
            if($row['省'] == "甘肃")
            {
                $Gansu++;
            }
            if($row['省'] == "澳门")
            {
                $Aomen++;
            }
            if($row['省'] == "河北")
            {
                $Hebei++;
            }
            if($row['省'] == "吉林")
            {
                $Jilin++;
            }
            if($row['省'] == "黑龙江")
            {
                $Hlj++;
            }
            if($row['省'] == "江苏")
            {
                $Jiangsu++;
            }
            if($row['省'] == "江西")
            {
                $Jiangxi++;
            }
            if($row['省'] == "河南")
            {
                $Henan++;
            }
            if($row['省'] == "湖北")
            {
                $Hubei++;
            }
            if($row['省'] == "湖南")
            {
                $Hunan++;
            }
            if($row['省'] == "海南")
            {
                $Hainan++;
            }
            if($row['省'] == "山西")
            {
                $Shanxi++;
            }
            if($row['省'] == "内蒙古")
            {
                $Nmg++;
            }
            if($row['省'] == "辽宁")
            {
                $Liaoning++;
            }
            if($row['省'] == "上海")
            {
                $Shanghai++;
            }
            if($row['省'] == "山东")
            {
                $Shandong++;
            }
            if($row['省'] == "四川")
            {
                $Sichuan++;
            }
            if($row['省'] == "陕西")
            {
                $sx1++;//陕西
            }
            if($row['省'] == "青海")
            {
                $Qinghai++;
            }
            if($row['省'] == "宁夏")
            {
                $Ningxia++;
            }
            if($row['省'] == "天津")
            {
                $Tianjing++;
            }
            if($row['省'] == "浙江")
            {
                $Zhejiang++;
            }
            if($row['省'] == "云南")
            {
                $Yunnan++;
            }
            if($row['省'] == "西藏")
            {
                $Xizang++;
            }
            if($row['省'] == "新疆")
            {
                $Xinjiang++;
            }
            if($row['省'] == "台湾")
            {
                $Taiwan++;
            }
            if($row['省'] == "香港")
            {
                $Hongkong++;
            }
            $i++;
        }
        $data = array();
        $data['Fujian']=$Fujian; 
        $data['Beijing']=$Beijing; 
        $data['Anhui']=$Anhui; 
        $data['Guangdong']=$Guangdong; 
        $data['Guangxi']=$Guangxi; 
        $data['Chongqing']=$Chongqing; 
        $data['Gansu']=$Gansu; 
        $data['Aomen']=$Aomen; 
        $data['Hebei']=$Hebei; 
        $data['Jilin']=$Jilin; 
        $data['Hlj']=$Jilin; 
        $data['Jiangsu']=$Jiangsu; 
        $data['Jiangxi']=$Jiangxi; 
        $data['Henan']=$Henan; 
        $data['Hubei']=$Hubei; 
        $data['Hunan']=$Hunan; 
        $data['Hainan']=$Hainan; 
        $data['Shanxi']=$Shanxi; 
        $data['Nmg']=$Nmg; 
        $data['Liaoning']=$Liaoning; 
        $data['Shanghai']=$Shanghai; 
        $data['Shandong']=$Shandong; 
        $data['Sichuan']=$Sichuan; 
        $data['sx1']=$sx1; 
        $data['Qinghai']=$Qinghai; 
        $data['Ningxia']=$Ningxia; 
        $data['Tianjing']=$Tianjing; 
        $data['Zhejiang']=$Zhejiang; 
        $data['Yunnan']=$Yunnan; 
        $data['Xizang']=$Xizang; 
        $data['Xinjiang']=$Xinjiang; 
        $data['Taiwan']=$Taiwan; 
        $data['Hongkong']=$Hongkong; 
        $data['Guizhou']=$Guizhou; 
        $json = json_encode($data);
        echo $json;

    }
    
?>