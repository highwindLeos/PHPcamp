<?php
session_start();
require 'model/loginModel.php';
require 'config/config.php';

    try {
            $db = new PDO($dsn, $dId, $dPass);
        }
        catch(PDOException $e) 
        {
            die($e->getMessage());
        }

    #필터링
    $email = filter_input(INPUT_POST, 'email', FILTER_DEFAULT); 
    $hashpass = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);

    $loginmodel = new loginModel($db);
    $users = $loginmodel->getUsersByEmail($email);

    if($_POST){ #POST에 값이 있다면 검증을 실행.
        # 변수설정
        $errors = array(); #에러 메세지를 담을 배열을 생성

        # 검증 코드
        # 이메일
        if(empty($email))
        {
            $_SESSION['login1'] = $errors['login1'] = "* 이메일은 빈칸일 수 없습니다.";
        }
        if($email != $users['email']){ #이메일 입력값의 값이 데이터베이스의 이메일과 같지 않다면
            $_SESSION['login2'] = $errors['login2'] = "* 존재하지 않는 이메일입니다.";
        }
       
        # 암호
        if(empty($hashpass))
        {
            $_SESSION['login3'] = $errors['login3'] = "* 암호는 빈칸일 수 없습니다.";
        }
        if($hashpass != $users['password']){ #패스워드 입력값의 값이 데이터베이스의 패스워드와 같지 않다면
            $_SESSION['login4'] = $errors['login4'] = "* 암호를 확인해주세요.";
        }
        
    }  

    if(count($errors) == 0){ #에러값이 없다면 true
        $_SESSION = array(); #세션 데이터 초기화.
        header("Location: main.php"); #리다이렉션 페이지 이동
    } else { 
        header("Location: login.php"); #false 리다이렉션 페이지 이동
    }

?>