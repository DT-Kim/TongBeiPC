<?php
    header("Access-Control-Allow-Origin: *");
    require('conn.php');
//  $falg = $_POST['falg'];
    $falg = "addNewPro";
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
            $name = $_POST['name'];
            $else = $_POST['else'];
            $id = $_POST['id'];
            $sql_save = "update 产品类型 set 类型名 = '".$name."',类型介绍 = '".$else."' where id = '".$id."'";
            $result_save = $conn->query($sql_save);
            $data['status'] = 'error';
            if($result_save){
                $data['status'] = 'success';
            }
            $json = json_encode($data);
            echo $json;
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
