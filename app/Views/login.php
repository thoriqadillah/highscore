<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="row">
    <div class="col">
        <form action="/highscore/login_process" method="POST">
            <div class="form-group" class="text-center" >      
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" >
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>