<?php
   require('conn.php');
   $falg = $_POST['falg'];

   
   switch($falg)
   {
   	/*
   	 * 新建
   	 */
   	case 'addNew':
   	      
   		$name = $_POST['name'];
   		$req = $_POST['req'];
   		$else = $_POST['else'];
   		
   		$sql_check="select id from 积分商品 where 商品名称 ='".$name."'";
   		$result_check = $conn->query($sql_check)->fetch_assoc();
   		
   		$data['status'] = 'error';//important
   		if(isset($result_check['id'])){
   			$data['status'] = 'exist';
   		}
   		else{
                $sql_save = "insert into 积分商品(商品名称,积分要求,商品描述) values('".$name."','".$req."','".$else."')";
                $result_save = $conn->query($sql_save);
                $sql_check = "select id from 积分商品 where 商品名称 = '".$name."' ";
                $result_check = $conn->query($sql_check)->fetch_assoc();
                if(isset($result_check['id'])){
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
            $name = $_POST['name'];
            $req = $_POST['req'];
            $else = $_POST['else'];
            $id = $_POST['id'];
            $sql_save = "update 积分商品  set 商品名称 = '".$name."',积分要求= '".$req."', 商品描述= '".$else."'where id = '".$id."'";
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