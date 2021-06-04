<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="row mt-3">
  <div class="col">
      <?php foreach ($posts as $p) :?>
            <h1><?= $p['name']; ?></h1>
        <?php endforeach; ?>
  </div>
</div>

<div class="row mt-3">
    <div class="col-6">
        <form action="" method="POST">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari..." name="keyword">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit" name="submit">Cari</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php if ($flashdata) : ?>
    <div class="alert alert-info" role="alert">
        <?= $flashdata; ?>
    </div>
<?php endif; ?>

<div class="row mt-3">
    <div class="col">
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
                    <td><?= $p['name']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
    </div>
</div>


<?= $this->endSection(); ?>
