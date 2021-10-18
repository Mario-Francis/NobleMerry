<?= $this->extend('shared/dashboard_layout') ?>

<?= $this->section('body') ?>
<h2 class="mt-4">My Profile</h2>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><i class="fa fa-home"></i></li>
    <li class="breadcrumb-item active">My Profile</li>
</ol>
<div class="row">
    <div class="col-xl-4 col-md-6 col-12 my-2">
        <div class="card shadow-sm">
            <div class="card-header">
                <h6 class="m-0">Personal Details 
                    <span  class="float-right"><a id="editBasicBtn" class="btn-link" href="javascript:void(0);" title="Edit"><i class="fa fa-edit"></i></a></span>
                </h6>
                
            </div>
            <div class="card-body">
                <div class="bg-dblue rounded-circle py-3 px-2 text-center d-block mx-auto" style="width: 80px;height:80px;word-wrap:normal;">
                    <p class="f30"><?= $session->get('identity')['initial'] ?></p>
                </div>
                <h5 class="text-center mt-2 mb-0"><?= $user['first_name'] . ' ' . $user['other_name'] . ' ' . $user['last_name']  ?></h5>
                <p class="text-center f16"><?= $session->get('identity')['role'] ?></p>
                <hr />
                <div class="row f14 my-1">
                    <div class="col-4 font-weight-bold text-right">Email: </div>
                    <div class="col-8"><?= $session->get('identity')['email'] ?></div>
                </div>
                <div class="row f14 my-1">
                    <div class="col-4 font-weight-bold text-right">Gender: </div>
                    <div class="col-8"><?= $user['gender'] ?></div>
                </div>
                <div class="row f14 my-1">
                    <div class="col-4 font-weight-bold text-right">Mobile: </div>
                    <div class="col-8"><?= $user['phone_number'] ?></div>
                </div>
                <div class="row f14 my-1">
                    <div class="col-4 font-weight-bold text-right">Reg code: </div>
                    <div class="col-8"><?= $investor['reg_code'] ?></div>
                </div>
                <div class="row f14 my-1">
                    <div class="col-4 font-weight-bold text-right">Referral ID: </div>
                    <div class="col-8"><?= $investor['referral_id'] ?></div>
                </div>
                <div class="row f14 my-1">
                    <div class="col-4 font-weight-bold text-right">Settlement: </div>
                    <div class="col-8"><?= $investor['settlement_method'] ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6 col-12 my-2">
        <div class="card shadow-sm">
            <div class="card-header">
                <h6 class="m-0">Bank Details
                <span  class="float-right"><a id="editBankBtn" class="btn-link" href="javascript:void(0);" title="Edit"><i class="fa fa-edit"></i></a></span>
                </h6>
            </div>
            <div class="card-body">
                <div class="bg-lgold2 text-dark rounded-circle py-3 px-2 text-center d-block mx-auto" style="width: 80px;height:80px;word-wrap:normal;">
                    <p class="f30">
                        <i class="fa fa-university"></i>
                    </p>
                </div>
                <h5 class="text-center mt-2 mb-0"><?= $bank_detail['bank_name'] ?></h5>
                <!-- <p class="text-center f16">Investor</p> -->
                <hr />
                <div class="row f14 my-1">
                    <div class="col-4 font-weight-bold text-right">Account Name: </div>
                    <div class="col-8"><?= $bank_detail['account_name'] ?></div>
                </div>
                <div class="row f14 my-1">
                    <div class="col-4 font-weight-bold text-right">Account Type: </div>
                    <div class="col-8"><?= $bank_detail['account_type'] ?></div>
                </div>
                <div class="row f14 my-1">
                    <div class="col-4 font-weight-bold text-right">Account Number: </div>
                    <div class="col-8"><?= $bank_detail['account_number'] ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6 col-12 my-2">
        <div class="card shadow-sm">
            <div class="card-header">
                <h6 class="m-0">Next of Kin Details
                <span  class="float-right"><a id="editNokBtn"  class="btn-link" href="javascript:void(0);" title="Edit"><i class="fa fa-edit"></i></a></span>
                </h6>
            </div>
            <div class="card-body">
                <div class="bg-dgold rounded-circle py-3 px-2 text-center d-block mx-auto" style="width: 80px;height:80px;word-wrap:normal;">
                    <p class="f30"><?= $nok['first_name'][0] . $nok['last_name'][0] ?></p>
                </div>
                <h5 class="text-center mt-2 mb-0"><?= $nok['first_name'] . ' ' . $nok['other_name'] . ' ' . $nok['last_name']  ?></h5>
                <!-- <p class="text-center f16">Investor</p> -->
                <hr />
                <div class="row f14 my-1">
                    <div class="col-4 font-weight-bold text-right">Email: </div>
                    <div class="col-8"><?= $nok['email'] ?></div>
                </div>
                <div class="row f14 my-1">
                    <div class="col-4 font-weight-bold text-right">Gender: </div>
                    <div class="col-8"><?= $nok['gender'] ?></div>
                </div>
                <div class="row f14 my-1">
                    <div class="col-4 font-weight-bold text-right">Mobile: </div>
                    <div class="col-8"><?= $nok['phone_number'] ?></div>
                </div>
                <div class="row f14 my-1">
                    <div class="col-4 font-weight-bold text-right">Address: </div>
                    <div class="col-8"><?= $nok['address'] ?></div>
                </div>
                <div class="row f14 my-1">
                    <div class="col-4 font-weight-bold text-right">Relationship: </div>
                    <div class="col-8"><?= $nok['relationship'] ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Personal details Modal -->
