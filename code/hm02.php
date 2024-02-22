<?php
//1. Реализовать основные 4 арифметические операции в виде функции с
// тремя параметрами – два параметра это числа, третий – операция. Обязательно использовать оператор return.
function sum(int $a, int $b): int
{
    return $a + $b;
}

function sub(int $a, int $b): int
{
    return $a - $b;
}

function prod(int $a, int $b): int
{
    return $a * $b;
}

function del(int $a, int $b): float|string
{
    if ($b !== 0) {
        return round($a / $b, 2);
    }
    return "На ноль делить нельзя!";
}

//2. Реализовать функцию с тремя параметрами: function mathOperation($arg1, $arg2, $operation)
//, где $arg1, $arg2 – значения аргументов, $operation – строка с названием операции.
// В зависимости от переданного значения операции выполнить одну из арифметических операций
// (использовать функции из пункта 3) и вернуть полученное значение (использовать switch).

function math_operation($a, $b, $operation): float|int|string
{
    return match ($operation) {
        "+" => sum($a, $b),
        "-" => sub($a, $b),
        "*" => prod($a, $b),
        "/" => del($a, $b),
        default => "Вы ввели не корректную операцию",
    };
}

//3. Объявить массив, в котором в качестве ключей будут использоваться названия областей,
// а в качестве значений – массивы с названиями городов из соответствующей области.
// Вывести в цикле значения массива, чтобы результат был таким:
// Московская область: Москва, Зеленоград, Клин
// Ленинградская область: Санкт-Петербург, Всеволожск, Павловск, Кронштадт
// Рязанская область … (названия городов можно найти на maps.yandex.ru)

$regions = [
    "Московская область" => [
        "Москва",
        "Зеленоград",
        "Клин"
    ],
    "Ленинградская область" => [
        "Санкт-Петербург",
        "Всеволожск",
        "Павловск",
        "Кронштадт"
    ],
    "Краснодарский край" => [
        "Краснодар",
        "Сочи",
        "Новороссийск",
        "Армавир"
    ]
];

function print_arr(array $regions): void
{
    $count_r = 1;
    foreach ($regions as $region => $cities) {
        $count_c = 1;
        echo $region . ": ";
        foreach ($cities as $city) {
            if ($count_r === count($regions) & $count_c === count($cities)) {
                echo $city . ".";
            } elseif ($count_c === count($cities)) {
                echo $city . ";";
            } else {
                echo $city . ", ";
            }
            $count_c++;
        }
        echo PHP_EOL;
        $count_r++;
    }
}

//4. Объявить массив, индексами которого являются буквы русского языка,
// а значениями – соответствующие латинские буквосочетания
// (‘а’=> ’a’, ‘б’ => ‘b’, ‘в’ => ‘v’, ‘г’ => ‘g’, …, ‘э’ => ‘e’, ‘ю’ => ‘yu’, ‘я’ => ‘ya’).
// Написать функцию транслитерации строк.

function transliteration(string $str): string
{
    $letters = [
        'а' => 'a', 'б' => 'b', 'в' => 'v',
        'г' => 'g', 'д' => 'd', 'е' => 'e',
        'ё' => 'e', 'ж' => 'zh', 'з' => 'z',
        'и' => 'i', 'й' => 'y', 'к' => 'k',
        'л' => 'l', 'м' => 'm', 'н' => 'n',
        'о' => 'o', 'п' => 'p', 'р' => 'r',
        'с' => 's', 'т' => 't', 'у' => 'u',
        'ф' => 'f', 'х' => 'h', 'ц' => 'ts',
        'ч' => 'ch', 'ш' => 'sh', 'щ' => "shch",
        'ы' => 'y', 'ъ' => '', 'ь' => '',
        'э' => 'e', 'ю' => 'yu', 'я' => 'ya'
    ];
    $ans = '';
    foreach (mb_str_split($str) as $l) {
        foreach ($letters as $key => $letter) {
            if ($l == $key) {
                $ans = $ans . $letter;
            } elseif(mb_strtolower($l) == $key) {
                $ans = $ans. strtoupper($letter);
            }
        }
        if (!key_exists($l, $letters) & !key_exists(mb_strtolower($l), $letters) ) {
            $ans = $ans . $l;
        }
    }
    return $ans;
}
//5. *С помощью рекурсии организовать функцию возведения числа в степень. Формат:
// function power($val, $pow), где $val – заданное число, $pow – степень.
function power($val, $pow): int|float
{
    if ($pow == 0)
        return 1;
    if ($pow < 0 & $val > 1){
        return 1 / $val * power($val, $pow+1);
    }
    if ($pow > 1 & $val > 1 ){
        return $val * power($val,$pow-1);
    }
    return $val;
}

//6. *Написать функцию, которая вычисляет текущее время и возвращает его в формате с правильными склонениями, например:
//22 часа 15 минут
//21 час 43 минуты.
// 10 часов 11 часов 12 часов 13 часов
// 21 час
function time_now(): string
{
    date_default_timezone_set('Europe/Moscow');
    $h = date("H");
    $m = date("i");
    $ans = '';
    $numb = [2,3,4];
    if (in_array($h % 10,$numb) && ($h < 4 || $h > 21)){
        $ans = $ans . $h. "часа";
    } elseif ($h % 10 == 1 && ($h < 4 || $h > 20)){
        $ans = $ans . $h. "час";
    } else {
        $ans = $ans . $h. " часов ";
    }
    if (in_array($m % 10,$numb) && ($m < 4 || $m > 21)){
        $ans = $ans . $m. " минуты";
    } elseif ($m % 10 == 1 && ($m < 4 || $m > 20)){
        $ans = $ans . $m. " минута";
    } else {
        $ans = $ans . $m. " минут";
    }
    return $ans;
}
//echo sum(20, 3) . PHP_EOL;
//echo sub(20, 3) . PHP_EOL;
//echo prod(20, 3) . PHP_EOL;
//echo del(20, 0) . PHP_EOL;
//echo mathOperation(3,30,"-");
//print_arr($regions);
//echo transliteration("Привет !");
//echo power(2,3);
echo time_now();
