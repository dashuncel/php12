<?php
$host='localhost';
$user='byankina';
$password='neto1170';
$database='global';
$dbport=3306;
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false
];

try
{
    $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $user, $password, $opt);
}
catch (PDOException $e)
{
    echo 'Ошибка подключения к БД: '.$e->getMessage().'<br/>';
    exit;
}

// выполняет запрос из параметре и готовит HTML таблицу
function prepareTable($query) {
    global $pdo;
    $statement=$pdo->prepare($query);
    $statement->execute();
    $rows=$statement->fetchAll();
    $str='<table><thead>';
    foreach ($rows[0] as $key=>$row) {
        $str.="<th>$key</th>";
    }
    $str.='</thead>';

    foreach ($rows as $row) {
        $str.="<tr>";
        foreach ($row as $col) {
            $str.="<td>$col</td>";
        }
        $str.="</tr>";
    }
    return $str;
}

