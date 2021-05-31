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
            <td><?= $p['name']; ?></td>
            <td>
                <form action="/admin/<?= $p['id']; ?>" method="POST">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="DELETE"/>
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus post tersebut?')">DELETE</button>
                </form>
            </td>
            <td>
                <form action="/admin/<?= $p['id']; ?>" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    <button type="submit" class="btn btn-warning" onclick="return confirm('Apakah Anda yakin memverifikasi post tersebut?')">VERIFY</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?= $this->endSection(); ?>
