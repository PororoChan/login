<?= $this->extend('/dashboard/layout/template'); ?>

<?= $this->section('content') ?>
<!-- Main-Content -->
<div class="main-content">
    <section class="section">
        <div class="row mt-2">
            <div class="col">
                <h5 class="mt-5">Data Users</h5>

                <table class="table" id="datasiswa">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Username</th>
                            <th scope="col">Password</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($user as $k) : ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td><?= $k['nama'] ?></td>
                                <td><?= $k['username'] ?></td>
                                <td><?= $k['password'] ?></td>
                                <td>
                                    <button type="button" id="btn-edit" class="btn btn-warning" data-id="<?= $k['id_user'] ?>"><i class="fas fa-edit"></i></button>
                                    <button type="button" id="btn-delete" class="btn btn-danger" data-id="<?= $k['id_user'] ?>"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>