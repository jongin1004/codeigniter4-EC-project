<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
    <div class=" d-flex flex-column justify-content-center py-7" style="height: 100vh;">
        <h1>Register</h1>
        <form action="<?= base_url('register') ?>" method="post">
            <!-- 이름 -->
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="user_name" class="form-control" id="name" placeholder="1234 Main St">
            </div>

            <!-- 이메일 -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="user_email" class="form-control" id="email" placeholder="1234 Main St">
            </div>

            <!-- 패스워드 -->
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="password">Password</label>
                <input type="password" name="user_password" class="form-control" id="password">
                </div>
                <div class="form-group col-md-6">
                <label for="password_confirm">Confirm Password</label>
                <input type="password" name="password_confirm" class="form-control" id="password_confirm">
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">register</button>
        </form>
    </div>
<?= $this->endSection() ?>