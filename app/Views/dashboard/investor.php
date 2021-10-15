<?= $this->extend('shared/dashboard_layout') ?>

<?= $this->section('body') ?>
<h2 class="mt-4">Dashboard</h2>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><i class="fa fa-home"></i></li>
    <li class="breadcrumb-item active">Dashboard</li>
</ol>
<div class="row">
    <div class="col-12">
        <?php if (!$reg_completed) : ?>
            <?php if ($reg_payment_status == PAY_STATUS_UNPAID || $reg_payment_status == PAY_STATUS_NOT_RECEIVED) : ?>
                <div class="alert alert-info">
                    <h4>Welcome <?= $session->get('identity')['first_name'] ?>!</h4>
                    <?php if ($reg_payment_status == PAY_STATUS_UNPAID) : ?>
                        <p class="f14">We are glad to have you on board. You have taken the first step by signing up, now to complete registration, kindly make the mandatory registration fee payment of <b>&#8358;<?= number_format($reg_fee, 2) ?></b>. Please, note this covers your contribution for the first 2 weeks.</p>
                    <?php elseif ($reg_payment_status == PAY_STATUS_NOT_RECEIVED) : ?>
                        <p class="f14">We have checked in with our bank and confirmed that your payment was not received. Kindly try again - make the mandatory registration fee payment of <b>&#8358;<?= number_format($reg_fee, 2) ?></b>. Please, note this covers your contribution for the first 2 weeks.</p>
                    <?php endif ?>
                    <p class="mt-3 f14">To make payment, use one of the options below</p>
                    <div class="row mt-3">
                        <div class="col-md-5">
                            <h6 class="f16 pt-sm-3 pt-md-0">Paystack</h6>
                            <hr class="mt-1 mb-2" />
                            <p class="f14">Payments done via this method will not require confirmation and will reflect immediately.</p>
                            <button type="button" class="btn btn-primary mt-3" disabled>Pay with paystack</button>
                            <p class="text-muted my-2">Coming Soon</p>
                        </div>
                        <div class="col-md-7">
                            <h6 class="f16 pt-sm-3 pt-md-0">Bank Transfer</h6>
                            <hr class="mt-1 mb-2" />
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered border f12 text-dark">
                                    <tbody>
                                        <tr>
                                            <th>Bank Name</th>
                                            <td>Fidelity Bank PLC</td>
                                        </tr>
                                        <tr>
                                            <th>Account Type</th>
                                            <td>Current</td>
                                        </tr>
                                        <tr>
                                            <th>Account Name</th>
                                            <td>Noble Merry Ventures</td>
                                        </tr>
                                        <tr>
                                            <th>Account Number</th>
                                            <td>0023405674</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <p class="f14">Once you have successfully made the transfer, kindly contact our customer service for confirmation via <a href="mailto:info@noblemerry.com">info@noblemerry.com</a> or +23481098765432.</p>
                            <button type="button" class="btn btn-primary ml-auto d-block" id="transferBtn"><i class="fa fa-check-circle"></i> I have made payments</button>
                        </div>
                    </div>
                </div>
            <?php elseif ($reg_payment_status == PAY_STATUS_PENDING_CONFIRMATION) : ?>
                <div class="alert alert-info">
                <h4>Welcome <?= $session->get('identity')['first_name'] ?>!</h4>
                <p class="f14">Your registration fee payment is currently pending confirmation. kindly contact our customer service via <a href="mailto:info@noblemerry.com">info@noblemerry.com</a> or +23481098765432 to speed up the confirmation.</p>

                <?php if (!$profile_complete) : ?>
                    <p class="f14 mt-3">In the meantime, kindly click the button below to complete your profile.</p>
                    <button type="button" class="btn btn-primary d-block mt-2" id="profileBtn"> Complete Profile</button>
                <?php endif ?>
            </div>
            <?php endif ?>
            

        <?php endif ?>
    </div>
</div>
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white mb-4 shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        <div class="pl-3">
                            <i class="fa fa-user fa-5x"></i>
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="pr-3">
                            <h5 class="pt-3 m-0 text-right">Active Accounts</h5>
                            <h3 class="text-right pt-1 text-right w-100">0</h3>
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
        <div class="card bg-success text-white mb-4 shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        <div class="pl-3">
                            <i class="fa fa-user fa-5x"></i>
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="pr-3">
                            <h5 class="pt-3 m-0 text-right">Settled Accounts</h5>
                            <h3 class="text-right pt-1 text-right w-100">0</h3>
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
                            <h5 class="pt-3 m-0 text-right">Total <br />Invested</h5>
                            <h3 class="text-right pt-1 text-right w-100">N0.00</h3>
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
        <div class="card bg-secondary text-white mb-4 shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        <div class="pl-3">
                            <i class="fa fa-list-alt fa-5x"></i>
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="pr-3">
                            <h5 class="pt-3 m-0 text-right">Total <br />Interest</h5>
                            <h3 class="text-right pt-1 text-right w-100">N0.00</h3>
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
<!-- <link href="~/lib/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet" /> -->
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- <script src="~/lib/Chart.js/chart.js"></script>
<script src="~/lib/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js"></script>
<script src="~/lib/datatables.net/jquery.dataTables.js"></script>
<script src="~/lib/datatables.net-bs4/js/dataTables.bootstrap4.js"></script> -->
<script src="<?= base_url('d_assets/js/investor_dashboard.js') ?>"></script>
<?= $this->endSection() ?>