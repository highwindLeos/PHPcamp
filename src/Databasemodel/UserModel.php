<?php
namespace DatabaseModel; #네임스페이스를 정의.

class UserModel
{
    protected $db;
    
    public function __construct($db)
    {
        $this->db = $db;
    }
    
    public function Register($email, $name, $author, $password)
    {
        $insertSql = "INSERT INTO users (email, name, author, password) VALUES (:email, :name, :author, :password)";
        
        $options = [
            'cost' => 11,
            'Salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)
        ]; #Salt (추가문자열 암호화 옵션, 3번째 인자값)
        $hashpass = password_hash(trim($password), PASSWORD_BCRYPT, $options); #암호화 코드
        
        $stmt = $this->db->prepare($insertSql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':password', $hashpass);

        $stmt->execute(); # 쿼리 실행
    }
    
    public function emailOverlapCheck($email) {

        $selectSql = "SELECT email FROM users WHERE email = :email";

        $stmt = $this->db->prepare($selectSql);
        $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
        $stmt->execute();
        
        return !empty($stmt->fetch(\PDO::FETCH_ASSOC)); # return Boolean value
    }
    
    public function authorOverlapCheck($author) {

        $selectSql = "SELECT author FROM users WHERE author = :author";
        
        $stmt = $this->db->prepare($selectSql);
        $stmt->bindParam(':author', $author, \PDO::PARAM_STR);
        $stmt->execute();
        
        return !empty($stmt->fetch(\PDO::FETCH_ASSOC)); # return Boolean value
    }
    
}