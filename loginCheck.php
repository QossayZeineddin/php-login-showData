<?php 
 session_start();
include('databaseConnection.php');

if(isset($_POST['username']) && isset($_POST['password'])){
    function vaild($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $username = vaild($_POST['username']);
    $password = vaild($_POST['password']);

    if(empty($username)){
        header("Location: login.php?error=User name is required !!");
        exit();
    }else if(empty($password)){

        header("Location: login.php?error=password is required !!");
        exit();
    }else{

        $query = "SELECT * FROM users WHERE username =:username AND password=:password ";
        if($statement = $connection->prepare($query)){
            $statement->bindValue(':username', $username , PDO::PARAM_STR);
            $statement->bindValue(':password', $password , PDO::PARAM_STR);

            if( $statement->execute() && ($result = $statement->fetchAll()) && count($result) > 0){
                foreach($result as $row){
                    $getName = $row["username"];
                    $getPass = $row["password"];
                    
                    if ($getName === $username && $getPass === $password) { 
                        $_SESSION['UserName'] = $getName;
                        $_SESSION['Password'] = $getPass;
                        header("Location: index.php");

                    }else{
                        header("Location: login.php?error=Incorect User name or password !!");
                        exit();
                    }
                }
            }else{
                header("Location: login.php?error=Incorect Data !!");
                exit();
            }  
        }
    }
}else{

    header("Location: login.php? here");
    exit();
}


?>
