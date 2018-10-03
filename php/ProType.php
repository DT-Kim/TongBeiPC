<?php
    header("Access-Control-Allow-Origin: *");
    require('conn.php');
    $falg = $_POST['falg'];
//  $falg = "addNewPro";
    switch($falg)
    {
        /*
         * 新建类型
         */
        case 'addNew':
			require('upload_type.php');
            $data['status'] = 'error';
		 	$ImgData = getimagesize($_FILES['ProTypeLogo']['tmp_name']);
            $Che = new upload('ProTypeLogo');
            $UrlData = $Che->uploadFile();
			
			$ImgData1 = getimagesize($_FILES['ProTypeFile']['tmp_name']);
            $Che1 = new upload('ProTypeFile');
            $UrlData1 = $Che1->uploadFile();
			
            $name = $_POST['name'];
            $else = $_POST['else'];
            $sql_check = "select id from 产品类型 where 类型名 = '".$name."' ";
            $result_check = $conn->query($sql_check)->fetch_assoc();
            if(isset($result_check['id'])){
                $data['status'] = 'exist';
            }
            else{
                $sql_save = "insert into 产品类型(类型名,类型介绍,图标地址,图片地址) values('".$name."','".$else."','".$UrlData."','".$UrlData1."')";
                $result_save = $conn->query($sql_save);
                $sql_check = "select id from 产品类型 where 类型名 = '".$name."' ";
                $result_check = $conn->query($sql_check)->fetch_assoc();
                if(isset($result_check['id'])){
                    $data['status'] = 'success';
                }
            }
            $json = json_encode($data);
            echo $json;
        break;
        /*
         * 删除类型
         */
        case 'delType':
            $id = $_POST['id'];
			
			$sql = "SELECT 图标地址,图片地址 FROM 产品类型 WHERE id='".$id."'";
			$result = $conn->query($sql);
			if($result->num_rows>0){
				while($row = $result->fetch_row()){
					if(!empty($row[0])){
						$tem = explode("/", $row[0]);
						$pic_address = "../AboutImg/ProType/".end($tem);
						if(file_exists($pic_address)){
							unlink($pic_address);
						}
					}
					
					if(!empty($row[1])){
						$tem2 = explode("/", $row[1]);
						$pic_address2 = "../AboutImg/ProType/".end($tem2);
						if(file_exists($pic_address2)){
							unlink($pic_address2);
						}
					}
				}
			}
			
            $sql_del = "delete from 产品类型 where id = '".$id."'";
            $result_del = $conn->query($sql_del);
            $data['status'] = 'error';
            if($result_del){
                $data['status'] = 'success';
            }
            $json = json_encode($data);
            echo $json;
        break;
        /*
         * 修改类型
         */
        case 'editType':
        	require('upload_type.php');
			//接收数据
			$name = $_POST['name'];
            $else = $_POST['else'];
			$id = $_POST['id'];
			
            $data['status'] = 'error';
			
			//查询数据库的两个地址信息
			$sql = "SELECT 图标地址,图片地址 FROM 产品类型 WHERE id='".$id."'";
			$pic_address = array(
				0=>"",
				1=>""
			);
			$result = $conn->query($sql);
			if($result->num_rows>0){
				while($row = $result->fetch_row()){
					if(!empty($row[0])){
						$tem = explode("/", $row[0]);
						$pic_address[0] = "../AboutImg/ProType/".end($tem);
					}
					if(!empty($row[1])){
						$tem2 = explode("/", $row[1]);
						$pic_address[1] = "../AboutImg/ProType/".end($tem2);
					}
				}
			}
			
			$Logo_sql = "";
			if(isset($_FILES['ProTypeLogo'])){
				$ImgData = getimagesize($_FILES['ProTypeLogo']['tmp_name']);
	            $Che = new upload('ProTypeLogo');
	            $UrlData = $Che->uploadFile();
				$Logo_sql = " ,图标地址='".$UrlData."'";
				if(!empty($pic_address[0])){
					if(file_exists($pic_address[0])){
						unlink($pic_address[0]);
					}
				}
			}
		 	
			$File_sql = "";
			if(isset($_FILES['ProTypeFile'])){
				$ImgData1 = getimagesize($_FILES['ProTypeFile']['tmp_name']);
	            $Che1 = new upload('ProTypeFile');
	            $UrlData1 = $Che1->uploadFile();
				$File_sql = " ,图片地址='".$UrlData1."'";
				if(!empty($pic_address[1])){
					if(file_exists($pic_address[1])){
						unlink($pic_address[1]);
					}
				}
			}
			
			//更新数据库信息
			$sql_save = "update 产品类型 set 类型名 = '".$name."',类型介绍 = '".$else."' ".$Logo_sql." ".$File_sql." where id = '".$id."'";
			if($conn->query($sql_save)){
				$data['status'] = 'success';
			}
            
            $json = json_encode($data);
            echo $json;
//          $name = $_POST['name'];
//          $else = $_POST['else'];
//          $id = $_POST['id'];
//          $sql_save = "update 产品类型 set 类型名 = '".$name."',类型介绍 = '".$else."' where id = '".$id."'";
//          $result_save = $conn->query($sql_save);
//          $data['status'] = 'error';
//          if($result_save){
//              $data['status'] = 'success';
//          }
//          $json = json_encode($data);
//          echo $json;
        break;
        /*
         * 增加产品
         */
        case 'addNewPro':
            //图片处理
            require('upload_ProList.php');
            $data['status'] = 'error';
            $ImgData = getimagesize($_FILES['ProListPic']['tmp_name']);
            $Che = new upload('ProListPic');
            $UrlData = $Che->uploadFile();
            
            //存储数据
            $name = $_POST['name'];
            $unit = $_POST['unit'];
            $price = $_POST['price'];
            $score = $_POST['score'];
            $listid = $_POST['listid'];
            
            $sql_check = "select id from `产品信息` where `产品名称` = '".$name."'";
            $result_check = $conn->query($sql_check)->fetch_assoc();
            if(isset($result_check['id'])){
                $data['status'] = 'exist';
            }
            else{
                $sql_save = "insert into `产品信息`(产品名称,单位,价格,积分倍数,产品类型id,展示图) values('".$name."','".$unit."','".$price."','".$score."','".$listid."','".$UrlData."')";
                $result_save = $conn->query($sql_save);
                $sql_check = "select id from `产品信息` where `产品名称` = '".$name."'";
                $result_check = $conn->query($sql_check)->fetch_assoc();
                if(isset($result_check['id'])){
                    $data['status'] = 'success';
                }
            }
            $json = json_encode($data);
            echo $json;
        break;
        default:break;
    }
