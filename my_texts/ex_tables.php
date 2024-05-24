<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Таблицы по автомобилям</title>
  <style>
    /* базовые стили */
    body,
    html {
      overflow-x: hidden;
      position: relative;
    }

    table {
      width: 800px;
      border-collapse: collapse;
      margin: 20px;
    }

    th, td {
      padding: 8px;
      border: 1px solid #ccc;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }

    caption {
      text-align: center;
      font-weight: bold;
      padding: 5px;
      background-color: #f2f2f2;
    }
  </style>
</head>
<body>
  <table>
    <caption>Список марок автомобилей и рекомендуемых интервалов замены масла</caption>
    <thead>
      <tr>
        <th>Марка</th>
        <th>Тип двигателя</th>
        <th>Рекомендуемый интервал (км)</th>
        <th>Объем масла (л)</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Audi</td>
        <td>TFSI</td>
        <td>15000</td>
        <td>5</td>
      </tr>
      <tr>
        <td>BMW</td>
        <td>B58</td>
        <td>8000</td>
        <td>6.5</td>
      </tr>
      <tr>
        <td>Ford</td>
        <td>EcoBoost</td>
        <td>10000</td>
        <td>5.5</td>
      </tr>
      <tr>
        <td>Honda</td>
        <td>B16B</td>
        <td>5000</td>
        <td>4</td>
      </tr>
      <tr>
        <td>Toyota</td>
        <td>4AGE</td>
        <td>10000</td>
        <td>4.2</td>
      </tr>
    </tbody>
  </table>

  <table>
    <caption>Оригинальные номера тормозных колодок для популярных марок автомобилей</caption>
    <thead>
      <tr>
        <th>Марка автомобиля</th>
        <th>Модель</th>
        <th>Передняя ось</th>
        <th>Задняя ось</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Audi</td>
        <td>A4</td>
        <td>100 095 765</td>
        <td>100 095 766</td>
      </tr>
      <tr>
        <td>BMW</td>
        <td>3 серия</td>
        <td>34 21 67 54 20</td>
        <td>34 21 67 54 21</td>
      </tr>
      <tr>
        <td>Ford</td>
        <td>Focus</td>
        <td>1715756</td>
        <td>1715757</td>
      </tr>
      <tr>
        <td>Honda</td>
        <td>Civic</td>
        <td>45011-S0X-003</td>
        <td>45012-S0X-003</td>
      </tr>
      <tr>
        <td>Toyota</td>
        <td>Corolla</td>
        <td>47003-33040</td>
        <td>47003-33041</td>
      </tr>
    </tbody>
  </table>

  <table>
        <caption>Расход топлива популярных автомобилей</caption>
        <thead>
            <tr>
            <th>Марка и модель автомобиля</th>
            <th>Городской цикл (л/100 км)</th>
            <th>Загородный цикл (л/100 км)</th>
            <th>Смешанный цикл (л/100 км)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <td>Toyota Prius</td>
            <td>4.4</td>
            <td>4.2</td>
            <td>4.3</td>
            </tr>
            <tr>
            <td>Volkswagen Golf</td>
            <td>7.2</td>
            <td>5.4</td>
            <td>6.0</td>
            </tr>
            <tr>
            <td>Hyundai Sonata</td>
            <td>8.1</td>
            <td>6.0</td>
            <td>7.0</td>
            </tr>
            <tr>
            <td>Subaru Outback</td>
            <td>9.0</td>
            <td>7.5</td>
            <td>8.0</td>
            </tr>
            <tr>
            <td>Mazda CX-5</td>
            <td>8.7</td>
            <td>6.8</td>
            <td>7.5</td>
            </tr>
        </tbody>
    </table>

    <table>
        <caption>Технические характеристики популярных моделей автомобилей</caption>
        <thead>
            <tr>
            <th>Название автомобиля</th>
            <th>Максимальная скорость (км/ч)</th>
            <th>Время разгона до 100 км/ч (сек)</th>
            <th>Объем багажника (л)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <td>BMW 5 серия</td>
            <td>250</td>
            <td>5.5</td>
            <td>530</td>
            </tr>
            <tr>
            <td>Mercedes-Benz E-Class</td>
            <td>280</td>
            <td>6.0</td>
            <td>540</td>
            </tr>
            <tr>
            <td>Audi A6</td>
            <td>270</td>
            <td>5.8</td>
            <td>520</td>
            </tr>
            <tr>
            <td>Toyota Camry</td>
            <td>220</td>
            <td>7.2</td>
            <td>500</td>
            </tr>
            <tr>
            <td>Ford Mustang</td>
            <td>250</td>
            <td>5.0</td>
            <td>380</td>
            </tr>
        </tbody>
    </table>

</body>
</html>
