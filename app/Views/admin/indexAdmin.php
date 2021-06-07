<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="row mt-3">
    <div class="col-6">
        <h1>Dashboard Admin</h1>
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
<?php elseif ($terhapus) : ?>
    <div class="alert alert-info" role="alert">
        <?= $terhapus; ?>
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
                <th scope="col"></th>
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
                    <?php if ($p['verified'] == false) : ?>
                        <td>
                            <a href="/admin/verify/<?= $p['id']; ?>" class="btn btn-primary" onclick="return confirm('Apakah Anda yakin ingin memverifikasi post tersebut?')">VERIFY</a>
                        </td>
                    <?php else : ?>
                        <td>
                            <a href="/admin/unverify/<?= $p['id']; ?>" class="btn btn-warning" onclick="return confirm('Apakah Anda yakin ingin mencabut verifikasi post tersebut?')">UNVERIFY</a>
                        </td>
                    <?php endif; ?>
                    <td>
                        <a href="/admin/<?= $p['id']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus post tersebut?')">DELETE</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
    </div>
</div>


<?= $this->endSection(); ?>
