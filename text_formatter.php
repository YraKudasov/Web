<?php

$lastText = retrieveLastPostValue('textForFormatting');

if (isset($_GET['preset'])) {
    $preset = $_GET['preset'];
    if ($preset == 1) {
        $lastText = file_get_contents(__DIR__ . '/my_texts/wiki.php');
    } elseif ($preset == 2) {
        $lastText = file_get_contents(__DIR__ . '/my_texts/gazeta.php');
    } elseif ($preset == 3) {
        $lastText = file_get_contents(__DIR__ . '/my_texts/winny.php');
    } else {
        $lastText = file_get_contents(__DIR__ . '/my_texts/ex_tables.php');
    }
}

function retrieveLastPostValue($valueName): string
{
    return isset($_POST[$valueName]) ? $_POST[$valueName] : '';
}

function customFormat1($str): string
{
    $replacement = '$1-$2';
    $patterns = [
        '/\b(кто|кого|чего|кому|чему|кем|чем|ком|чем|чём|что|где|как|то)\s+(то)\b/ui',
        '/\b(вот)\s+(вот)\b/ui',
        '/\b(так)\s+(так)\b/ui',
        '/\b(из)\s+(за|под)\b/ui',
        '/\b(\w+)\s+(ка|де|кась)\b/ui'
    ];

    foreach ($patterns as $pattern) {
        $str = preg_replace($pattern, $replacement, $str);
    }

    return $str;
}



function customFormat2($str): string
{


    $doc = new DOMDocument(); // создание объекта DOMDocument
    $doc->loadHTML($str); // загрузка HTML-кода в объект
    $paragraphs = $doc->getElementsByTagName('p');


    $longest_sentence = '';
    $longest_length = 0;
    $max_length_index = 1; // Индекс самого длинного предложения
    $paragraph_index = 1; // Индекс предложения
    $longest_paragraph = null;

    foreach ($paragraphs as $paragraph) {
        foreach ($paragraph->childNodes as $child) {
            var_dump($child->nodeValue);
        }

        $paragraph_text = $paragraph->nodeValue;
        $trimmed_text = preg_replace("/\s+/", ' ', $paragraph_text);
        $paragraph_length = mb_strlen($trimmed_text);
        if ($paragraph_length > $longest_length) {
            $longest_sentence = $trimmed_text;
            $longest_length = $paragraph_length;
            $max_length_index = $paragraph_index; // Обновляем индекс самого длинного предложения
            $longest_paragraph = $paragraph;
        }
        $paragraph_index++;
    }

    if ($longest_sentence !== '') {
        $sentence = '';
        foreach ($paragraph->childNodes as $child) {
            $sentence_without_tags = preg_replace('/<\/?\w+>/', '', $sentence);
            if (mb_strlen($sentence_without_tags) + mb_strlen($child->nodeValue) <= 80) {
                $sentence .= $child->nodeValue;
            }
        }

        $trimmed_sentence = substr($longest_sentence, 0, 80);
        // Возвращаем обрезанное предложение
        return $trimmed_sentence;
    } else {
        return "Нет текста внутри тегов p";
    }
}




function customFormat3($str): string
{
    $tableRegex = '/<(table\b[^>]*)>.*?<t[dh][^>]*>(.*?)<(\/(th|td))>/sui';

    preg_match_all($tableRegex, $str, $suitables);

    $tableIndex = '<h2>Указатель таблиц:</h2><br><ul>';

    foreach ($suitables[1] as $index => $tableStart) {

        $tableId = 'table_' . ($index + 1);
        $tableIndex .= '<li><a href="#' . $tableId . '">Таблица ' . ($index + 1) . ' "' . $suitables[2][$index] . '"</a></li>';

        $new_content = str_replace($tableStart, $tableStart . ' id="' . $tableId . '"', $suitables[0][$index]);
        $str = str_replace($suitables[0][$index], $new_content, $str);

    }
    $tableIndex .= '</ul>';

    return $tableIndex . $str;
}


function customFormat4($str): string
{
    $unacceptableWords = array("пух", "рот", "делать", "ехать", "около", "для");

    // Экранируем запретные слова для использования в регулярном выражении
    $quotedWords = array_map('preg_quote', $unacceptableWords);

    // Собираем регулярное выражение для поиска запретных слов
    $forbiddenPattern = implode('|', $quotedWords);
    $pattern = '/(?|(?:\b(?:' . $forbiddenPattern . '))|(?:(?:' . $forbiddenPattern . ')\b)' . ')/ui';

    // Заменяем найденные запретные слова на ###
    $result = preg_replace_callback($pattern, function ($match) {
        return str_repeat('#', mb_strlen($match[0]));
    }, $str);

    return $result;
}

?>

<div class="col-4 content">
    <h1 style="font-size: 30px; font-weight: bold; margin-top: 20px;">ОБРАБОТКА ТЕКСТА</h1>
    <hr class="title-line" />
</div>

<form action="text.php" method="POST">
    <div class="row mt-3">
        <div class="col-md-6 offset-md-3">
            <label for="textForFormatting">Текст</label>
            <textarea class="form-control" id="textForFormatting" name="textForFormatting"
                rows="8"><?= htmlspecialchars($lastText); ?></textarea>
        </div>
    </div>

    <div class="row mt-3 text-center">
        <div class="col-md-12">
            <button type="submit" name="submit" class="btn mybtn btn-primary tx-tfm login-btn"
                style="width: auto; padding: 10px; color: black; background-color: #32c8de; border: 1px solid #32c8de; border-radius: 5px; font-size: 16px; font-weight: bold; transition: background-color 0.3s ease-in-out, border-color 0.3s ease-in-out;">Отправить</button>
        </div>
    </div>
</form>

<div>
    <?php if (isset($_POST['textForFormatting']) && isset($_POST['submit'])):
        $text = $_POST['textForFormatting']; ?>

        <div class="col-4 content">
            <h1 style="font-size: 30px; font-weight: bold; margin-top: 20px;">Задание 4</h1>
            <hr class="title-line" />
        </div>
        <div>
            <p class="res"><?= customFormat1($text); ?> </p>
        </div>

        <div class="col-4 content">
            <h1 style="font-size: 30px; font-weight: bold; margin-top: 20px;">Задание 10</h1>
            <hr class="title-line" />
        </div>
        <div>
            <p class="res"><?= customFormat2($text); ?> </p>
        </div>

        <div class="col-4 content">
            <h1 style="font-size: 30px; font-weight: bold; margin-top: 20px;">Задание №12</h1>
            <hr class="title-line" />
        </div>
        <div>
            <p class="res"><?= customFormat3($text); ?> </p>
        </div>

        <div class="col-4 content">
            <h1 style="font-size: 30px; font-weight: bold; margin-top: 20px;">Задание №16</h1>
            <hr class="title-line" />
        </div>
        <div>
            <p class="res"><?= customFormat4($text); ?> </p>
        </div>
    <?php endif; ?>
</div>