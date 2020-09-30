<?php
class User{
    private $_db;
    public function __construct($_db){
        $this->_db=$_db;
    }
    public function show(){
    	
	
	$sql='select id,zhanghao from user_info';
    	
    	$request=$this->_db->prepare($sql);
	$request->execute();
	$result=$request->fetchall(PDO::FETCH_ASSOC);
	echo json_encode($result);
	

    }
    public function login($zhanghao,$password){
        if(empty($zhanghao)){
            echo json_encode('zhanghao not null');
            die();

        }
        if(empty($password)){
            echo json_encode('password not null');
            die();
        }
        $password=md5($password);
        $sql=" select * from user_info where zhanghao=:zhanghao and password = :password";
        $request=$this->_db->prepare($sql);
        $request->bindParam(':zhanghao', $zhanghao);
        $request->bindParam(':password', $password);
        $request->execute();
        
        //$request->execute();
        $res=$request->fetch(PDO::FETCH_ASSOC);
       
       
        if(empty($res)){
            echo json_encode('zhanghao or password is wrong');
        }else{
        	$_SESSION['zhanghao']=$zhanghao;
             
            echo json_encode('success');
        }


    }
    public function adduser($zhanghao,$password){
        if ($this->isuser($zhanghao)){
           
            echo json_encode('login stay');
            
            die();
        }
        if(empty($zhanghao)){
           
           // echo json_encode(['cdoe'=>'403','msg'=>'账号存在']);
            echo json_encode('login stay');
            die();

        }
        if(empty($password)){
           
            echo json_encode('password not null');
        
            die();
        }
        $password=md5($password);
        $sql="insert into user_info (zhanghao,password) values ('$zhanghao','$password')";
      
        $stmt=$this->_db->exec($sql);
        if($stmt>0){
            
	   echo json_encode('adduser success');
        }
       
        return[
            'zhanghao'=>$zhanghao
        ];
    }
    public  function isuser($zhanghao)
    {
       $sql="select * from user_info where zhanghao='$zhanghao'";
       $stmt=$this->_db->prepare($sql);
       $stmt->execute();
       $resut=$stmt->fetch(PDO::FETCH_ASSOC);
       return !empty($resut);
    }
    public function delete($id){
    	
	
	$sql = "delete from user_info where id='$id'";
	
	$stmt = $this->_db->prepare($sql);
	
	
	$stmt->execute();
	
	
	//echo  $stmt->rowCount();
	
	echo json_decode('0');

	
    }
    public function save($id,$zhanghao){
    	
	$sql = "update user_info set zhanghao='$zhanghao' where id='$id'";
	$request=$this->_db->prepare($sql);
	$request->execute();
	
	$affect_row = $request->rowCount();
	echo json_encoe($affect_row);

    
    }
     public function update($id){
    	
	$sql = "select id,zhanghao from user_info where id='$id'";
	$request=$this->_db->prepare($sql);
	$request->execute();
	$a=$request->fetch(PDO::FETCH_ASSOC);
	echo json_encode($a);
	
    }
}
?>
