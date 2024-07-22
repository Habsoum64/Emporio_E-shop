<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Emporio E-Shop</title>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Times New Roman, sans-serif;
            background-color: red; 
            background: linear-gradient(to right, burlywood, khaki);
            background-image: url('img/loginPage.jpg'); 
            background-size: cover;
            background-attachment: fixed;
            background-position: bottom;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
        }
        
        .container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            font-weight: bold;
        }
        
        input[type="text"],
        input[type="password"] {
            width: 95%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        
        #login {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #4a81da;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            background-color: #007bff;
            color: #fff;
        }
        
        button:hover {
            background-color: #0056b3;
        }
        
        .error-message {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form id="login-form" action="action/login_user_action.php" method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" placeholder="Email" id="email" name="email" required>
		<span class="fas fa-user"></span>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" placeholder="Password" id="password" name="password" required>
                <span class="fas fa-lock"></span>
            </div>
            <p style="text-align: center; font-family: Times New Roman, sans-serif;"><button type="submit" name="login" id="btn" onclick="return validateLogin()">Login</button></p>
        </form>
        <p class="register-link" style="text-align:center;">Don't have an account? <a href="login/register_view.php">Register</a></p>
    </div>

    <script>
        function validateLogin() {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[^\s]{8,}$/;
        
            if (!emailRegex.test(email)) {
                alert('Please enter a valid email address');
                return false;
            }
        
            if (!passwordRegex.test(password)) {
                alert('Please enter a valid password. Password must contain at least 8 characters');
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
