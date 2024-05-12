<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login & Registration Form</title>
  <!---Custom CSS File--->
  <link rel="stylesheet" href="signs.css">
</head>
<body>
<div class="container">
    <input type="checkbox" id="check">
    <div class="login form">
        <header>Login</header>
        <form action="newcoon.php" method="POST">
            <input type="text" name="login_email" placeholder="Enter your email"> <!-- Added name attribute -->
            <input type="password" name="login_password" placeholder="Enter your password"> <!-- Added name attribute -->
            <a href="#">Forgot password?</a>
            <input type="submit" class="button" value="Login"> <!-- Changed type to submit -->
        </form>
        <div class="signup">
            <span class="signup">Don't have an account?
                <label for="check">Signup</label>
            </span>
        </div>
    </div>
    <div class="registration form">
        <header>Signup</header>
        <form action="newcoon.php" method="POST">
            <input type="text" name="username" placeholder="Enter your username"> <!-- Added name attribute -->
            <input type="text" name="email" placeholder="Enter your email"> <!-- Added name attribute -->
            <input type="password" name="password" placeholder="Create a password"> <!-- Added name attribute -->
            <input type="password" placeholder="Confirm your password">
            <input type="submit" class="button" value="Signup"> <!-- Changed type to submit -->
        </form>
        <div class="signup">
            <span class="signup">Already have an account?
                <label for="check">Login</label>
            </span>
        </div>
    </div>
</div>


</body>
</html>