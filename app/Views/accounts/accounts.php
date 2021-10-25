<?= $this->extend('shared/dashboard_layout') ?>

<?= $this->section('body') ?>
<h2 class="mt-4">My Accounts</h2>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><i class="fa fa-home"></i></li>
    <li class="breadcrumb-item active">My Accounts</li>
</ol>
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body">
               
                <div class="table-responsive">
                    <table class="table table-hover table-sm f14" id="accountsTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Number</th>
                                <th>Balance</th>
                                <th>Total&nbsp;Interest</th>
                                <th>Status</th>
                                <th>Is&nbsp;Cleared?</th>
                                <th>Is&nbsp;Settled?</th>
                                <th>Start&nbsp;Date</th>
                                <th>End&nbsp;Date</th>
                                <th>Created&nbsp;Date</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>


<?= $this->endSection() ?>

<?= $this->section('css') ?>
<link href="<?= base_url('d_assets/lib/datatables.net-bs4/css/dataTables.bootstrap4.css') ?>" rel="stylesheet" />
<!-- <link href="<?= base_url('d_assets/lib/chosen_v1.8.7/chosen.min.css') ?>" rel="stylesheet" /> -->
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- <script src="~/lib/Chart.js/chart.js"></script>
<script src="~/lib/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js"></script>
 -->
<script src="<?= base_url('d_assets/lib/datatables.net/jquery.dataTables.js') ?>"></script>
<script src="<?= base_url('d_assets/lib/datatables.net-bs4/js/dataTables.bootstrap4.js') ?>"></script>
<script src="<?= base_url('d_assets/lib/chosen_v1.8.7/chosen.jquery.min.js') ?>"></script>
<script src="<?= base_url('d_assets/js/accounts.js') ?>"></script>
<?= $this->endSection() ?>