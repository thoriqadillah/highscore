<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>


    <div class="row mt-5">

        <h1>World's Rank Game Registration</h1>
        <div class="col-6">
            <form action="/registration/signup" method="POST">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" >Email</label>
                    <input type="email" class="form-control <?= ($validation->hasError('email') ? 'is-invalid' : '' ); ?>" id="email" name="email" aria-describedby="usernameHelp">
                    <div class="invalid-feedback">
                        <?= $validation->getError('email'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" >Username</label>
                    <input type="username" class="form-control <?= ($validation->hasError('username') ? 'is-invalid' : '' ); ?>" id="username" name="username" aria-describedby="usernameHelp">
                    <div class="invalid-feedback">
                        <?= $validation->getError('username'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label" >Password</label>
                    <input type="password" class="form-control <?= ($validation->hasError('email') ? 'is-invalid' : '' ); ?>" id="password" name="password">
                    <div class="invalid-feedback">
                        <?= $validation->getError('password'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword2" class="form-label" >Repeat Password</label>
                    <input type="password" class="form-control <?= ($validation->hasError('email') ? 'is-invalid' : '' ); ?>" id="repeat-password" name="repeat-password">
                    <div class="invalid-feedback">
                        <?= $validation->getError('repeat-password'); ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Sign Up</button>
            </form>
            <p>Sudah punya akun? Masuk <a href="/login/index">di sini</a></p>
        </div>
            
    </div>


<?= $this->endSection(); ?>
