<?= $this->extend('dashboard/layout/template') ?>

<?= $this->section('content'); ?>
<!-- Main-Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard & Reports</h1>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-file"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total File</h4>
                        </div>
                        <div class="card-body mt-2">
                            <?= $count ?>
                            <a style="font-size: 11px;" href="<?= base_url('/files') ?>" class="card-link float-right mt-4"> View Details <i class="fas fa-chevron-right"></i> </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-folder"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Size</h4>
                        </div>
                        <div class="card-body mt-2">
                            0
                            <a style="font-size: 11px;" href="#" class="card-link float-right mt-4"> View Details <i class="fas fa-chevron-right"></i> </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-hourglass-start"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Pending Workflow</h4>
                        </div>
                        <div class="card-body mt-2">
                            0
                            <a style="font-size: 11px;" href="#" class="card-link float-right mt-4"> View Details <i class="fas fa-chevron-right"></i> </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-share"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Document Shared</h4>
                        </div>
                        <div class="card-body mt-2">
                            0
                            <a style="font-size: 11px;" href="#" class="card-link float-right mt-4">View Details <i class="fas fa-chevron-right"></i> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>
<?= $this->endSection(); ?>