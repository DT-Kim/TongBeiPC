<?php
	require('conn.php');
	$falg=$_POST['falg'];
	switch($falg)
	{
		case 'show':
			$id=$_POST['id'];
			$sql_sel = "select * from 产品信息  where id ='".$id."'";
			$result_sel = $conn->query($sql_sel);
			$data= array();
		       if($result_sel->num_rows > 0)
		        {
		            while($row = $result_sel->fetch_assoc())
		            {
		                $data['proname'] = $row['产品名称'];
		                $data['prounit'] = $row['单位'];
		                $data['proprice'] = $row['价格'];
		                $data['exc'] = $row['积分倍数'];
		                $data['prohot'] = $row['热门状态'];
		                $data['procontent'] = $row['介绍'];
		                $data['prophoto'] = $row['展示图'];
		                $data['protext'] = $row['内容摘要'];
		                $data['prosta'] = $row['产品状态'];
//		                $data['probrand'] = $row['品牌'];
//		                $data['proplace'] = $row['产地'];
//		                $data['promaterial'] = $row['材质'];
//		                $data['promarket'] = $row['市场价格'];
//		                $data['proweg'] = $row['产品重量'];
//		                $data['phototitle'] = $row['图片标题'];
		            }
		        }
		    $json = json_encode($data);
		    echo $json;
    		break;
        case 'save':
        	$id=$_POST['id'];
        	$pname=$_POST["pname"];
	        $punit = $_POST['punit'];
	        $phot = $_POST['phot'];
	        $pprice = $_POST['pprice'];
	        $psta = $_POST['psta'];
	        $exc = $_POST['exc'];
	        $ptext = $_POST['ptext'];
	        $pcontent = $_POST['pcontent'];
	        $sql_save = "update `产品信息` set `产品名称`= '".$pname."', `单位`= '".$punit."', `介绍`= '".$pcontent."', `价格`= '".$pprice."', `产品状态`= '".$psta."', `热门状态`= '".$phot."', `积分倍数`= '".$exc."', `内容摘要`= '".$ptext."'where id = '".$id."'";
	       
	        $result_save = $conn->query($sql_save);
	        $data['status'] = 'error';
	        if($result_save){
	            $data['status'] = 'success';
	        }
	        $json = json_encode($data);
	        echo $json;
		    break;
		default:break;
    }
?>