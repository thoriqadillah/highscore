<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>


    <div class="row mt-5">

        <h1>World's Rank Game Registration</h1>
        <div class="col-6">
            <form action="/registration/signup" method="POST">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" >Email</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="usernameHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" >Username</label>
                    <input type="username" class="form-control" id="username" name="username" aria-describedby="usernameHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label" >Password</label>
                    <input type="password" class="form-control" id="pass" name="pass">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword2" class="form-label" >Repeat Password</label>
                    <input type="password" class="form-control" id="repass" name="repass">
                </div>
                <button type="submit" class="btn btn-primary">Sign Up</button>
            </form>
            <p>Sudah punya akun? Masuk <a href="/login/index">di sini</a></p>
        </div>
            
    </div>


<?= $this->endSection(); ?>
