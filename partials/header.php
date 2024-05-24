<?php require_once (__DIR__ . '/../user_session/index2.php'); ?>
<?php require_once (__DIR__ . '/doctype.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<?php if (UserLogic::isAuthorized()): ?>
  <form action="logout.php" method="POST">
    <input type="image" src="../img/exit.png" alt="Exit" name="logout-index"
      style="margin-top: 5px; width: 25px; height: 25px;">
  </form>
  <div style="font-weight: normal; margin-left: 5px; font-size: 12px;">Вы вошли по почте
    <?php echo UserLogic::current() ?>
  </div>
<?php else: ?>
  <p style="font-size: 12px; margin: 0">
    Вы не авторизованы. <br />
    <a href="login.php" style="text-decoration: underline">Войти</a>
    или
    <a href="register.php" style="text-decoration: underline">Зарегистрироваться</a>
  </p>
<?php endif ?>

<div class="border flex-wrap border-bottom">
  <div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-md-between py-3 justify-content-center">
      <a href="#" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
        <img src="/img/minjkh.png" alt="" width="190px">
      </a>

      <ul class="nav col-md-8 mb-2 mb-md-0 justify-content-start ">
        <li class="nav-itemi dropdown">
          <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button"
            data-bs-toggle="dropdown">
            Компании
          </a>
          <ul class="dropdown-menu dropdown-menu-lg-end">
            <div class="dropdown-bar"></div>
            <li><a class="dropdown-item" href="#">По регионам</a></li>
            <li><a class="dropdown-item" href="#">По городам</a></li>
            <div class="dropdown-bar"></div>
          </ul>
        </li>

        <li><a href="#" class="nav-link px-2 link-dark">Жилой фонд</a></li>
        <li><a href="#" class="nav-link px-2 link-dark">Новости</a></li>
        <li><a href="#" class="nav-link px-2 link-dark">О проекте</a></li>

        <div class="col-3 d-flex flex-wrap align-items-center">
              <form method="GET" action="text.php">
                <button type="submit" class="internet"  style="width: 100%; padding: 5px; color: black; background-color:#32c8de; border: 1px solid #32c8de; border-radius: 5px; font-size: 14px; font-weight: bold; transition: background-color 0.3s ease-in-out, border-color 0.3s ease-in-out;">Обработка текста</button>
              </form>
            </div>

      </ul>

      <div class="col-md-0 ">
        <a href="#" class="d-inline-block me-2">
          <img src="img/lupa.png" alt="searchButton" width="25px">
        </a>
      </div>

    </header>
  </div>
</div>
<div class="container">
  <div class="d-flex flex-wrap mt-5 mb-2 justify-content-center">
    <button id="servicesButton" type="button" class="btn"
      style="background-color: #32c8de; color: black; font-size: 16px; padding: 5px 10px; font-weight: bold;" data-toggle="modal"
      data-target="#modelId">Заказать услугу</button>
  </div>
</div>

<script>
  document.getElementById('servicesButton').addEventListener('click', function () {
    <?php if (UserLogic::isAuthorized()): ?>
      window.location.href = '/services.php'; // Показать таблицу авторизованному пользователю
    <?php else: ?>
      window.location.href = '/login.php'; // Вывести предупреждение неавторизоавнному пользователю
    <?php endif; ?>
  });
</script>