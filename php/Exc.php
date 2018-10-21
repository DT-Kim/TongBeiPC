<?php
header("Access-Control-Allow-Origin: *");
   require('conn.php');
   $flag = $_POST['flag'];
   switch($flag)
   {
   	/*
   	 * 新建
   	 */
   	case 'addNew':
   	//图片处理
   	    require('upload_exc.php');
        $data['status'] = 'error';
        $ImgData = getimagesize($_FILES['ProListPic']['tmp_name']);
        $Che = new upload('ProListPic');
        $UrlData = $Che->uploadFile(); 
        //存储数据
   		$name = $_POST['name'];
   		$req = $_POST['req'];
   		$else = $_POST['else'];
   		$sql_check="select id from 积分商品 where 商品名称 ='".$name."'";
   		$result_check = $conn->query($sql_check)->fetch_assoc();
   		if(isset($result_check['id'])){
   			$data['status'] = 'exist';
   		}
   		else{
            $sql_save = "insert into 积分商品(商品名称,积分要求,商品描述,展示图) values('".$name."','".$req."','".$else."','".$UrlData."')";
            $result_save = $conn->query($sql_save);
            $sql_check1 = "select id from 积分商品 where 商品名称 = '".$name."'";
            $result_check1 = $conn->query($sql_check1)->fetch_assoc();
            if(isset($result_check1['id'])){
                $data['status'] = 'success';
            }
        }
     $json = json_encode($data);
     echo $json;
     break;
     /*
      * 删除
      */
    case 'delExc':
    	$id = $_POST['id'];
        $sql_del = "delete from `积分商品` where id = '".$id."'";
        $result_del = $conn->query($sql_del);
        $data['status'] = 'error';
        if($result_del){
            $data['status'] = 'success';
        }
        $json = json_encode($data);
        echo $json;
        break;
    /*
     * 编辑
     */
     case 'editExc':
     	require('upload_exc.php');
        $data['status'] = 'error';
//      $ImgData = getimagesize($_FILES['ProListPic']['tmp_name']);
//      $Che = new upload('ProListPic');
//      $UrlData = $Che->uploadFile(); 
        
        $name = $_POST['name'];
   		$req = $_POST['req'];
   		$else = $_POST['else'];
        $id = $_POST['id'];
        $sql = "SELECT 展示图  FROM 积分商品 WHERE id='".$id."'";
			$pic_address = array(
				0=>""
			);
			$result = $conn->query($sql);
			if($result->num_rows>0){
				while($row = $result->fetch_row()){
					if(!empty($row[0])){
						$tem = explode("/", $row[0]);
						$pic_address[0] = "../AboutImg/Exc/".end($tem);
					}
				}
			}
			
			$File_sql = "";
			if(isset($_FILES['ProListPic'])){
				$ImgData1 = getimagesize($_FILES['ProListPic']['tmp_name']);
	            $Che1 = new upload('ProListPic');
	            $UrlData1 = $Che1->uploadFile();
				$File_sql = " ,展示图='".$UrlData1."'";
				if(!empty($pic_address[0])){
					if(file_exists($pic_address[0])){
						unlink($pic_address[0]);
					}
				}
			}
			//更新数据库信息
        $sql_save = "update 积分商品  set 商品名称 = '".$name."',积分要求= '".$req."', 商品描述= '".$else."'".$File_sql." where id = '".$id."'";
        $result_save = $conn->query($sql_save);
//      $data['status'] = 'error';
        if($result_save){
            $data['status'] = 'success';
        }
        $json = json_encode($data);
        echo $json;
        break;
    case 'save':
    	$id=$_POST['id'];
    	$pname=$_POST["pname"];
        $punit = $_POST['punit'];
        $phot = $_POST['phot'];
//      $pprice = $_POST['pprice'];
        $psta = $_POST['psta'];
        $exc = $_POST['exc'];
        $ptext = $_POST['ptext'];
        $pcontent = $_POST['pcontent'];
        $sql_save = "update `积分商品` set `商品名称`= '".$pname."', `单位`= '".$punit."', `详细内容`= '".$pcontent."', `商品状态`= '".$psta."', `热门状态`= '".$phot."', `积分要求`= '".$exc."', `商品描述`= '".$ptext."'where id = '".$id."'";
       
        $result_save = $conn->query($sql_save);
        $data['status'] = 'error';
        if($result_save){
            $data['status'] = 'success';
        }
        $json = json_encode($data);
        echo $json;
	    break;
	case 'add_photo':
            require('upload.class.php');
            $data['status'] = 'error';
            $Dec = $_POST['dec'];
			$goodID = $_POST['goodID'];//商品的id
			$PhoSta = $_POST['PhoSta'];
            $ImgData = getimagesize($_FILES['AdsImg']['tmp_name']);
            $Che = new upload('AdsImg');
            $UrlData = $Che->uploadFile();
            if(isset($UrlData))
            {
                $data['status'] = 'success';
                $data['url'] = $UrlData;
                //转换图片长宽
                if(!$ImgData[0] == 833 && $ImgData[1] == 400)
                {
                    //$imgsrc jpg格式图像路径 $imgdst jpg格式图像保存文件名 $imgwidth要改变的宽度 $imgheight要改变的高度
                    //取得图片的宽度,高度值
                    $arr = getimagesize($data['url']);
                    $ect = pathinfo($_FILES['AdsImg']['name'],PATHINFO_EXTENSION);
                    header("Content-type: image/".$ect);
                    $imgWidth = 833;
                    $imgHeight = 400;
                    // Create image and define colors
                    $imgsrc = imagecreatefromjpeg($data['url']);
                    $image = imagecreatetruecolor($imgWidth, $imgHeight);  //创建一个彩色的底图
                    imagecopyresampled($image, $imgsrc, 0, 0, 0, 0,$imgWidth,$imgHeight,$arr[0], $arr[1]);
                    imagepng($image);
                    imagedestroy($image);
                }
            }
            //广告节点保存
                //获取最后一条
            $sqlChe = "select 位置信息 from 商品轮播图 order by 位置信息 desc";
            $Num = $conn->query($sqlChe)->fetch_assoc();
            $PlaceNum = $Num['位置信息'] + 1;
                //保存广告信息
            $sqlSave = "insert into 商品轮播图 (图片地址,图片说明,位置信息,商品id,图片状态) values('".$UrlData."','".$Dec."','".$PlaceNum."','".$goodID."','".$PhoSta."') ";
            $conn->query($sqlSave);
            $json = json_encode($data);
            echo $json;
            break;
            
//删除节点         
        case 'delAds':
        	$id=$_POST['id'];
			
			$data['status'] = 'error';
			
			$sql = "SELECT 图片地址 FROM 商品轮播图 where id = '".$id."'";
			$result = $conn->query($sql);
			if($result->num_rows>0){
				//删除文件
				$image_path = "";
				while($row = $result->fetch_row()){
					if(!empty($row[0])){
						$image_path = $row[0];//获取目标文件的路径
						$temp_arr = explode("/", $image_path);
						$image_path = "../AboutImg/ImgAD/".end($temp_arr);//重构相对的文件路径
						if(file_exists($image_path)){//检测目标文件是否存在
							unlink($image_path);//删除目标文件
						}
					}
				}
				//删除数据库记录
				$sql_del="delete from `商品轮播图` where id = '".$id."'";
				if($conn->query($sql_del)){
					 $data['status'] = 'success';
				}
			}
            $json = json_encode($data);
            echo $json;
        break;
        
//      修改节点(需上传图片)
        case 'editAds':
        	require('upload.class.php');
            $data['status'] = 'error';
            $id=$_POST['id'];
            $Dec = $_POST['dec'];
            $PhoSta = $_POST['PhoSta'];
            $ImgData = getimagesize($_FILES['AdsImg']['tmp_name']);
            $Che = new upload('AdsImg');
            $UrlData = $Che->uploadFile();
            if(isset($UrlData))
            {
                $data['status'] = 'success';
                $data['url'] = $UrlData;
                //转换图片长宽
                if(!$ImgData[0] == 833 && $ImgData[1] == 400)
                {
                    //$imgsrc jpg格式图像路径 $imgdst jpg格式图像保存文件名 $imgwidth要改变的宽度 $imgheight要改变的高度
                    //取得图片的宽度,高度值
                    $arr = getimagesize($data['url']);
                    $ect = pathinfo($_FILES['AdsImg']['name'],PATHINFO_EXTENSION);
                    header("Content-type: image/".$ect);
                    $imgWidth = 833;
                    $imgHeight = 400;
                    // Create image and define colors
                    $imgsrc = imagecreatefromjpeg($data['url']);
                    $image = imagecreatetruecolor($imgWidth, $imgHeight);  //创建一个彩色的底图
                    imagecopyresampled($image, $imgsrc, 0, 0, 0, 0,$imgWidth,$imgHeight,$arr[0], $arr[1]);
                    imagepng($image);
                    imagedestroy($image);
                }
            }
//            广告节点保存
                //获取最后一条
            $sqlChe = "select 位置信息 from 商品轮播图 order by 位置信息 desc";
            $Num = $conn->query($sqlChe)->fetch_assoc();
            $PlaceNum = $Num['位置信息'] + 1;
//                更新广告信息
            $sqlSave = "update `商品轮播图`  set `图片地址` = '".$UrlData."',`图片说明`= '".$Dec."',  `图片状态`= '".$PhoSta."'where id = '".$id."' ";
            $conn->query($sqlSave);
            $json = json_encode($data);
            echo $json;
            break;
        //修改节点（无图片）         
        case 'editAds2':
            $id=$_POST['id'];
	        $Dec = $_POST['dec'];
	        $PhoSta = $_POST['PhoSta'];
	        $sql_save = "update `商品轮播图`  set `图片说明`= '".$Dec."', `图片状态`= '".$PhoSta."'where id = '".$id."'";
	        $result_save = $conn->query($sql_save);
	        $data['status'] = 'error';
	        if($result_save){
	            $data['status'] = 'success';
	        }
	        $json = json_encode($data);
	        echo $json;
		    break;
	     //显示图片
	    case "GetAddress"://获取位置信息
	    	$goodid = $_POST["goodid"];
			//返回信息
			$ret_data = array(
				"state"=>"default",
				"message"=>"",
				"data"=>array()
			);
			
			$sql = "SELECT id,图片说明 FROM 商品轮播图 WHERE 商品id='".$goodid."' ORDER BY 位置信息 ASC";
			$result = $conn->query($sql);
			if($result->num_rows>0){
				$i = 0;
				while($row = $result->fetch_row()){
					$ret_data["data"][$i]["rowid"] = $row[0];
					$ret_data["data"][$i]["Ads"] = $row[1];
					
					$i++;
				}
				$ret_data["state"] = "success";
				$ret_data["message"] = "获取成功";
			}else{
				$ret_data["message"] = "无数据";
			}
			
			$json = json_encode($ret_data);
			echo $json;
			break;
		case "SaveSetAddress"://保存位置信息ok
		
			//接收数据
			$sdata = $_POST["sdata"];
			
			//返回信息
			$ret_arr = array(
				"state"=>"success",
				"message"=>""
			);
			//更新数据库
			foreach($sdata as $index => $rowid){
				$sql = "UPDATE 商品轮播图 SET 位置信息='".(intval($index)+1)."' WHERE id='".$rowid."'";
				if(!$conn->query($sql)){
					$ret_arr["state"] = "default";
					$ret_arr["message"] .= "更新失败+".$rowid+",";
				}
			}
			
			$json = json_encode($ret_arr);
			echo $json;
			break;
	default:break;
   }
   
?>