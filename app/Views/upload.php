<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="row">
    <div class="col-8">
        <h1 class="my-3">Upload Highscore Anda!</h1>
        <form action="/highscore/upload_post" method="POST" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="form-group row">
                <label for="score" class="col-sm-2 col-form-label">Score</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validation->hasError('score') ? 'is-invalid' : '' ); ?>" id="score" name="score" autofocus> 
                    <div class="invalid-feedback">
                        <?= $validation->getError('score'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="image" class="col-sm-2 col-form-label">Screenshot</label>
                <div class="col-sm-10">
                    <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input <?= ($validation->hasError('image') ? 'is-invalid' : '' ); ?>" id="image">
                        <div class="invalid-feedback">
                            <?= $validation->getError('image'); ?>
                        </div>
                        <label class="custom-file-label" for="image">Pilih gambar...</label>
                    </div>
                </div>
            </div>
            <div class="form-group row-4">
                <select name="game" class="custom-select mr-sm-2  <?= ($validation->hasError('game') ? 'is-invalid' : '' ); ?>" id="game">
                    <!-- yang diambil nanti valuenya. misal milih one, nanti kalo $game = $this->req->getVar('game'); hasilnya 1 -->
                    <option selected disabled>Pilih Game...</option> 
                    <?php foreach($games as $g) : ?>
                        <option value="<?= $g['id']; ?>"><?= $g['name']; ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">
                    <?= $validation->getError('game'); ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Post</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>