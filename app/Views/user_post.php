<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="row mt-3">
  <div class="col">
      <h1>My Post</h1>
  </div>
</div>

<?php if ($flashdata->getFlashdata('berhasil')) : ?>
    <div class="alert alert-info" role="alert">
        <?= $flashdata->getFlashdata('berhasil'); ?>
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
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($posts as $p) :?>
                <tr>
                    <th scope="row"><?= $i++; ?></th>
                    <td><?= $p['username']; ?></td>
                    <td><img src="/img/<?= $p['image']; ?>" style="width: 300px;"></td>
                    <td><?= $p['score']; ?></td>
                    <td><?= $p['name']; ?></td>
                    <td>
                        <?php if ($p['verified'] == true) : ?>
                            <p class="text-success">Terverifikasi</p>
                        <?php else : ?>
                            <p class="text-info">Belum Terverifikasi</p>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
    </div>
</div>


<?= $this->endSection(); ?>
