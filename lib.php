<?php

require_once 'mydata.php';

$host='localhost';
/*
$user=LOGIN;
$password=PASSWD;
*/
$user='root';
$password='';
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

    try {
        $statement = $pdo->prepare($query);
        $statement->execute();
    }
    catch(PDOException $e) {
        echo "Ошибка выполнения запроса $query к БД: ".$e->getMessage().'<br/>';
        exit;
    }

    $rows = $statement->fetchAll();
    $str = '<table><thead>';

    if (! empty($rows[0]) && is_array($rows[0])) {
        foreach ($rows[0] as $key => $row) {
            $str .= "<th>$key</th>";
        }
        $str .= '</thead>';
    }
    else exit;

    foreach ($rows as $row) {
        $str.="<tr>";
        foreach ($row as $col) {
            $str.="<td>$col</td>";
        }
        $str.="</tr>";
    }
    return $str;
}

