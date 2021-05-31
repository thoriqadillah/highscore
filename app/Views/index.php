<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>


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
      <?php foreach ($posts as $tampil) :?>
      <tr>
        <th scope="row"><?= $i++; ?></th>
        <td><?= $tampil['username']; ?></td>
        <td><?= $tampil['image'];?></td>
        <td><?= $tampil['score']; ?></td>
        <td><?= $tampil['username']; ?></td>
      </tr>
<?php endforeach; ?>
      
<?= $this->endSection(); ?>
