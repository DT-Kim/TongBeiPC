<?php
	require('conn.php');
	$flag=$_POST['flag'];
	switch($flag)
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
        //修改产品图片的保存
        	require('upload_ProList.php');
        	$id=$_POST['id'];
        	$pname=$_POST["pname"];
	        $punit = $_POST['punit'];
	        $phot = $_POST['phot'];
	        $pprice = $_POST['pprice'];
	        $psta = $_POST['psta'];
	        $exc = $_POST['exc'];
	        $ptext = $_POST['ptext'];
	        $pcontent = $_POST['pcontent'];
	        //图片处理
        	if(isset($_FILES['ProImg'])){
        	$ImgData = getimagesize($_FILES['ProImg']['tmp_name']);
            $Che = new upload('ProImg');
            $UrlData = $Che->uploadFile();
	        $sql_save = "update `产品信息` set `产品名称`= '".$pname."', `单位`= '".$punit."',  `价格`= '".$pprice."', `产品状态`= '".$psta."', `热门状态`= '".$phot."', `积分倍数`= '".$exc."', `内容摘要`= '".$ptext."', `介绍`= '".$pcontent."', `展示图`= '".$UrlData."'where id = '".$id."'";
	        $result_save = $conn->query($sql_save);
	        $data['status'] = 'error';
	        if($result_save){
	            $data['status'] ='success';
	        }
	        $json =json_encode($data);
	        echo $json;
	        }
	        else{
	        	 $sql_save = "update `产品信息` set `产品名称`= '".$pname."', `单位`= '".$punit."',  `价格`= '".$pprice."', `产品状态`= '".$psta."', `热门状态`= '".$phot."', `积分倍数`= '".$exc."', `内容摘要`= '".$ptext."', `介绍`= '".$pcontent."'where id = '".$id."'";
		        $result_save = $conn->query($sql_save);
		        $data['status'] = 'error';
		        if($result_save){
		            $data['status'] ='success';
		        }
		        $json =json_encode($data);
		        echo $json;
	        }
		    break;
		    //删除
		case 'del':
		    $proid =$_POST['proid'];
		    $sql_del="DELETE  FROM `产品信息`  where id='".$proid."'";
		    $result_del = $conn->query($sql_del);
		     $data['status'] = 'error';
	        if($result_del){
	            $data['status'] ='success';
	        }
	        $json = json_encode($data);
	        echo $json;
		    break;
		
		default:break;
    }
?>