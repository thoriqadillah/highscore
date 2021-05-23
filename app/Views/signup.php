<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container" align="center">
    <h1>World's Rank Game Registration</h1>
    <form >
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Username</label>
        <input type="username" class="form-control" id="exampleInputEmail1" aria-describedby="usernameHelp">
        
      </div>
      <br> 
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="repeatpassword" class="form-control" id="exampleInputPassword1">
      </div>
      <br> 
      <div class="mb-3">
        <label for="exampleInputPassword2" class="form-label">Repeat Password</label>
        <input type="repeatpassword" class="form-control" id="exampleInputPassword2">
      </div>
      <br>
      <button type="submit" class="btn btn-primary">Sign Up</button>
    </form>
</div>

<?= $this->endSection(); ?>
