<?= $this->extend('shared/dashboard_layout') ?>

<?= $this->section('body') ?>
<h2 class="mt-4"><?= $title; ?> Payments</h2>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><i class="fa fa-home"></i></li>
    <li class="breadcrumb-item">My Accounts</li>
    <li class="breadcrumb-item active">Payments for <?= '#' . $account['number'] ?></li>
</ol>
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <input type="hidden" id="accountId" value="<?= $account['id'] ?>" />
                <div class="table-responsive">
                    <table class="table table-hover table-sm f14" id="paymentsTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Account</th>
                                <th>Fee</th>
                                <th>Amount</th>
                                <th>Week</th>
                                <th>Due&nbsp;Date</th>
                                <th>Paid&nbsp;Date</th>
                                <th>Payment&nbsp;Method</th>
                                <th>Status</th>
                                <th>Payment&nbsp;Mode</th>
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

<!-- Edit bank details Modal -->
<div class="modal fade" id="payModal">
    <div class="modal-dialog modal-md modal-dialog-scrollable" style="margin-top:15vh;">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><span id="fee"></span> Payment<span></span></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form id="payForm">
                <fieldset id="fieldset">
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="amount" class="f14">* Amount</label>
                                    <input type="text" id="amount" class="form-control money" value="3400" symbol="0x20A6" disabled />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="pay_method" class="f14">* Payment Method</label>
                                    <select id="pay_method" class="form-control custom-select" required>
                                        <option value="">- Choose payment method -</option>
                                        <option value="TRANSFER">TRANSFER</option>
                                        <option value="GATEWAY" disabled>PAYSTACK</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12" id="infoDiv" style="display: none;">
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
                            <button type="button" class="btn btn-primary btn-sm ml-auto d-block" id="transferBtn"><i class="fa fa-check-circle"></i> I have made payments</button>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary btn-sm px-3" data-dismiss="modal"><i class="fa fa-times"></i> &nbsp;Cancel</button>
                        <button type="submit" id="bankUpdateBtn" class="btn btn-primary btn-sm px-3"><i class="fa fa-check-circle"></i> &nbsp;Update</button>
                    </div> -->
                </fieldset>
            </form>

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
<script src="<?= base_url('d_assets/js/account_payments.js') ?>"></script>
<?= $this->endSection() ?>