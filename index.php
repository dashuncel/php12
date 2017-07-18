<?php
require_once __DIR__.DIRECTORY_SEPARATOR.'lib.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Список лучших книг</title>
    <link rel="stylesheet" href="index.css">
    <meta charset="utf-8">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
</head>
<body>
<form class='mainform' action='' method="POST" enctype="application/json">
    <fieldset>
        <legend>Фильтр</legend>
        <input type="text" name="isbn"  placeholder="ISBN">
        <input type="text" name="name"  placeholder="Назвавние">
        <input type="text" name="author" placeholder="Автор">
    </fieldset>
</form>
<div class="table">
<?php echo prepareTable("SELECT * FROM BOOKS") ?>
</div>
<script type="text/javascript">
    'use script';
    $('input').change(function(event){
        event.preventDefault();
        $.ajax({
            url: 'reload.php',
            type: 'POST',
            data: $('.mainform').serialize(),
            success: function(result){
                $('.table').html(result);
            }
        });
    });
</script>
</body>
</html>

