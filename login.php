<?php
session_start();

// Cek apakah user sudah login
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php"); // Redirect ke dashboard jika sudah login
    exit();
}

// Login logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Data user untuk contoh, bisa diganti dengan database
    $user_data = [
        'admin' => 'password123',
        'Kelompok2' => '12345678'
    ];

    if (isset($user_data[$username]) && $user_data[$username] === $password) {
        $_SESSION['username'] = $username; // Set session username
        header("Location: index.php"); // Redirect ke dashboard
        exit();
    } else {
        $error_message = "Username atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: #f4f4f4;
        }
        .login-container {
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .login-container h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #333333;
        }
        .login-container label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
            color: #555555;
        }
        .login-container input {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #dddddd;
            border-radius: 5px;
            font-size: 16px;
            color: #333333;
            box-sizing: border-box;
        }
        .login-container input:focus {
            border-color: #4ca571;
            box-shadow: 0 0 5px rgba(76, 165, 113, 0.3);
            outline: none;
        }
        .login-container button {
            width: 100%;
            padding: 12px;
            background-color: #4ca571;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
            transition: background-color 0.3s ease;
        }
        .login-container button:hover {
            background-color: #388e59;
        }
        .error-message {
            color: #ff4d4d;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }
        @media (max-width: 768px) {
            body {
                padding: 20px;
            }
            .login-container {
                padding: 20px;
            }
            .login-container h1 {
                font-size: 22px;
            }
            .login-container input, .login-container button {
                font-size: 14px;
            }
        }
        @media (max-width: 480px) {
            .login-container {
                padding: 15px;
            }
            .login-container h1 {
                font-size: 20px;
            }
            .login-container input, .login-container button {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <?php if (isset($error_message)): ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
