<div class="row justify-content-center">
    <div class="col-md-4">
        <h5 class="mb-3">Login</h5>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form action="/bkpm/acara14/si-akademik/public/login" method="POST">
            <div class="mb-3">
                <label class="form-label">UserName</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Loginn</button>

        </form>
    </div>
</div>