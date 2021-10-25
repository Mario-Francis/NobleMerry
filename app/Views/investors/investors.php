<?= $this->extend('shared/dashboard_layout') ?>

<?= $this->section('body') ?>
<h2 class="mt-4">Investors</h2>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><i class="fa fa-home"></i></li>
    <li class="breadcrumb-item active">Investors</li>
</ol>
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Onboarding</a>
                        <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Onboarded</a>
                        <!-- <a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a> -->
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active p-3" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="table-responsive">
                            <table class="table table-hover table-sm f14" id="onboardingTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Full Name</th>
                                        <th>Gender</th>
                                        <th>Reg.&nbsp;Code</th>
                                        <th>Email</th>
                                        <th>Phone&nbsp;Number</th>
                                        <th>Reg.&nbsp;Date</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade p-3" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="table-responsive">
                            <table class="table table-hover table-sm f14" id="onboardedTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Full Name</th>
                                        <th>Gender</th>
                                        <th>Reg.&nbsp;Code</th>
                                        <th>Email</th>
                                        <th>Phone&nbsp;Number</th>
                                        <th>Reg.&nbsp;Date</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <!-- <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">Tab 3</div> -->
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
<script src="<?= base_url('d_assets/js/investors.js') ?>"></script>
<?= $this->endSection() ?>