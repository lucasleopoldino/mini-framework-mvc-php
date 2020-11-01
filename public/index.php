<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste</title>
</head>
<body>
    <?php
    // usa o composer pra fazer o autoload
    require_once("../vendor/autoload.php");
    require_once("../app/functions/functions.php");

    use app\controller\TesteController;
    (new \app\core\RouterCore());

    $controler = new TesteController();
    dd($controler->seta());

    ?>
</body>
</html>