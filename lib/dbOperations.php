<?php
    require_once('./config/db1.php');

    function fetchRecordAll($entity,$start=0,$end=10){
        // fetch records for entity(category, article, comment) where status is true
        // start and end will control the behaviour for pagination  
        global $con;
        $tableName = mysqli_real_escape_string($con,$entity);
        $sql = "SELECT * FROM $tableName WHERE status = 'A'" ;
        $res = mysqli_query($con,$sql);
        $data = array();
        if(mysqli_num_rows($res)>0){
            while ($row = mysqli_fetch_array($res)) {
                array_push($data,$row);
            }
            return $data; 
        } else {
            return array();
        }
    }

    function fetchRecordSpecific($entity,$primary){
        // fetch single record for entity(category, article, comment)
        global $con;
        $tableName = mysqli_real_escape_string($con,$entity);
        $sql = "SELECT * FROM $tableName WHERE id = $primary" ;
        $res = mysqli_query($con,$sql);
        $data = array();
        if(mysqli_num_rows($res)>0){
            while ($row = mysqli_fetch_array($res)) {
                $data = $row;
            }
            return $data; 
        } else {
            return array();
        }

    }

    function insertRecord($entity,$data){
        // insert single record for entity(category, article, comment) with data passed
        //echo 'Insert Called';
        global $con;
        if ($entity == 'user') {
            $username = mysqli_real_escape_string($con,$data['user']);
            $useremail = mysqli_real_escape_string($con,$data['email']);
            $pwd = mysqli_real_escape_string($con,$data['pwd']);
            $sql = "INSERT INTO `user` (`id`, `name`, `pwd`, `email`,`status`) VALUES (NULL, '$username', '$pwd', '$useremail','A')";
            $res = mysqli_query($con,$sql);
            if($res){
                $selectQuery = "SELECT * FROM user WHERE name = '$username' AND pwd = '$pwd' AND status = 'A'";
                echo $selectQuery;
                $selectResponse = mysqli_query($con,$selectQuery);
                if(mysqli_num_rows($selectResponse)>0){
                    echo "Reponse returned";
                    return $selectResponse; 
                }
                // return $res;
            }
        } else if ($entity == 'category') {
            $name = mysqli_real_escape_string($con,$data['name']);
            $desc = mysqli_real_escape_string($con,$data['desc']);
            $status = mysqli_real_escape_string($con,$data['status']);;
            date_default_timezone_set('Asia/Kolkata');
            $updated = $created = date('Y-m-d H:i:s');
            $sql = "INSERT INTO `category`(`id`, `name`, `desc`, `status`, `created`, `updated`) VALUES (NULL, '$name', '$desc', '$status', '$created', '$updated')";
            $res = mysqli_query($con,$sql);
            if($res){
                return $res;
            }
        }
        
    }

    function updateRecord($entity,$primary,$data){
        // update single record for entity(category, article, comment) using its primary key with data passed
       global $con;
       $tableName = mysqli_real_escape_string($con,$entity);
       $name = mysqli_real_escape_string($con,$data['name']);
       $desc = mysqli_real_escape_string($con,$data['desc']);
       $status = mysqli_real_escape_string($con,$data['status']);
       date_default_timezone_set('Asia/Kolkata');
       $updated = date('Y-m-d H:i:s');
       $sql = "UPDATE `$tableName` SET `name`='$name', `desc`='$desc', `status`='$status', `updated`='$updated' WHERE `id`=$primary";
       $res = mysqli_query($con,$sql);
       if(mysqli_affected_rows($con)>0){
        header('location:categories.php');
       }
    }

    function deleteRecord($entity,$primary){
        // delete single record for entity(category, article, comment) using its primary key
        global $con;
        $tableName = mysqli_real_escape_string($con,$entity);
        $id = (int)$primary;
        $sql = "DELETE FROM `$tableName` WHERE `id`=$id";
        $res = mysqli_query($con,$sql);
        if(mysqli_affected_rows($con)>0){
            header('location:categories.php');
        }
    }

    function authenticate($username, $pwd){
        // if successful, redirect to dashboard
        // else stay on login page


       $sql = "SELECT * FROM user WHERE name = '$username' AND pwd = '$pwd' AND status = 'A'";
       global $con;
        $res = mysqli_query($con,$sql);
        if(mysqli_num_rows($res)>0){
            return $res; 

        }
     }   
?>