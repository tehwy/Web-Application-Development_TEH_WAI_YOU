<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Form</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <h1>Registration Form</h1>
    <?php
    // Initialize variables with empty values
    $firstName = $lastName = $dobDay = $dobMonth = $dobYear = $gender = $username = $password = $confirmPassword = $email = "";
    $firstNameErr = $lastNameErr = $dobErr = $genderErr = $usernameErr = $passwordErr = $confirmPasswordErr = $emailErr = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Function to sanitize and validate input
      function sanitizeInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

      // Validate First Name
      if (empty($_POST["firstName"])) {
        $firstNameErr = "First Name is required";
      } else {
        $firstName = sanitizeInput($_POST["firstName"]);
      }

      // Validate Last Name
      if (empty($_POST["lastName"])) {
        $lastNameErr = "Last Name is required";
      } else {
        $lastName = sanitizeInput($_POST["lastName"]);
      }

      // Validate Date of Birth
      if (empty($_POST["dobDay"]) || empty($_POST["dobMonth"]) || empty($_POST["dobYear"])) {
        $dobErr = "Date of Birth is required";
      } else {
        $dobDay = sanitizeInput($_POST["dobDay"]);
        $dobMonth = sanitizeInput($_POST["dobMonth"]);
        $dobYear = sanitizeInput($_POST["dobYear"]);
      }

      // Validate Gender
      if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
      } else {
        $gender = sanitizeInput($_POST["gender"]);
      }

      // Validate Username
      if (empty($_POST["username"])) {
        $usernameErr = "Username is required";
      } else {
        $username = sanitizeInput($_POST["username"]);
        if (!preg_match("/^(?![0-9])[a-zA-Z0-9_-]{6,}$/", $username)) {
          $usernameErr = "Username must start with a letter, be at least 6 characters long, and only allow '_' or '-' in between";
        }
      }

      // Validate Password
      if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
      } else {
        $password = sanitizeInput($_POST["password"]);
        if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/", $password)) {
          $passwordErr = "Password must be at least 6 characters long and contain at least 1 uppercase letter, 1 lowercase letter, and 1 number. No symbols allowed";
        }
      }

      // Validate Confirm Password
      if (empty($_POST["confirmPassword"])) {
        $confirmPasswordErr = "Confirm Password is required";
      } else {
        $confirmPassword = sanitizeInput($_POST["confirmPassword"]);
        if ($confirmPassword !== $password) {
          $confirmPasswordErr = "Passwords do not match";
        }
      }

      // Validate Email
      if (empty($_POST["email"])) {
        $emailErr = "Email is required";
      } else {
        $email = sanitizeInput($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $emailErr = "Invalid email format";
        }
      }

      // If all fields are valid, you can process the form data as needed
      if (empty($firstNameErr) && empty($lastNameErr) && empty($dobErr) && empty($genderErr) && empty($usernameErr) && empty($passwordErr) && empty($confirmPasswordErr) && empty($emailErr)) {
        // Perform additional processing or database operations here
        // Redirect or display success message
        echo "<div class='alert alert-success'>Registration Successful!</div>";
        exit;
      }
    }
    ?>
    <form id="registrationForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <div class="mb-3">
        <label for="firstName" class="form-label">First Name:</label>
        <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $firstName; ?>" required>
        <span class="text-danger"><?php echo $firstNameErr; ?></span>
      </div>
      <div class="mb-3">
        <label for="lastName" class="form-label">Last Name:</label>
        <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $lastName; ?>" required>
        <span class="text-danger"><?php echo $lastNameErr; ?></span>
      </div>
      <div class="mb-3">
        <label for="dob" class="form-label">Date of Birth:</label>
        <div class="row">
          <div class="col">
            <input type="number" class="form-control" id="dobDay" name="dobDay" placeholder="Day" value="<?php echo $dobDay; ?>" required>
          </div>
          <div class="col">
            <input type="number" class="form-control" id="dobMonth" name="dobMonth" placeholder="Month" value="<?php echo $dobMonth; ?>" required>
          </div>
          <div class="col">
            <input type="number" class="form-control" id="dobYear" name="dobYear" placeholder="Year" value="<?php echo $dobYear; ?>" required>
          </div>
        </div>
        <span class="text-danger"><?php echo $dobErr; ?></span>
      </div>
      <div class="mb-3">
        <label for="gender" class="form-label">Gender:</label>
        <select class="form-select" id="gender" name="gender" required>
          <option value="">Select</option>
          <option value="male" <?php if ($gender === "male") echo "selected"; ?>>Male</option>
          <option value="female" <?php if ($gender === "female") echo "selected"; ?>>Female</option>
          <option value="other" <?php if ($gender === "other") echo "selected"; ?>>Other</option>
        </select>
        <span class="text-danger"><?php echo $genderErr; ?></span>
      </div>
      <div class="mb-3">
        <label for="username" class="form-label">Username:</label>
        <input type="text" class="form-control" id="username" name="username" pattern="^(?![0-9])[a-zA-Z0-9_-]{6,}$" title="Username must start with a letter, be at least 6 characters long, and only allow '_' or '-' in between." value="<?php echo $username; ?>" required>
        <span class="text-danger"><?php echo $usernameErr; ?></span>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password:</label>
        <input type="password" class="form-control" id="password" name="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$" title="Password must be at least 6 characters long and contain at least 1 uppercase letter, 1 lowercase letter, and 1 number. No symbols allowed." required>
        <span class="text-danger"><?php echo $passwordErr; ?></span>
      </div>
      <div class="mb-3">
        <label for="confirmPassword" class="form-label">Confirm Password:</label>
        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
        <span class="text-danger"><?php echo $confirmPasswordErr; ?></span>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
        <span class="text-danger"><?php echo $emailErr; ?></span>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
