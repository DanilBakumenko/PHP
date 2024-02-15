<?php
$a = 5;
$b = '05';
/*
 * комманда var_dump выводит тип значения и результат выражения
 */
var_dump($a == $b);
//выводится тип значения bool с результатом true, т.к. при == php пытается привести все к одному типу,
// преемущественно к типу первой переменной и сравнить значения.
var_dump((int)'012345');
//выводится тип значения int результат 12345, конструкция (int)перед выражением приводит, его к типу int
var_dump((float)123.0 === (int)123.0);
//выводится bool результат false, === в php сравнивает как тип так и значение, у первого значения float у второго int
//типы значений не равны, соответсвенно результат false
var_dump(0 == 'hello, world');
// выводится bool(false) т.к. в правом значении содержатся символы отличные от цифр,
// php не может привести их к типу int

//Запускал с помощью команды
//docker run --rm -v ${pwd}/code/:/cli php:8.2-cli php /cli/index.php
/* Вывод:
bool(true)
int(12345)
bool(false)
bool(false)

 *
 * при изменении версии php на 7.4, изменится вывод только последней строчки на bool(true),
 * в этой версии == посимвольно приводит к типу первого значнения и сравнивает, соответсвенно если цифр нет, то
 * значение приравнивается к 0
 */

$a = 1;
$b = 2;
//$a = $a - $b;
//$b = $a - $b;
//$a = $a - $b;
$a = $a ^ $b;
$b = $a ^ $b;
$a = $a ^ $b;
//[$a,$b]=[$b,$a];
var_dump("a = {$a}");
var_dump("b = {$b}");