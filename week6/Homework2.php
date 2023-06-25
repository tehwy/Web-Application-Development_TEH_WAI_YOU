<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Malaysian IC Information</title>

  <!-- Include Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  <!-- CSS for fixed image sizes -->
  <style>
    .zodiac-image,
    .flag-image {
      width: 200px;
      height: auto;
    }
  </style>
</head>

<body>
  <div class="container">
    <h2>Malaysian IC Information</h2>

    <?php
    function validateIC($ic)
    {
      // Validation logic for IC number
      // ...

      return true;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Retrieve and sanitize the input IC number
      $ic = $_POST["ic"];
      $ic = trim($ic);
      $ic = stripslashes($ic);
      $ic = htmlspecialchars($ic);

      // Validate the IC number and retrieve information
      if (validateIC($ic)) {
        // IC number is valid
        $year = substr($ic, 0, 2);
        $month = substr($ic, 2, 2);
        $day = substr($ic, 4, 2);
        $stateCode = substr($ic, 6, 2);

        // Date of Birth
        $dateOfBirth = date("M d, Y", strtotime($day . "-" . $month . "-" . $year));

        // Array mapping state codes to state names and flag images
        $states = array(
          '01' => array('Johor', 'state_flags/johor.png'),
          '02' => array('Kedah', 'state_flags/kedah.png'),
          '03' => array('Kelantan', 'state_flags/kelantan.png'),
          '04' => array('Malacca', 'state_flags/malacca.png'),
          '05' => array('Negeri Sembilan', 'state_flags/negeri_sembilan.png'),
          '06' => array('Pahang', 'state_flags/pahang.png'),
          '07' => array('Penang', 'state_flags/penang.png'),
          '08' => array('Perak', 'state_flags/perak.png'),
          '09' => array('Perlis', 'state_flags/perlis.png'),
          '10' => array('Selangor', 'state_flags/selangor.png'),
          '11' => array('Terengganu', 'state_flags/terengganu.png'),
          '12' => array('Sabah', 'state_flags/sabah.png'),
          '13' => array('Sarawak', 'state_flags/sarawak.png'),
          '14' => array('Wilayah Persekutuan Kuala Lumpur', 'state_flags/wilayah_persekutuan_kuala_lumpur.png'),
          '15' => array('Wilayah Persekutuan Labuan', 'state_flags/wilayah_persekutuan_labuan.png'),
          '16' => array('Wilayah Persekutuan Putrajaya', 'state_flags/wilayah_persekutuan_putrajaya.png'),
        );

        // Check if state code exists in the array, else set it as 'Not Found'
        if (array_key_exists($stateCode, $states)) {
          $stateName = $states[$stateCode][0];
          $stateFlag = $states[$stateCode][1];
        } else {
          $stateName = "Not Found";
          $stateFlag = "";
        }

        // Chinese Zodiac
        $chineseZodiacSigns = array(
          1 => 'Rat',
          2 => 'Ox',
          3 => 'Tiger',
          4 => 'Rabbit',
          5 => 'Dragon',
          6 => 'Snake',
          7 => 'Horse',
          8 => 'Goat',
          9 => 'Monkey',
          10 => 'Rooster',
          11 => 'Dog',
          12 => 'Pig'
        );

        $chineseZodiacSign = $chineseZodiacSigns[($year - 4) % 12];

        // Star Zodiac 
        $starZodiacSigns = array(
          1 => 'Aquarius',
          2 => 'Pisces',
          3 => 'Aries',
          4 => 'Taurus',
          5 => 'Gemini',
          6 => 'Cancer',
          7 => 'Leo',
          8 => 'Virgo',
          9 => 'Libra',
          10 => 'Scorpio',
          11 => 'Sagittarius',
          12 => 'Capricorn'
        );

        $starZodiacSign = $starZodiacSigns[(int)$month];

        // Display the retrieved information
        echo '<div class="row">';
        echo '<div class="col-md-6">';
        echo '<h4>Date of Birth:</h4>';
        echo '<p>' . $dateOfBirth . '</p>';
        echo '<h4>Chinese Zodiac:</h4>';
        echo '<p>' . $chineseZodiacSign . '</p>';
        echo '<img src="chinese_zodiac/' . strtolower($chineseZodiacSign) . '.jpg" alt="' . $chineseZodiacSign . '" class="zodiac-image">';
        echo '</div>';
        echo '<div class="col-md-6">';
        echo '<h4>Star Zodiac:</h4>';
        echo '<p>' . $starZodiacSign . '</p>';
        echo '<img src="star_zodiac/' . strtolower($starZodiacSign) . '.jpg" alt="' . $starZodiacSign . '" class="zodiac-image">';
        echo '</div>';
        echo '</div>';
        echo '<div class="row">';
        echo '<div class="col-md-12">';
        echo '<h4>Place of Birth:</h4>';
        echo '<p>' . $stateName . '</p>';
        if ($stateFlag !== '') {
          echo '<img src="' . $stateFlag . '" alt="' . $stateName . '" class="flag-image">';
        }
        echo '</div>';
        echo '</div>';

      } else {
        // IC number is invalid
        echo '<div class="alert alert-danger">Invalid IC number. Please enter a valid Malaysian IC number.</div>';
      }
    }
    ?>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <div class="form-group">
        <label for="ic">Malaysian IC:</label>
        <input type="text" class="form-control" id="ic" name="ic" required>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>

  <!-- Include Bootstrap JS -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>

</html>
