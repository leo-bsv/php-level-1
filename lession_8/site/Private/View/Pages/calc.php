<h3>Калькулятор</h3>
<form action="calc" method="post">
    <div>
        <input name="value1" type="number" value="<?= $value1 ?>">
        <select name="operator1">
            <option value="<?= ModelCalc::OP_PLUS ?>" <?= $selected1[ModelCalc::OP_PLUS] ?>>
                +
            </option>
            <option value="<?= ModelCalc::OP_MINUS ?>" <?= $selected1 [ModelCalc::OP_MINUS] ?>>
                -
            </option>
            <option value="<?= ModelCalc::OP_MULTIPLY ?>" <?= $selected1 [ModelCalc::OP_MULTIPLY] ?>>
                *
            </option>
            <option value="<?= ModelCalc::OP_DIVIDE ?>" <?= $selected1 [ModelCalc::OP_DIVIDE] ?>>
                /
            </option>
        </select>
        <input name="value2" type="number" value="<?= $value2 ?>">
        <input type="submit" value="=">
        <span class="calc-result"><?= $result1 ?></span><br>
    </div>        
    <input name="submit-operation" type="submit" value="Сложение">
    <input name="submit-operation" type="submit" value="Вычитание">
    <input name="submit-operation" type="submit" value="Умножение">
    <input name="submit-operation" type="submit" value="Деление">
</form>