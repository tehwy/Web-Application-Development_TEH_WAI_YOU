<!DOCTYPE html>
<html>
    <head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    </head>
<body>

    <?php
    $number1 = rand(100, 200);
    $number2 = rand(100, 200);

    if($number1>$number2) {
        echo "<span class='text-primary fw-bold'>".$number1."</span>";
        echo $number2;
       
    }
    else if($number2>$number1){
        echo $number1;
        echo "<span class='text-primary fw-bold'>".$number2."</span>";
    
    }else{
        echo "The number is same.";
    }

    ?>


</body>

</html>