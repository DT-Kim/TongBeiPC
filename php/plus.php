<?php
header("Access-Control-Allow-Origin: *");
    $flag = $_POST['flag'];
    require('conn.php');
    switch($flag)
    {
//  新建节点
        case 'addNew':
            require('upload.class.php');
            $data['status'] = 'error';
            $Dec = $_POST['dec'];
			$PrcID = $_POST['PrcID'];//产品信息id
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
            $sqlChe = "select 位置信息 from 产品轮播图 order by 位置信息 desc";
            $Num = $conn->query($sqlChe)->fetch_assoc();
            $PlaceNum = $Num['位置信息'] + 1;
                //保存广告信息
            $sqlSave = "insert into 产品轮播图 (图片地址,图片说明,位置信息,产品信息id) values('".$UrlData."','".$Dec."','".$PlaceNum."','".$PrcID."') ";
            $conn->query($sqlSave);
            
            $json = json_encode($data);
            echo $json;
            break;
            
//删除节点         
        case 'delAds':
        	$id=$_POST['id'];
			
			$data['status'] = 'error';
			
			$sql = "SELECT 图片地址 FROM 产品轮播图 where id = '".$id."'";
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
				$sql_del="delete from `产品轮播图` where id = '".$id."'";
				if($conn->query($sql_del)){
					 $data['status'] = 'success';
				}
			}else{
				$data['status'] = 'success';
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
            $AdsSta = $_POST['AdsSta'];
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
            $sqlChe = "select 位置信息 from 产品轮播图 order by 位置信息 desc";
            $Num = $conn->query($sqlChe)->fetch_assoc();
            $PlaceNum = $Num['位置信息'] + 1;
//                更新广告信息
            $sqlSave = "update `产品轮播图`  set `图片地址` = '".$UrlData."',`图片说明`= '".$Dec."',  `热门状态`= '".$AdsSta."'where id = '".$id."' ";
            $conn->query($sqlSave);
            $json = json_encode($data);
            echo $json;
            break;
        //修改节点（无图片）         
        case 'editAds2':
            $id=$_POST['id'];
	        $Dec = $_POST['dec'];
	        $AdsSta = $_POST['AdsSta'];
	        $sql_save = "update `产品轮播图`  set `图片说明`= '".$Dec."', `热门状态`= '".$AdsSta."'where id = '".$id."'";
	        $result_save = $conn->query($sql_save);
	        $data['status'] = 'error';
	        if($result_save){
	            $data['status'] = 'success';
	        }
	        $json = json_encode($data);
	        echo $json;
		    break;
		//关闭图片        
//	    case 'closephoto':
//      	$id=$_POST['id'];
//          $stament = $_POST['stament'];
//          $sql_save = "update `产品轮播图`  set `图片状态`= '".$stament."'where id = '".$id."'";
//          $result_save = $conn->query($sql_save);
//          $data['status'] = 'error';
//          if($result_save){
//              $data['status'] = 'success';
//          }
//          $json = json_encode($data);
//          echo $json;
//	        break;
//	     //显示图片
//	    case 'showphoto':
//      	$id=$_POST['id'];
//          $stament = $_POST['stament'];
//          $sql_save = "update `产品轮播图`  set `图片状态`= '".$stament."'where id = '".$id."'";
//          $result_save = $conn->query($sql_save);
//          $data['status'] = 'error';
//          if($result_save){
//              $data['status'] = 'success';
//          }
//          $json = json_encode($data);
//          echo $json;
//	        break;
		case 'savesta':
        	$id=$_POST['id'];
            $psta = $_POST['psta'];
            $sql_save = "update `产品轮播图`  set `图片状态`= '".$psta."'where id = '".$id."'";
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
	    	$proid = $_POST["proid"];
			//返回信息
			$ret_data = array(
				"state"=>"default",
				"message"=>"",
				"data"=>array()
			);
			
			$sql = "SELECT id,图片说明 FROM 产品轮播图 WHERE 产品信息id='".$proid."' ORDER BY 位置信息 ASC";
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
		case "SaveSetAddress"://保存位置信息
			//接收数据
			$sdata = $_POST["sdata"];
			
			//返回信息
			$ret_arr = array(
				"state"=>"success",
				"message"=>""
			);
			//更新数据库
			foreach($sdata as $index => $rowid){
				$sql = "UPDATE 产品轮播图 SET 位置信息='".(intval($index)+1)."' WHERE id='".$rowid."'";
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
    /*
     * 检测图片宽高
     */
?>