<?php
/**
 * View: Login
 * Halaman login
 */
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - <?php echo APP_NAME; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --danger-color: #e74c3c;
        }

        body {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-box {
            width: 100%;
            max-width: 400px;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .login-box h1 {
            color: var(--secondary-color);
            margin-bottom: 30px;
            text-align: center;
            font-weight: 700;
        }

        .login-box .form-control {
            height: 45px;
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-bottom: 15px;
            padding: 10px 15px;
        }

        .login-box .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .login-btn {
            height: 45px;
            background-color: var(--primary-color);
            border: none;
            border-radius: 5px;
            font-weight: 600;
            color: white;
            width: 100%;
            cursor: pointer;
            transition: 0.3s;
        }

        .login-btn:hover {
            background-color: #2980b9;
            color: white;
        }

        .login-info {
            background-color: #e8f4f8;
            border-left: 4px solid var(--primary-color);
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-size: 0.9rem;
        }

        .error-message {
            color: var(--danger-color);
            margin-bottom: 15px;
            padding: 10px;
            background-color: #fadbd8;
            border-radius: 5px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-box">
        <h1><i class="fas fa-lock"></i> Login</h1>
        
        <?php if (!empty($error)): ?>
            <div class="error-message">
                <i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <div class="login-info">
            <strong>Demo Credentials:</strong><br>
            Username: <strong>admin</strong><br>
            Password: <strong>password</strong>
        </div>

        <form method="POST" action="">
            <div class="mb-3">
                <input 
                    type="text" 
                    class="form-control" 
                    name="username" 
                    placeholder="Username" 
                    required 
                    autofocus
                >
            </div>
            <div class="mb-3">
                <input 
                    type="password" 
                    class="form-control" 
                    name="password" 
                    placeholder="Password" 
                    required
                >
            </div>
            <button type="submit" name="login" class="login-btn">
                <i class="fas fa-sign-in-alt"></i> Login
            </button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
