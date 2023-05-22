<!DOCTYPE html>
<html>

<body>

    <?php
    $number1 = rand(100, 200);
    $number2 = rand(100, 200);

    echo "<i><font color='green'>$number1</font></i> <br>";
    echo "<i><font color='blue'>$number2</font></i> <br>";

    $sum = $number1 + $number2;
    echo "<b><font color='red'>$sum</font><br><b>";

    $multiple = $number1 * $number2;
    echo "<b><i>$multiple</i><b><br>";
    ?>

</body>

</html>