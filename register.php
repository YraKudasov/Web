<?php require_once(__DIR__ .'/partials/doctype.php');?>
<?php require_once(__DIR__ . '/user_session/index2.php');?>
<?php $errors=""?>
<?php if (array_key_exists('email', $_POST)): ?> 
    <?php $errors = UserActions::signUp();?>
<?php endif?>
<?php require_once(__DIR__ . '/partials/header.php');?>

    <main>
        <?php if (strlen($errors) > 2): ?> 
			<div class="alert alert-danger" role="alert"><?php echo $errors?></div><br>
        <?php endif?>
        <?php if (UserLogic::isAuthorized()): ?> 
            <div class="alert alert-warning" role="alert" style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                <span>Вы успешно зарегистрировались и вошли по почте <?php echo UserLogic::current()?></span>
                <form action="logout.php" method="POST">
                <input type="submit" name="logout-index" value="Выйти" style="color: rgb(133,100,4); font-weight: 500; text-decoration: none;  background-color: rgb(255, 243, 205); border: 1.9px solid rgb(133,100,4); border-radius: 10px; padding: 3px 6px;">
                </form>
            </div>
        <?php else: ?>
            <form action="register.php" method="POST" style="max-width: 400px; margin: 0 auto; margin-top: 40px;">
                <input type="hidden" name="action" value="register">
                <input type="text" name="full_name" placeholder="ФИО" style="width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ced4da; border-radius: 5px; background-color: #fff; box-shadow: none; transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;" value="<?php echo array_key_exists('full_name', $_POST) ? htmlspecialchars($_POST['full_name']) : ""; ?>"><br>
                <input type="date" name="birth_date" placeholder="Дата рождения" style="width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ced4da; border-radius: 5px; background-color: #fff; box-shadow: none; transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;" value=<?php echo array_key_exists('birth_date', $_POST) ? htmlspecialchars($_POST['birth_date']) : "" ?>><br>
                <input type="email" name="email" placeholder="example@example.com" style="width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ced4da; border-radius: 5px; background-color: #fff; box-shadow: none; transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;" value=<?php echo array_key_exists('email', $_POST) ? htmlspecialchars($_POST['email']) : "" ?>><br>
                <select name="gender" style="width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ced4da; border-radius: 5px; background-color: #fff; box-shadow: none; transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;">
                    <option value="" <?php echo (isset($_POST['gender']) && $_POST['gender'] == "") ? 'selected' : ''; ?> disabled>Пол</option>
                    <option value="М" <?php echo (isset($_POST['gender']) && $_POST['gender'] == "М") ? 'selected' : ''; ?>>М</option>
                    <option value="Ж" <?php echo (isset($_POST['gender']) && $_POST['gender'] == "Ж") ? 'selected' : ''; ?>>Ж</option>
                </select><br>
                <input type="text" name="vk_profile" placeholder="https://vk.com/id" style="width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ced4da; border-radius: 5px; background-color: #fff; box-shadow: none; transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;" value=<?php echo array_key_exists('vk_profile', $_POST) ? htmlspecialchars($_POST['vk_profile']) : "" ?>><br>
                <select name="blood_type" style="width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ced4da; border-radius: 5px; background-color: #fff; box-shadow: none; transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;">
                    <option value="" <?php echo (isset($_POST['blood_type']) && $_POST['blood_type'] == "") ? 'selected' : ''; ?> disabled>Группа крови</option>
                    <option value="O" <?php echo (isset($_POST['blood_type']) && $_POST['blood_type'] == "O") ? 'selected' : ''; ?>>O</option>
                    <option value="A" <?php echo (isset($_POST['blood_type']) && $_POST['blood_type'] == "A") ? 'selected' : ''; ?>>A</option>
                    <option value="B" <?php echo (isset($_POST['blood_type']) && $_POST['blood_type'] == "B") ? 'selected' : ''; ?>>B</option>
                    <option value="AB" <?php echo (isset($_POST['blood_type']) && $_POST['blood_type'] == "AB") ? 'selected' : ''; ?>>AB</option>
                </select><br>
                <select name="rh_factor" style="width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ced4da; border-radius: 5px; background-color: #fff; box-shadow: none; transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;">
                    <option value="" <?php echo (isset($_POST['rh_factor']) && $_POST['rh_factor'] == "") ? 'selected' : ''; ?> disabled>Резус фактор</option>
                    <option value="+" <?php echo (isset($_POST['rh_factor']) && $_POST['rh_factor'] == "+") ? 'selected' : ''; ?>>+</option>
                    <option value="-" <?php echo (isset($_POST['rh_factor']) && $_POST['rh_factor'] == "-") ? 'selected' : ''; ?>>-</option>
                </select><br>
                <textarea name="interests" placeholder="Интересы" style="width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ced4da; border-radius: 5px; background-color: #fff; box-shadow: none; transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;"><?php echo array_key_exists('interests', $_POST) ? htmlspecialchars($_POST['interests']) : "" ?></textarea><br>
                <input type="password" name="password" placeholder="Пароль" style="width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ced4da; border-radius: 5px; background-color: #fff; box-shadow: none; transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;"><br>
                <input type="password" name="password_confirm" placeholder="Подтвердите пароль" style="width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ced4da; border-radius: 5px; background-color: #fff; box-shadow: none; transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;"><br>
                <input type="submit" name="submit" value="Зарегистрироваться" style="width: 100%; padding: 10px; background-color: #32c8de; border: 1px solid #32c8de; border-radius: 5px; font-size: 16px; font-weight: bold; transition: background-color 0.3s ease-in-out, border-color 0.3s ease-in-out;">
                <p style="text-align: center;">Уже есть аккаунт? <a href="login.php" style="text-decoration: underline; color: black;">Войти</a></p>
            </form>
        <?php endif?>
    </main>
<?php require_once(__DIR__ .'/partials/first_page.php');?>
<?php require_once(__DIR__ .'/partials/footer.php'); ?>