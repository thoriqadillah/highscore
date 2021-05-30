<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<h1>Halaman Buat tamu</h1>
<div class="container">
<h1 align="center">Leaderboard Dinosaur Games</h1>

<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Username</th>
        <th scope="col">Image</th>
        <th scope="col">Score</th>
        <th scope="col">Game</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1; ?>
      <?php foreach ($post as $tampil) :?>
      <tr>
        <th scope="row"><?= $i++; ?></th>
        <td><?= $tampil['username']; ?></td>
        <td><?= $tampil['image']></td>
        <td><?= $tampil['score']; ?></td>
        <td><?= $tampil['game_id']; ?></td>
      </tr>
<?php endforeach; ?>
      
<?= $this->endSection(); ?>
