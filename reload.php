<?php
require_once __DIR__.DIRECTORY_SEPARATOR.'lib.php';

if (isset($_POST)) {
    $needAnd=false;
    $needWhere=true;

    $str = " SELECT * FROM BOOKS ";
    IF (isset($_POST['isbn']) and ! empty($_POST['isbn'])) {
        if ($needWhere) { $str.=' WHERE  '; $needWhere = false; };
        if ($needAnd)   { $str.=' AND  ';};
        $needAnd = true;

        $str.=" isbn like '%{$_POST['isbn']}%'";
    }
    IF (isset($_POST['name']) and ! empty($_POST['name'])) {
        if ($needWhere) { $str.=' WHERE  '; $needWhere = false; };
        if ($needAnd)   { $str.=' AND  ';};
        $needAnd = true;

        $str.=" name LIKE '%{$_POST['name']}%'";
    }
    IF (isset($_POST['author']) and ! empty($_POST['author'])) {
        if ($needWhere) { $str.=' WHERE  '; $needWhere = false; };
        if ($needAnd)   { $str.=' AND  ';};
        $needAnd = true;

        $str.=" author LIKE '%{$_POST['author']}%'";
    }
    echo prepareTable($str);
}
?>