<?= $this->extend('dashboard/layout/template') ?>

<?= $this->section('content'); ?>
<!-- Main-Content -->
<div class="main-content">
    <section class="section">
        <div class="row mt-2">
            <div class="col">
                <h5 class="mt-5">Selamat Siang <?= $nama ?></h5>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>