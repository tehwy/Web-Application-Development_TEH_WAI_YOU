<!DOCTYPE html>
<html>
<head>
  <title>Date Validation and Zodiac Finder</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h1>Date Validation and Zodiac Finder</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <div class="form-row">
        <div class="col">
          <label for="day">Day:</label>
          <select class="form-control" name="day" id="day">
            <?php
              $currentDay = date('j');
              for ($day = 1; $day <= 31; $day++) {
                $selected = ($day == $currentDay) ? 'selected' : '';
                echo "<option value='$day' $selected>$day</option>";
              }
            ?>
          </select>
        </div>
        <div class="col">
          <label for="month">Month:</label>
          <select class="form-control" name="month" id="month">
            <?php
              $currentMonth = date('n');
              $months = [
                'January', 'February', 'March', 'April', 'May', 'June', 'July',
                'August', 'September', 'October', 'November', 'December'
              ];
              foreach ($months as $index => $month) {
                $monthNum = $index + 1;
                $selected = ($monthNum == $currentMonth) ? 'selected' : '';
                echo "<option value='$monthNum' $selected>$month</option>";
              }
            ?>
          </select>
        </div>
        <div class="col">
          <label for="year">Year:</label>
          <select class="form-control" name="year" id="year">
            <?php
              $currentYear = date('Y');
              for ($year = $currentYear; $year >= $currentYear - 100; $year--) {
                $selected = ($year == $currentYear) ? 'selected' : '';
                echo "<option value='$year' $selected>$year</option>";
              }
            ?>
          </select>
        </div>
      </div>
      <br> <!-- Add some space above the submit button -->
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $day = $_POST["day"];
  $month = $_POST["month"];
  $year = $_POST["year"];

  // Check if the entered date is valid
  if (checkdate($month, $day, $year)) {
    echo "<p>Date is valid!</p>";

    // Chinese Zodiac Calculation
    $zodiacs = [
      'Monkey', 'Rooster', 'Dog', 'Pig', 'Rat', 'Ox', 'Tiger',
      'Rabbit', 'Dragon', 'Snake', 'Horse', 'Sheep'
    ];
    $chineseZodiac = $zodiacs[($year - 1900) % 12];
    echo "<p>Chinese Zodiac: $chineseZodiac</p>";

    // Star Sign Calculation
    $starSigns = [
      ['name' => 'Aquarius', 'start' => ['month' => 1, 'day' => 20], 'end' => ['month' => 2, 'day' => 18]],
      ['name' => 'Pisces', 'start' => ['month' => 2, 'day' => 19], 'end' => ['month' => 3, 'day' => 20]],
      ['name' => 'Aries', 'start' => ['month' => 3, 'day' => 21], 'end' => ['month' => 4, 'day' => 19]],
      // ... Add the remaining star signs and their date ranges
    ];

    $starSign = '';
    foreach ($starSigns as $sign) {
      $start = $sign['start'];
      $end = $sign['end'];
      if (($month === $start['month'] && $day >= $start['day']) || ($month === $end['month'] && $day <= $end['day'])) {
        $starSign = $sign['name'];
        break;
      }
    }
    echo "<p>Star Sign: $starSign</p>";
  } else {
    echo "<p>Invalid date. Please enter a valid date.</p>";
  }
}
?>
