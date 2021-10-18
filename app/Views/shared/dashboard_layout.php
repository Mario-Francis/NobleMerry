<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= $title ?> | Noble Merry Ventures</title>
    <link href="<?= base_url('d_assets/lib/animate.css/animate.css'); ?>" rel="stylesheet" />
    <link href="<?= base_url('d_assets/css/styles.css'); ?>" rel="stylesheet" />
    <link href="<?= base_url('d_assets/lib/boxicons/css/boxicons.css'); ?>" rel="stylesheet" />
    <link href="<?= base_url('d_assets/lib/font-awesome/css/all.css'); ?>" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="<?= base_url('d_assets/lib/Zebra_datepicker/css/bootstrap/zebra_datepicker.css'); ?>" rel="stylesheet" />
    <link href="<?= base_url('d_assets/lib/selectize.js/css/selectize.bootstrap4.css'); ?>" rel="stylesheet" />

    <?= $this->renderSection('css') ?>

    <link href="<?= base_url('d_assets/css/fonts.css'); ?>" rel="stylesheet" />
    <link href="<?= base_url('d_assets/css/main.css'); ?>" rel="stylesheet" />
</head>

<body class="sb-nav-fixed bg-light dashboard-bg">
    <nav class="sb-topnav navbar navbar-expand navbar-light bg-white shadow-sm">
        <a class="navbar-brand f18" href="#">
            <img src="<?= base_url('assets/img/noble_merry_logo.png'); ?>" alt="logo" class="img-fluid" style="max-width: 40px;" />
            <span class="text-uppercase text-dark pt-2 font-weight-bold font-italic text-shadow-dark">Noble <span class="text-gold">Merry</span></span>

        </a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 ml-lg-0 ml-2" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar-->
        <ul class="navbar-nav ml-auto">
            <!-- <li class="nav-item">
                <div class="btn-group d-block">
                    <button type="button" class="btn text-dark btn-sm dropdown-toggle text-white d-block ml-auto remove-btn-outline px-0" style="margin-top:8px;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-globe-africa"></i> &nbsp;@sharedLocalizer[service.Culture] <i class="fa fa-caret-down"></i>
                    </button>
                    <input type="hidden" id="culture" value="@service.Culture" />
                    <div class="dropdown-menu dropdown-menu-right">
                        <button class="dropdown-item culture" type="button" culture="en">@sharedLocalizer["en"]</button>
                        <button class="dropdown-item culture" type="button" culture="fr">@sharedLocalizer["fr"]</button>
                        <button class="dropdown-item culture" type="button" culture="pt">@sharedLocalizer["pt"]</button>
                        <button class="dropdown-item culture" type="button" culture="es">@sharedLocalizer["es"]</button>
                    </div>
                </div>
            </li> -->

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#!" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="f14 py-2" style="max-width:250px;">
                        <div class="float-left mt-n1 px-2">
                            <p class="font-weight-bold mt-0">
                                Hi, <?= $session->get('identity')['first_name'] ?>
                            </p>
                            <p class="mt-n1 small text-right"><?= $session->get('identity')['role_id'] == 1 ? 'Administrator' : 'Investor'  ?></p>
                        </div>
                        <div class="p-2 rounded-circle bg-gold float-left mt-n2 d-none d-sm-inline-block"><?= $session->get('identity')['initial'] ?></div>
                        <div class="h-50 pl-3"><i class="fa fa-caret-down pl-1 mt-1"></i></div>
                    </div>
                </a>

                <div class="dropdown-menu dropdown-menu-right f14" aria-labelledby="userDropdown">
                    <!-- <a class="dropdown-item" asp-controller="Logs" asp-action="ActivityLogs">Activity Logs</a>
                    <a class="dropdown-item" asp-controller="Logs" asp-action="ErrorLogs">Error Logs</a>
                     -->
                     <a class="dropdown-item" href="<?= base_url('investor/profile') ?>">My Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?= base_url('auth/logout') ?>">Logout</a>
                </div>
            </li>

            <!-- <li class="nav-item">
                    Not logged in!
                </li> -->
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark bg-gold" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <!-- <div class="pl-1 py-3">
                            <h6 class="px-2  m-0 text-uppercase roboto" style="border-left:2px solid #fff;">ECO <br />Behavioural <br />Assessment PORTAL</h6>
                        </div> -->
                        <div class="py-3"></div>
                        <a class="nav-link" href="<?= base_url('dashboard') ?>">
                            <i class="fas fa-tachometer-alt"></i> &nbsp; Dashboard
                        </a>
                        <?php if (isset($session->get('identity')['reg_completed']) && $session->get('identity')['reg_completed']): ?>

                        <?php endif ?>
                        <!-- <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">

                            <i class='fa fa-users'></i> &nbsp; Employees
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav pl-2">

                                <a class="nav-link" href="#">View Employees</a>
                                <a class="nav-link" href="#">Batch Mapping Upload</a>
                                <a class="nav-link" href="#">Mapping Upload History</a>
                            </nav>
                        </div> -->

                        <!-- <div class="sb-sidenav-menu-heading">Reports</div>
                                <a class="nav-link @(service.ControllerName.ToLower() == "logs" && service.ActionName.ToLower() == "activitylogs" ? "active" : "")" asp-controller="Logs" asp-action="ActivityLogs">
                                    <i class="fas fa-chart-area"></i> &nbsp; Activity Logs
                                </a>
                                <a class="nav-link @(service.ControllerName.ToLower() == "logs" && service.ActionName.ToLower() == "errorlogs" ? "active" : "")" asp-controller="Logs" asp-action="ErrorLogs">
                                    <i class="fas fa-exclamation-triangle"></i> &nbsp; Error Logs
                                </a> -->

                    </div>
                </div>
                <div class="sb-sidenav-footer bg-gold">
                    <div class="small">Version 1.0.0</div>

                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid" style="padding-bottom:40px;">

                    <?= $this->renderSection('body') ?>

                </div>
            </main>
            <footer class="py-3 bg-light mt-auto shadow-sm">
                <div class="container-fluid">
                    <div class="d-inline d-md-flex align-items-center justify-content-between small">
                        <div class="text-muted text-center text-md-left">Copyright 2021 &copy; Noble Merry. All rights reserved.<br /><span class="f12">Powered by Codec Multimedia.</span></div>
                        <div class=" text-center text-md-right">
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="<?= base_url('d_assets/lib/jquery/jquery.js'); ?>"></script>
    <script src="<?= base_url('d_assets/lib/twitter-bootstrap/js/bootstrap.bundle.js'); ?>"></script>
    <script src="<?= base_url('d_assets/js/scripts.js'); ?>"></script>
    <script src="<?= base_url('d_assets/lib/bootstrap-notify/bootstrap-notify.js'); ?>"></script>
    <script src="<?= base_url('d_assets/lib/sweetalert2/dist/sweetalert2.all.js'); ?>"></script>
    <script src="<?= base_url('d_assets/lib/bootbox.js/bootbox.js'); ?>"></script>
    <script src="<?= base_url('d_assets/lib/js-cookie/js.cookie.js'); ?>"></script>
    <script src="<?= base_url('d_assets/lib/accounting.js/accounting.js'); ?>"></script>
    <script src="<?= base_url('d_assets/js/notify.js'); ?>"></script>
    <script src="<?= base_url('d_assets/lib/Zebra_datepicker/zebra_datepicker.min.js'); ?>"></script>
    <script src="<?= base_url('d_assets/lib/selectize.js/js/standalone/selectize.js'); ?>"></script>
    <script src="<?= base_url('d_assets/lib/moment.js/moment.js'); ?>"></script>
    <script src="<?= base_url('d_assets/js/utilities.js'); ?>"></script>
    <script src="<?= base_url('d_assets/js/culture.js'); ?>"></script>
    <script>
        $base = '<?= base_url(); ?>';
        // roles
    </script>

    <?= $this->renderSection('js') ?>

</body>

</html>