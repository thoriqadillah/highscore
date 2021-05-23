<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<h1>Halaman home buat para users</h1>
<div class="container1">
<h1 align="center">Welcome to World's Rank Game!</h1>

    <div class="container">
        <div class="row">
          <div align="center" class="col-6 col-sm-4">Dinosaur Games</div>
          <div align="center" class="col-6 col-sm-4">Flappy Bird</div>
      
          <!-- Force next columns to break to new line at md breakpoint and up -->
          <div class="w-100 d-none d-md-block"></div>
          <div align="center" class="col-6 col-sm-4"><img src="asset/dinosaur.png" alt="dinosaur">  </div>
          <div align="center" class="col-6 col-sm-4"><img src="asset/Flappy_bird.png" alt="flappy"></div>
          <div class="w-100 d-none d-md-block"></div>
          <div align="center" class="col-6 col-sm-4"><button type="submit" class="btn btn">Leaderboard</button></div>
          <div align="center" class="col-6 col-sm-4"><button type="submit" class="btn btn">Leaderboard</button></div>
          <br> <br>
          <div class="w-100 d-none d-md-block"></div>
          <div align="center" class="col-6 col-sm-4"><button type="submit" class="btn btn">Record My Score</button></div>
          <div align="center" class="col-6 col-sm-4"><button type="submit" class="btn btn">Record My Score</button></div>
        </div>
      </div>
      

<?= $this->endSection(); ?>
