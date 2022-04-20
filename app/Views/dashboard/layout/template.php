<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?= $title ?></title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url('css/table.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/signature.css') ?>">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('template/assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('template/assets/css/components.css') ?>">
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.2.2/pdf_viewer.css" rel="stylesheet"> -->
    <style>
        #signcanva:hover {
            cursor: url("<?= base_url('images/cursor/pen.cur') ?>"), auto;
        }
    </style>
</head>

<body>
    <?= $this->renderSection('modal'); ?>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right">
                            <div class="dropdown-header">Notifications
                                <div class="float-right">
                                    <a href="#">Mark All As Read</a>
                                </div>
                            </div>
                            <div class="dropdown-list-content dropdown-list-icons">
                                <a href="#" class="dropdown-item dropdown-item-unread">
                                    <div class="dropdown-item-icon bg-primary text-white">
                                        <i class="fas fa-code"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        Template update is available now!
                                        <div class="time text-primary">2 Min Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-info text-white">
                                        <i class="far fa-user"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>You</b> and <b>Dedik Sugiharto</b> are now friends
                                        <div class="time">10 Hours Ago</div>
                                    </div>
                                </a>
                            </div>
                            <div class="dropdown-footer text-center">
                                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link nav-link-lg nav-link-user">
                            <img alt="image" src="<?= base_url('template'); ?>/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, <?= $nama ?></div>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="#">RekSpot</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="#">RS</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li class="nav-item">
                        <li><a title="Home" class="nav-link" href="<?= base_url('/home'); ?>"><i class="fas fa-home"></i><span>Home</span></a></li>
                        <li><a title="Kelas" class="nav-link" href="<?= base_url('/kelas'); ?>"><i class="fas fa-school"></i><span>Kelas</span></a></li>
                        <li><a title="Data Siswa" class="nav-link" href="<?= base_url('/siswa'); ?>"><i class="fas fa-graduation-cap"></i><span>Data Siswa</span></a></li>
                        <li><a title="Data Siswa Advanced" class="nav-link" href="<?= base_url('/dtsiswa'); ?>"><i class="fas fa-users"></i><span>Data Siswa V.1.5</span></a></li>
                        <li><a title="Data User" class="nav-link" href="<?= base_url('/users'); ?>"><i class="fas fa-user-lock"></i><span>User</span></a></li>
                        <li><a title="Data Files" class="nav-link" href="<?= base_url('/files'); ?>"><i class="fas fa-folder"></i><span>Files</span></a></li>
                        </li>
                        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                            <a href="<?= base_url('/login/logout') ?>" class="btn btn-primary btn-lg btn-block btn-icon-split">
                                <i class="fas fa-sign-out-alt"></i> Log Out
                            </a>
                        </div>
                    </ul>
                    </li>
                    </ul>
                </aside>
            </div>

            <?= $this->renderSection('content') ?>

            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2022 <div class="bullet"></div> Design By <a href="#">Unknown Person</a>
                </div>
                <div class="footer-right">
                    2.3.0
                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.2.2/pdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.2.2/pdf_viewer.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.min.js" integrity="sha512-Z8CqofpIcnJN80feS2uccz+pXWgZzeKxDsDNMD/dJ6997/LSRY+W4NmEt9acwR+Gt9OHN0kkI1CTianCwoqcjQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.4/dist/signature_pad.umd.min.js"></script>
    <script src="https://unpkg.com/interactjs/dist/interact.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.min.js" integrity="sha512-pZmE8nx/gdufIRZ9DdgsipK4ocMbdq6zU2epbECb4/iwu9bHfN3aDYmOiVNC8SHk90uWi03o1ziB6JEd6/3VQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <?= $this->renderSection('javascript'); ?>
    <script src="<?= base_url('js/drag.js'); ?>"></script>
    <script src="<?= base_url('js/signature.js'); ?>"></script>
    <script src="<?= base_url('template/assets/js/stisla.js'); ?>"></script>
    <script src="<?= base_url('template/assets/js/scripts.js'); ?>"></script>
    <script src="<?= base_url('template/assets/js/custom.js'); ?>"></script>
    <script src="<?= base_url('template/assets/js/notify.js'); ?>"></script>
    <script src="<?= base_url('template/assets/js/page/index.js'); ?>"></script>
    <script>
        $(document).ready(function() {
            var folder = document.getElementById('folder')
            var path = location.pathname.split('/');
            var url = location.origin + '/' + path[1];

            $('ul.sidebar-menu li a').each(function() {
                if ($(this).attr('href').indexOf(url) !== -1) {
                    $(this).parent().addClass('active').parent().parent('li').addClass('active');
                }
            })
        })
    </script>
</body>

</html>