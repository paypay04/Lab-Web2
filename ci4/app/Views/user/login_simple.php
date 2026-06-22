<!DOCTYPE html>
<html>
<head>
    <title>Login Simple</title>
</head>
<body>
    <h1>Login</h1>
    
    <?php if(session()->getFlashdata('flash_msg')): ?>
        <div style="color:red"><?= session()->getFlashdata('flash_msg') ?></div>
    <?php endif; ?>
    
    <form method="GET" action="<?= base_url('user/login') ?>">
        <p>
            <label>Email:</label><br>
            <input type="email" name="email" required>
        </p>
        <p>
            <label>Password:</label><br>
            <input type="password" name="password" required>
        </p>
        <p>
            <button type="submit">LOGIN</button>
        </p>
    </form>
</body>
</html>