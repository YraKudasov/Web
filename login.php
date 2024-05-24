<?php require_once (__DIR__ . '/partials/doctype.php'); ?>
<?php require_once (__DIR__ . '/user_session/index2.php'); ?>
<?php $errors = "" ?>
<?php if (array_key_exists('email', $_POST)): ?>
    <?php $errors = UserActions::signIn(); ?>
<?php endif ?>
<?php require_once (__DIR__ . '/partials/header.php'); ?>

<main>
    <?php if (strlen($errors) > 2): ?>
        <div class="alert alert-danger" role="alert"><?php echo $errors ?></div><br>
    <?php endif ?>
    <?php if (UserLogic::isAuthorized()): ?>
        <div class="alert alert-warning" role="alert"
            style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
            <span>Вы вошли по почте <?php echo UserLogic::current() ?></span>
            <form action="logout.php" method="POST">
                <input type="submit" name="logout-index" value="Выйти"
                    style="color: rgb(133,100,4); font-weight: 500;  background-color: rgb(255, 243, 205); border-radius: 10px; padding: 3px 6px;">
            </form>
        </div>
    <?php else: ?>
        <form action="login.php" method="POST" style="max-width: 400px; margin: 0 auto; margin-top: 40px;">
            <input type="hidden" name="action" value="login">
            <input type="text" name="email" placeholder="Email"
                style="width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ced4da; border-radius: 5px; background-color: #fff; box-shadow: none; transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;"><br>
            <input type="password" name="password" placeholder="Пароль"
                style="width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ced4da; border-radius: 5px; background-color: #fff; box-shadow: none; transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;"><br>
            <button type="submit" class="btn btn-block mybtn btn-primary tx-tfm login-btn"
                style="width: 100%; padding: 10px; color: black; background-color:#32c8de; border: 1px solid #32c8de; border-radius: 5px; font-size: 16px; font-weight: bold; transition: background-color 0.3s ease-in-out, border-color 0.3s ease-in-out;">Войти</button>
            <p style="text-align: center;">У вас ещё нет аккаунта? <a href="register.php"
                    style="text-decoration: underline; color: black;">Зарегистрируйтесь</a></p>
        </form>
    <?php endif ?>
</main>
<?php require_once (__DIR__ . '/partials/first_page.php'); ?>
<?php require_once (__DIR__ . '/partials/footer.php'); ?>