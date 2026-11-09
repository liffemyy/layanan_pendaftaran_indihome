<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - IndiHome</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>?v=<?= time() ?>">
</head>
<body>

<section class="auth-section">
    <div class="auth-box">
        <h2>Login Admin</h2>
        <p class="auth-subtitle">Khusus untuk pengelola website IndiHome</p>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="auth-alert"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form action="<?= base_url('admin/login') ?>" method="post">
            <div class="auth-field">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>
            <div class="auth-field">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-full">Login</button>
        </form>
    </div>
</section>

</body>
</html>