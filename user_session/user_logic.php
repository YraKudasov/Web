<?php
require_once('session.php');

function check_password($password){
    $password = mb_str_split($_POST["password"]);
    $small = 0;
    $big = 0;
    $spec = 0;
    $space = 0;
    $defis = 0;
    $_ = 0;
    $numb = 0;

    $ru = "А-Яа-яЁё";
    $ens = "a-z";
    $enb = "A-Z";
    $number = "0-9";

    foreach ($password as $sym) {
        if ($sym == " "){
            $space = $space + 1;
            continue;
        }

        if (preg_match("/^[$ru]+$/u", $sym)){
            return "В пароле не должно быть кириллицы";
        }

        if (preg_match("/^[$ens]+$/u", $sym)){
            $small = $small + 1;
        }

        if (preg_match("/^[$enb]+$/u", $sym)){
            $big = $big + 1;
        }

        if (preg_match("/^[$number]+$/u", $sym)){
            $numb = $numb + 1;
        }

        if ($sym == '.' || $sym == ',' || $sym == ":" || $sym == '?' || $sym == "!" || $sym == '+' || $sym == "-" || $sym == ":" || $sym == "/"){
            $spec = $spec + 1;
        }

        if ($sym == "-"){
            $defis = $defis + 1;
        }

        if ($sym == "_"){
            $_ = $_ + 1;
        }
    }
    if ($space == 0){
        return "Пароль должен соддержать минимум один пробел";
    }
    if ($small == 0){
        return "Пароль должен содержать минимум одну латинскую маленькую букву";
    }
    if ($big == 0){
        return "Пароль должен содержать минимум одну латинскую большую букву";
    }
    if ($numb == 0){
        return "Пароль должен содержать минимум одну цифру";
    }
    if ($spec == 0){
        return "Пароль должен содержать минимум один из символов ?!:/+-,.";
    }
    if ($defis == 0){
        return "Пароль должен содержать минимум один дефис";
    }
    if ($_ == 0){
        return "Пароль должен содержать минимум одно нижнее подчёркивание";
    }
    return "";
}

Class UserLogic{
    
    public static function signUp(
        string $password,
        string $full_name, 
        string $birth_date, 
        string $email, 
        string $gender,
        string $vk_profile,
        string $blood_type, 
        string $rh_factor, 
        string $interests,
        $password_confirm
    ): string
    {
        if(!filter_var( $email ,FILTER_VALIDATE_EMAIL ) )
        {
            return "Вы ввели не email";
        }
        $userWithThisEmail = UserTable::get_by_email($email);
    
        if (!empty($userWithThisEmail)){
            return "Пользователь с таким email уже существует";
        }
        if ($password != $password_confirm){
            
            return "Пароли не совпадают";
            
        }
        $message = check_password($_POST["password"]);
        if ($message != ""){
            return $message;
        } 
        // Генерация случайной соли и создание хеша пароля
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        UserTable::create($hashed_password, $full_name, $birth_date, $email, $gender, $vk_profile, $blood_type, $rh_factor, $interests);
        $_SESSION['USER_ID'] = Database::lastInsertId();
        
        return "";
    }

    public static function signIn(string $email, string $password): string
    {
        if (static::isAuthorized()){
            return ' ';
        }

        if(!filter_var( $email ,FILTER_VALIDATE_EMAIL ) )
        {
            return "Вы ввели не email";
        }

        $user = UserTable::get_by_email($email);
        //var_dump($user);
        if (empty($user)){
            return 'Пользователь с таким email не найден';
        }
        // Извлечение соли из базы данных
        $hashed_password = $user['hashed_password'];

        if (!password_verify($password, $hashed_password)) {
            return 'Неверно указан пароль';
        }
        
        $_SESSION['USER_ID'] = $user['id'];

        return '';
    }

    public static function signOut()
    {
        unset($_SESSION['USER_ID']);
    }

    public static function isAuthorized(): bool
    {
        return array_key_exists('USER_ID', $_SESSION) && intval($_SESSION['USER_ID']) > 0;
    }

    public static function current(): string
    {
        if (!static::isAuthorized()){
            return "";
        }
       
        $field = UserTable::get_by_id($_SESSION['USER_ID']);
        return $field['email'];
    }
}
?>