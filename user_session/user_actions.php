<?php
require_once('session.php');
    Class UserActions{
        public static function signIn(): string{
            return UserLogic::signIn($_POST['email'], $_POST['password']);
        }

        public static function signUp(): string{
            if ('POST' != $_SERVER['REQUEST_METHOD']){
                return "Метод не post";
            }

            if ('register' != $_POST['action']){
                return "Запущен не signup";
            }

            foreach ($_POST as $str){
                if ($str == ""){
                    return "Необходимо заполнить все поля";
                }
            }
            $errors = UserLogic::signUp(
                $_POST['password'],  
                $_POST['full_name'], 
                $_POST['birth_date'], 
                $_POST['email'], 
                $_POST['gender'],
                $_POST['vk_profile'],
                $_POST['blood_type'],
                $_POST['rh_factor'],
                $_POST['interests'],       
                $_POST['password_confirm']
            );

            if ("" == $errors){
                return "";
            }

            return $errors;
        }
    }
?>