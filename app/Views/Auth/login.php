<!DOCTYPE html>
<html>
<head>
    <title>Login - <?= APP_NAME ?></title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f4f6f9;
            color: #2c3e50;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            width: 100%;
            max-width: 380px;
            background: #ffffff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }
        h1 {
            color: #1a5276;
            border-bottom: 3px solid #1a5276;
            padding-bottom: 10px;
            margin-top: 0;
            font-size: 22px;
        }
        label {
            display: block;
            margin-top: 14px;
            margin-bottom: 6px;
            font-weight: 600;
            font-size: 14px;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d5dbdb;
            border-radius: 6px;
            font-size: 14px;
        }
        button {
            width: 100%;
            margin-top: 22px;
            padding: 10px 16px;
            background-color: #1a5276;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
        }
        button:hover { background-color: #154360; }
        .alert {
            margin-top: 16px;
            padding: 10px 14px;
            background-color: #fdecea;
            color: #c0392b;
            border: 1px solid #f5b7b1;
            border-radius: 6px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login <?= APP_NAME ?></h1>

        <?php if (!empty($error)) : ?>
            <div class="alert"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST" action="/si-akademik/public/login/process">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required autofocus>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Masuk</button>
        </form>
    </div>
</body>
</html>