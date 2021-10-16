<?= $this->extend('shared/dashboard_layout') ?>

<?= $this->section('body') ?>
<h2 class="mt-4">Complete Profile</h2>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><i class="fa fa-home"></i></li>
    <li class="breadcrumb-item">Profile</li>
    <li class="breadcrumb-item active">Complete Profile</li>
</ol>
<div class="row">
    <div class="col-lg-8 col-md-10 col-12">
        <div class="card shadow-sm">
            <form id="profileForm">
                <fieldset id="fieldset">
                    <div class="card-body">
                        <h6>Next of Kin Details</h6>
                        <hr class="mt-2" />
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fname" class="f14">* First Name</label>
                                    <input type="text" id="fname" class="form-control" required placeholder="First name" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lname" class="f14">* Last Name</label>
                                    <input type="text" id="lname" class="form-control" required placeholder="Last name" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="oname" class="f14">Other Name</label>
                                    <input type="text" id="oname" class="form-control" placeholder="Other name" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gender" class="f14">* Gender</label>
                                    <select id="gender" class="form-control custom-select" required>
                                        <option value="">- Choose gender -</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="relationship" class="f14">* Relationship</label>
                                    <input type="text" id="relationship" class="form-control" required placeholder="Relationship with Next of Kin" />
                                    <!-- <select id="relationship" class="form-control custom-select" required>
                                        <option value="">- Choose relationship -</option>
                                        <option value="Father">Father</option>
                                        <option value="Mother">Mother</option>
                                        <option value="Brother">Brother</option>
                                        <option value="Sister">Sister</option>
                                        <option value="Uncle">Uncle</option>
                                        <option value="Aunt">Aunt</option>
                                    </select> -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="f14">Email Address</label>
                                    <input type="email" id="email" class="form-control" placeholder="Email Address" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone" class="f14">* Mobile Number</label>
                                    <input type="text" id="phone" class="form-control" required placeholder="Mobile Number" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address" class="f14">* Address</label>
                                    <textarea id="address" class="form-control" required placeholder="Contact address"></textarea>
                                </div>
                            </div>
                        </div>
                        <h6>Bank Details</h6>
                        <hr class="mt-2" />
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="bank" class="f14">* Bank</label>
                                    <select id="bank" class="form-control custom-select" required>
                                        <option value="">- Choose bank -</option>
                                        <?php foreach($banks as $b): ?>
                                            <option value="<?= $b['id'] ?>"><?= $b['name'] ?></option>
                                        <?php endforeach ?>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="acc_type" class="f14">* Account Type</label>
                                    <select id="acc_type" class="form-control custom-select" required>
                                        <option value="">- Choose account type -</option>
                                        <option value="Current">Current</option>
                                        <option value="Savings">Savings</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="acc_name" class="f14">* Account Name</label>
                                    <input type="text" id="acc_name" class="form-control" required placeholder="Account Name" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="acc_number" class="f14">* Account Number</label>
                                    <input type="text" id="acc_number" class="form-control integer" maxlength="10" required placeholder="Account Number" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="button" class="btn btn-outline-secondary btn-sm px-3" data-dismiss="modal"><i class="fa fa-times"></i> &nbsp;Cancel</button>
                        <button type="submit" id="saveBtn" class="btn btn-primary btn-sm px-3"><i class="fa fa-check-circle"></i> &nbsp;Save</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

</div>


<?= $this->endSection() ?>

<?= $this->section('css') ?>
<!-- <link href="~/lib/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet" /> -->
<link href="<?= base_url('d_assets/lib/chosen_v1.8.7/chosen.min.css') ?>" rel="stylesheet" />
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- <script src="~/lib/Chart.js/chart.js"></script>
<script src="~/lib/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js"></script>
<script src="~/lib/datatables.net/jquery.dataTables.js"></script>
<script src="~/lib/datatables.net-bs4/js/dataTables.bootstrap4.js"></script> -->
<script src="<?= base_url('d_assets/lib/chosen_v1.8.7/chosen.jquery.min.js') ?>"></script>
<script src="<?= base_url('d_assets/js/complete_profile.js') ?>"></script>
<?= $this->endSection() ?>