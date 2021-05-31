<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<h1>Dashboard Admin</h1>

<table class="table table-striped">
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
    <?php foreach ($posts as $p) :?>
        <tr>
            <th scope="row"><?= $i++; ?></th>
            <td><?= $p['username']; ?></td>
            <td><?= $p['image'];?></td>
            <td><?= $p['score']; ?></td>
            <td><?= $p['username']; ?></td>
            <td><?= $p['name']; ?></td>
            <td><a href="/unverify">Unverify</a></td>
            <td><a href="/delete">Delete</a></td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?= $this->endSection(); ?>
