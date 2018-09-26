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
            $sqlSave = "insert into 产品轮播图 (图片地址,图片说明,位置信息) values('".$UrlData."','".$Dec."','".$PlaceNum."') ";
            $conn->query($sqlSave);
            
            $json = json_encode($data);
            echo $json;
            break;
            
//删除节点         
        case 'delAds':
        	$id=$_POST['id'];
        	$sql_del="delete from `产品轮播图` where id = '".$id."'";
        	$result_del = $conn->query($sql_del);
            $data['status'] = 'error';
            if($result_del){
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
	    default:break;
    }
    /*
     * 检测图片宽高
     */
?>