<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
    <div class=" d-flex flex-column justify-content-center py-7" style="height: 100vh;">
        <form action="<?= base_url('login?URL='.$_GET['URL']) ?>" method="post" class="form-signin">
            <div class="text-center mb-4">
                <img class="mb-4" src="/docs/4.6/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
                <h1 class="h3 mb-3 font-weight-normal">Login</h1>
            </div>

            <div class="form-label-group">
                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="">
            </div>

            <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="">
            </div>

            <div class="checkbox mb-3">
                <label>
                <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </form>
    </div>
<?= $this->endSection() ?>