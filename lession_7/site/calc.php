<?php  
    require_once 'config.php';
    require_once INCLUDES_DIR . 'session.php';   
    require_once INCLUDES_DIR . 'utils.php';
    require_once INCLUDES_DIR . 'render.php';
    
    $h1 = 'Стальные двери';
    $title = 'Калькулятор';
    $year = date("Y");   
    
    $alert = '';       
      
    $value1 = getReqAsInt('value1');
    $operator1 = getReqAsInt('operator1');
    $value2 = getReqAsInt('value2');   
    
    // если нажата кнопка операции, то выберем соответствующую операцию,
    // игнорируя значение списка операций
    $submitOperation = getReqAsStr('submit-operation');    
    $assocOperations = ['Сложение' => OP_PLUS,
                        'Вычитание' => OP_MINUS,
                        'Умножение' => OP_MULTIPLY,
                        'Деление' => OP_DIVIDE];
    if ($submitOperation) $operator1 = $assocOperations[$submitOperation];
    
    $result1 = '';
    
    // выполним расчёты
    switch ($operator1) {
        case OP_PLUS:
            $result1 = $value1 + $value2;
            break;
        case OP_MINUS:
            $result1 = $value1 - $value2;
            break;
        case OP_MULTIPLY:
            $result1 = $value1 * $value2;
            break;
        case OP_DIVIDE:
            if (!empty($value2))
                $result1 = $value1 / $value2;
            else 
                $alert = "Деление на ноль невозможно.";
            break;
    }
    
    // отметим в списке операций текущую операцию
    $selected1 = ['','','',''];
    $selected1[$operator1] = 'selected';
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="css/style.css">
        
</head>

<body>
    <div class="container">

            <div class="header">
                    <div class="topik">
                            <div class="topikCrumbs"></div>
                            <div class="topikCrumbs"></div>
                            <div class="topikCrumbs"></div>
                            <div class="topikCrumbs"></div>
                            <div class="topikCrumbs"></div>
                    </div>
                    <div class="logo">BURKOV&reg;</div>
                    <h1><?= $h1 ?></h1>
                    <?= render('menu') ?>
            </div>				

            <div class="content">
                <h3>Калькулятор</h3>
                <form action="calc.php" method="post">
                    <input name="value1" type="number" value="<?= $value1 ?>">
                    <select name="operator1">
                        <option value="<?= OP_PLUS ?>" <?= $selected1[OP_PLUS] ?>>
                            +
                        </option>
                        <option value="<?= OP_MINUS ?>" <?= $selected1[OP_MINUS] ?>>
                            -
                        </option>
                        <option value="<?= OP_MULTIPLY ?>" <?= $selected1[OP_MULTIPLY] ?>>
                            *
                        </option>
                        <option value="<?= OP_DIVIDE ?>" <?= $selected1[OP_DIVIDE] ?>>
                            /
                        </option>
                    </select>
                    <input name="value2" type="number" value="<?= $value2 ?>">
                    <input type="submit" value="=">
                    <span class="calc-result"><?= $result1 ?></span><br>
                    <input name="submit-operation" type="submit" value="Сложение">
                    <input name="submit-operation" type="submit" value="Вычитание">
                    <input name="submit-operation" type="submit" value="Умножение">
                    <input name="submit-operation" type="submit" value="Деление">
                </form>
            </div>

            <div class="footer">
                    <p class="center">Burkov&reg; Все права защищены <?= $year ?><p>
                    <p class="center">
                            <a href="http://jigsaw.w3.org/css-validator/check/referer">
                                <img style="border:0;width:88px;height:31px"
                                    src="http://jigsaw.w3.org/css-validator/images/vcss-blue"
                                    alt="Valid CSS!" />
                            </a>
                </p>		
            </div>

    </div>
    <script>
        var msg = '<?= $alert ?>';
        if (msg != '') alert(msg);
    </script>               
</body>

</html>

