<?= $this->extend('shared/dashboard_layout') ?>

<?= $this->section('body') ?>
<h2 class="mt-4">Pending Payment Confirmations</h2>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><i class="fa fa-home"></i></li>
    <li class="breadcrumb-item">Payments</li>
    <li class="breadcrumb-item active">Pending Confirmations</li>
</ol>
<div class="row">
    <div class="col-xl-10 col-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Single Payment Mode</a>
                        <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Batch Payment Mode</a>
                        <!-- <a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a> -->
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active p-3" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="table-responsive">
                            <table class="table table-hover table-sm f14" id="singleTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Investor</th>
                                        <th>Account</th>
                                        <th>Amount</th>
                                        <th>Fee</th>
                                        <th>Week</th>
                                        <th>Paid&nbsp;Date</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade p-3" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">Tab 2</div>
                    <!-- <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">Tab 3</div> -->
                </div>
            </div>
        </div>
    </div>

</div>


<?= $this->endSection() ?>

<?= $this->section('css') ?>
<link href="<?= base_url('d_assets/lib/datatables.net-bs4/css/dataTables.bootstrap4.css') ?>" rel="stylesheet" />
<link href="<?= base_url('d_assets/lib/chosen_v1.8.7/chosen.min.css') ?>" rel="stylesheet" />
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- <script src="~/lib/Chart.js/chart.js"></script>
<script src="~/lib/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js"></script>
 -->
 <script src="<?= base_url('d_assets/lib/datatables.net/jquery.dataTables.js') ?>"></script>
<script src="<?= base_url('d_assets/lib/datatables.net-bs4/js/dataTables.bootstrap4.js') ?>"></script>
<script src="<?= base_url('d_assets/lib/chosen_v1.8.7/chosen.jquery.min.js') ?>"></script>
<script src="<?= base_url('d_assets/js/pending_confirmations.js') ?>"></script>
<?= $this->endSection() ?>