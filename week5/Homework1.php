<!DOCTYPE html>
<html>

<head>
    <title>Age Validation Form</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Age Validation Form</h2>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve form data
            $firstName = $_POST["first-name"];
            $lastName = $_POST["last-name"];
            $dobDay = $_POST["dob-day"];
            $dobMonth = $_POST["dob-month"];
            $dobYear = $_POST["dob-year"];

            // Validate date of birth
            $dob = $dobYear . "-" . $dobMonth . "-" . $dobDay;
            $today = date("Y-m-d");
            $age = date_diff(date_create($dob), date_create($today))->y;

            if ($age < 18) {
                echo "You must be 18 years old or above.";
                exit;
            }else{
                echo "Submit successfully";
                exit;
            }

        }
        ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="first-name">First Name:</label>
                <input type="text" class="form-control" name="first-name" required>
            </div>
            <div class="form-group">
                <label for="last-name">Last Name:</label>
                <input type="text" class="form-control" name="last-name" required>
            </div>
            <div class="form-group">
                <label>Date of Birth:</label>
                <div class="row">
                    <div class="col">
                        <select class="form-control" name="dob-day" required>
                            <option value="" selected disabled>Day</option>
                            <?php
                            // Generate day options
                            $currentDay = date("j");
                            for ($i = 1; $i <= 31; $i++) {
                                $selected = ($i == $currentDay) ? "selected" : "";
                                echo "<option value=\"$i\" $selected>$i</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col">
                        <select class="form-control" name="dob-month" required>
                            <option value="" selected disabled>Month</option>
                            <?php
                            // Generate month options
                            $currentMonth = date("n");
                            $months = [
                                1 => "January", 2 => "February", 3 => "March", 4 => "April", 5 => "May", 6 => "June",
                                7 => "July", 8 => "August", 9 => "September", 10 => "October", 11 => "November", 12 => "December"
                            ];
                            foreach ($months as $key => $value) {
                                $selected = ($key == $currentMonth) ? "selected" : "";
                                echo "<option value=\"$key\" $selected>$value</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col">
                        <select class="form-control" name="dob-year" required>
                            <option value="" selected disabled>Year</option>
                            <?php
                            // Generate year options
                            $currentYear = date("Y");
                            for ($i = $currentYear; $i >= 1900; $i--) {
                                $selected = ($i == $currentYear) ? "selected" : "";
                                echo "<option value=\"$i\" $selected>$i</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>