<?php
    $falg = $_POST['falg'];
    require('conn.php');
    
    switch ($falg){
        /*
         * 新增商品
         */
        case 'addNew':
            $name = $_POST['name'];
            $reqc = $_POST['reqc'];
            $else = $_POST['else'];
            
            $sql_save = "insert into 积分商品(商品名称,积分要求,商品描述) values('".$name."','".$reqc."','".$else."')";
            $result = $conn->query($sql_save);
            $data['status'] = 'error';
            if($result)
            {
                $data['status'] = 'success';
            }
            $json = json_encode($data);
            echo $json;
        break;
        default:break;
    }
