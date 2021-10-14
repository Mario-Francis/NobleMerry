<?= $this->extend('shared/dashboard_layout') ?>

<?= $this->section('body') ?>
<h2 class="mt-4">Dashboard</h2>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><i class="fa fa-home"></i></li>
    <li class="breadcrumb-item active">Dashboard</li>
</ol>
<!-- Batches raw data -->
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white mb-4 shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        <div class="pl-3">
                            <i class="fa fa-users fa-5x"></i>
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="pr-3">
                            <h5 class="pt-3 m-0 text-right">Employees</h5>
                            <h3 class="text-right pt-1 text-right w-100">9,774</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="#">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-info text-white mb-4 shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        <div class="pl-3">
                            <i class="fa fa-list-alt fa-5x"></i>
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="pr-3">
                            <h5 class="pt-3 m-0 text-right">Assessments</h5>
                            <h3 class="text-right pt-1 text-right w-100">4</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="#">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>


</div>
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<link href="~/lib/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet" />
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="~/lib/Chart.js/chart.js"></script>
<script src="~/lib/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js"></script>
<script src="~/lib/datatables.net/jquery.dataTables.js"></script>
<script src="~/lib/datatables.net-bs4/js/dataTables.bootstrap4.js"></script>
<script src="~/js/dashboard.js"></script>
<?= $this->endSection() ?>