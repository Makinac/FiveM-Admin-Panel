<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel | Creator</title>
    <link rel="stylesheet" href="/assets/css/creator.css">
</head>
<body>
    <div class="container">
        <div class="progress-bar">
            <div class="step" id="step-1">Framework selection</div>
            <div class="step" id="step-2">Framework database</div>
            <div class="step" id="step-3">Master account</div>
        </div>
        <div class="setup-frame active" id="setup-1">
            <h2>Select your framework</h2>
            <div class="framework-option" data-framework="esx">
                <label>
                    <img src="/assets/images/frameworks/esx.png" alt="esx">
                    <span>ESX-Legacy</span>
                </label>
            </div>
            <div class="framework-option" data-framework="qb">
                <label>
                    <img src="/assets/images/frameworks/qb.png" alt="qb">
                    <span>QBCore</span>
                </label>
            </div>
            <div class="framework-option" data-framework="qbox">
                <label>
                    <img src="/assets/images/frameworks/qbox.png" alt="qbox">
                    <span>QBox</span>
                </label>
            </div>
            <div class="framework-option" data-framework="ox">
                <label>
                    <img src="/assets/images/frameworks/ox.png" alt="ox">
                    <span>OX Core</span>
                </label>
            </div>
            <div class="buttons">
                <button class="next" id="next-1" disabled>Next</button>
            </div>
        </div>

        <div class="setup-frame" id="setup-2">
            <h2>Connection to framework database</h2>
            <form id="db-framework-form">
                <input type="text" name="host" placeholder="Host" required>
                <input type="number" name="port" placeholder="Port (optional)">
                <input type="text" name="user" placeholder="User" required>
                <div class="password-wrapper">
                    <input type="password" name="password" placeholder="Password (optional)">
                    <button type="button" class="toggle-password">👁️</button>
                </div>
                <input type="text" name="database" placeholder="Database" required>
            </form>
            <div class="buttons">
                <button class="back" id="back-2">Back</button>
                <button class="next" id="next-2" disabled>Next</button>
            </div>
        </div>

        <div class="setup-frame" id="setup-3">
            <h2>Master account</h2>
            <form id="account-form">
                <input type="text" name="username" placeholder="Username" required>
                <div class="password-wrapper">
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="button" class="toggle-password">👁️</button>
                </div>
                <div class="password-wrapper">
                    <input type="password" name="confirm-password" placeholder="Confirm password" required>
                    <button type="button" class="toggle-password">👁️</button>
                </div>
            </form>
            <div class="buttons">
                <button class="back" id="back-3">Back</button>
                <button class="next" id="submit" disabled>Submit</button>
            </div>
        </div>
    </div>
    
    <script src="/assets/js/creator.js"></script>
</body>
</html>
