<?php 
require_once('session.php');

class UserTable {
    public static function create(
        string $hashed_password,
        string $full_name, 
        string $birth_date, 
        string $email, 
        string $gender,
        string $vk_profile,
        string $blood_type, 
        string $rh_factor, 
        string $interests,
    ) {
        
        // Вставка данных пользователя в базу данных
        $query = "INSERT INTO `users` (`hashed_password`, `full_name`, `birth_date`, `email`, `gender`, `vk_profile`, `blood_type`, `rh_factor`, `interests`)" .
                 " VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $conn = Database::connection();

        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssssssss", $hashed_password, $full_name, $birth_date, $email, $gender, $vk_profile, $blood_type, $rh_factor, $interests);

        if (!$stmt->execute()) {
            throw new Exception('При добавлении пользователя возникла ошибка');
        }
    }

    public static function get_by_email(string $email): array {
        $query = "SELECT * FROM `users` WHERE `email` = ?";
        
        $conn = Database::connection();

        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        return $user ? $user : [];
    }

    public static function get_by_id(string $ID): array {
        $query = "SELECT * FROM `users` WHERE `id` = ?";

        $conn = Database::connection();

        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $ID);
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        return $user ? $user : [];
    }
}
?>
