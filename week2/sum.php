<!DOCTYPE html>
<html>
    <head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>

<body>

    <?php
    $sum=0;
   for ($num = 1; $num <= 100; $num++) {

    if ($num%2>0) {
        echo "$num<br>";
    }
    else {
        echo "<span class='text-danger'>$num</span><br>";
    }
    $sum +=$num;
  } 
  echo "The sum of the numbers 1 to 100 is $sum"."\n";
    ?>

</body>

</html>