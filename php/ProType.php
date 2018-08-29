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
            $else = $_POST['else'];
            $sql_check = "select id from 产品类型 where 类型名 = '".$name."' ";
            $result_check = $conn->query($sql_check)->fetch_assoc();
            if(isset($result_check['id'])){
                $data['status'] = 'exist';
            }
            else{
                $sql_save = "insert into 产品类型(类型名,类型介绍) values('".$name."','".$else."')";
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
         * 删除
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
         * 修改
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
        default:break;
    }