<div class="modal fade" id="basicModal">
    <div class="modal-dialog modal-md modal-dialog-scrollable" style="margin-top:10vh;">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Personal Details <span></span></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form id="basicForm">
                <fieldset id="fieldset">
                    <!-- Modal body -->
                    <div class="modal-body" style="max-height: 65vh;">
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="fname" class="f14">* First Name</label>
                                    <input id="fname" type="text" class="form-control" required placeholder="First name" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="lname" class="f14">* Last Name</label>
                                    <input id="lname" type="text" class="form-control" required placeholder="Last name" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="oname" class="f14">Other Name</label>
                                    <input id="oname" type="text" class="form-control" placeholder="Other name" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="gender" class="f14">* Gender</label>
                                    <select id="gender" class="form-control custom-select" required>
                                    <option value="">- Select gender -</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email" class="f14">* Email</label>
                                    <input id="email" type="email" class="form-control" required placeholder="Email" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="phone" class="f14">* Phone Number</label>
                                    <input id="phone" type="text"  maxlength="16" class="form-control" required placeholder="Phone number" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="settlement" class="f14">* Settlement Method</label>
                                    <select id="settlement" class="form-control custom-select" required>
                                    <option value="">- Select settlement meethod -</option>
                                        <option value="FOODSTUFF">Foodstuff</option>
                                        <option value="PROVISION">Provision</option>
                                        <option value="CASH">Cash</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary btn-sm px-3" data-dismiss="modal"><i class="fa fa-times"></i> &nbsp;Cancel</button>
                        <button type="submit" id="basicUpdateBtn" class="btn btn-primary btn-sm px-3"><i class="fa fa-check-circle"></i> &nbsp;Update</button>
                    </div>
                </fieldset>
            </form>

        </div>
    </div>
</div>

<!-- Edit bank details Modal -->
<div class="modal fade" id="bankModal">
    <div class="modal-dialog modal-md modal-dialog-scrollable" style="margin-top:15vh;">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Bank Details <span></span></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form  id="bankForm">
                <fieldset id="fieldset2">
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row mt-2">
                            <div class="col-md-12">
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
                            <div class="col-md-12">
                                <div class="form-group">
                                <label for="acc_type" class="f14">* Account Type</label>
                                    <select id="acc_type" class="form-control custom-select" required>
                                        <option value="">- Choose account type -</option>
                                        <option value="CURRENT">Current</option>
                                        <option value="SAVINGS">Savings</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                <label for="acc_name" class="f14">* Account Name</label>
                                    <input type="text" id="acc_name" class="form-control" required placeholder="Account Name" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                <label for="acc_number" class="f14">* Account Number</label>
                                    <input type="text" id="acc_number" class="form-control integer" maxlength="10" required placeholder="Account Number" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary btn-sm px-3" data-dismiss="modal"><i class="fa fa-times"></i> &nbsp;Cancel</button>
                        <button type="submit" id="bankUpdateBtn" class="btn btn-primary btn-sm px-3"><i class="fa fa-check-circle"></i> &nbsp;Update</button>
                    </div>
                </fieldset>
            </form>

        </div>
    </div>
</div>

<!-- Edit Nok details Modal -->
<div class="modal fade" id="nokModal">
    <div class="modal-dialog modal-md modal-dialog-scrollable" style="margin-top:10vh;">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Personal Details <span></span></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form id="nokForm">
                <fieldset id="fieldset3">
                    <!-- Modal body -->
                    <div class="modal-body" style="max-height: 65vh;">
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nfname" class="f14">* First Name</label>
                                    <input type="text" id="nfname" class="form-control" required placeholder="First name" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nlname" class="f14">* Last Name</label>
                                    <input type="text" id="nlname" class="form-control" required placeholder="Last name" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="noname" class="f14">Other Name</label>
                                    <input type="text" id="noname" class="form-control" placeholder="Other name" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="ngender" class="f14">* Gender</label>
                                    <select id="ngender" class="form-control custom-select" required>
                                        <option value="">- Choose gender -</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nrelationship" class="f14">* Relationship</label>
                                    <input type="text" id="nrelationship" class="form-control" required placeholder="Relationship with Next of Kin" />
                                    
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nemail" class="f14">Email Address</label>
                                    <input type="email" id="nemail" class="form-control" placeholder="Email Address" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nphone" class="f14">* Mobile Number</label>
                                    <input type="text" id="nphone" class="form-control" required placeholder="Mobile Number" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="naddress" class="f14">* Address</label>
                                    <textarea id="naddress" class="form-control" required placeholder="Contact address"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary btn-sm px-3" data-dismiss="modal"><i class="fa fa-times"></i> &nbsp;Cancel</button>
                        <button type="submit" id="nokUpdateBtn" class="btn btn-primary btn-sm px-3"><i class="fa fa-check-circle"></i> &nbsp;Update</button>
                    </div>
                </fieldset>
            </form>

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
<script src="<?= base_url('d_assets/js/investor_profile.js') ?>"></script>
<?= $this->endSection() ?>