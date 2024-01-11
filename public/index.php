<?php

require(__DIR__ . '/../vendor/autoload.php');

use App\Controllers\DealsController;

$controller = new DealsController();

$deals = $controller->getDealsList();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Сделки</title>
</head>
<body>
    <div class="content" style="margin-top: 50px">
        <h3 style="text-align: center">Список сделок</h3>
        <div class="table" style="display: flex; justify-content: center">
            <table class="table" style="width: 80%">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Название</th>
                    <th scope="col">Тип</th>
                    <th scope="col">Дата закрытия</th>
                    <th scope="col">Имя контакта</th>
                    <th scope="col">Телефон</th>
                    <th scope="col">Email</th>
                </tr>
                </thead>
                <tbody>
                <?
                    $i=1;
                    foreach ($deals as $deal) {
                ?>
                <tr>
                    <th scope="row"><?= $i?></th>
                    <td><?= $deal['title'] ?></td>
                    <td><?= $deal['type'] ?></td>
                    <td><?= $deal['close_date'] ?></td>
                    <td><?= $deal['last_name'] . ' ' . $deal['name'] ?></td>
                    <td><?= $deal['phone'] ?></td>
                    <td><?= $deal['email'] ?></td>
                </tr>
                <? $i++; } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
