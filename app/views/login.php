<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin panel | Login</title>
        <link rel="stylesheet" href="/assets/css/login.css">
    </head>
    <body>
        <div class="container">
            <form id="login-form">
                <h2>Login</h2>
                <input type="text" name="username" placeholder="Username" required>
                <div class="password-wrapper">
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="button" class="toggle-password">👁️</button>
                </div>
                <button type="submit">Login</button>
            </form>
        </div>
        
        <script src="/assets/js/login.js"></script>
    </body>
</html>
