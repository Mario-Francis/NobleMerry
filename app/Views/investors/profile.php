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
                    <p class="f30">MM</p>
                </div>
                <h5 class="text-center mt-2 mb-0">Ezeobele Mario-Francis Chukwudi</h5>
                <p class="text-center f16">Investor</p>
                <hr />
                <div class="row f14 my-1">
                    <div class="col-4 font-weight-bold text-right">Email: </div>
                    <div class="col-8">mariofrancis34@gmail.com</div>
                </div>
                <div class="row f14 my-1">
                    <div class="col-4 font-weight-bold text-right">Gender: </div>
                    <div class="col-8">Male</div>
                </div>
                <div class="row f14 my-1">
                    <div class="col-4 font-weight-bold text-right">Mobile: </div>
                    <div class="col-8">09088776655</div>
                </div>
                <div class="row f14 my-1">
                    <div class="col-4 font-weight-bold text-right">Reg code: </div>
                    <div class="col-8">09088776655</div>
                </div>
                <div class="row f14 my-1">
                    <div class="col-4 font-weight-bold text-right">Referral ID: </div>
                    <div class="col-8">09088776655</div>
                </div>
                <div class="row f14 my-1">
                    <div class="col-4 font-weight-bold text-right">Settlement: </div>
                    <div class="col-8">09088776655</div>
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
                <h5 class="text-center mt-2 mb-0">First Bank of Nigeria</h5>
                <!-- <p class="text-center f16">Investor</p> -->
                <hr />
                <div class="row f14 my-1">
                    <div class="col-4 font-weight-bold text-right">Account Name: </div>
                    <div class="col-8">Mario Francis</div>
                </div>
                <div class="row f14 my-1">
                    <div class="col-4 font-weight-bold text-right">Account Type: </div>
                    <div class="col-8">Savings</div>
                </div>
                <div class="row f14 my-1">
                    <div class="col-4 font-weight-bold text-right">Account Number: </div>
                    <div class="col-8">09088776655</div>
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
                    <p class="f30">MM</p>
                </div>
                <h5 class="text-center mt-2 mb-0">Ezeobele Mario-Francis Chukwudi</h5>
                <!-- <p class="text-center f16">Investor</p> -->
                <hr />
                <div class="row f14 my-1">
                    <div class="col-4 font-weight-bold text-right">Email: </div>
                    <div class="col-8">mariofrancis34@gmail.com</div>
                </div>
                <div class="row f14 my-1">
                    <div class="col-4 font-weight-bold text-right">Gender: </div>
                    <div class="col-8">Male</div>
                </div>
                <div class="row f14 my-1">
                    <div class="col-4 font-weight-bold text-right">Mobile: </div>
                    <div class="col-8">09088776655</div>
                </div>
                <div class="row f14 my-1">
                    <div class="col-4 font-weight-bold text-right">Address: </div>
                    <div class="col-8">09088776655</div>
                </div>
                <div class="row f14 my-1">
                    <div class="col-4 font-weight-bold text-right">Relationship: </div>
                    <div class="col-8">09088776655</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Personal details Modal -->
<div class="modal fade" id="basicModal">
    <div class="modal-dialog modal-md modal-dialog-scrollable" style="margin-top:15vh;">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Personal Details <span></span></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form>
                <fieldset>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="e_assessmentTypeId" class="f14">* Assessment Type</label>
                                    <select id="e_assessmentTypeId" class="form-control custom-select" asp-items="@dropdownService.GetAssessmentTypes()" required>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="e_fromDate" class="f14">* From</label>
                                    <input id="e_fromDate" class="form-control date" required />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="e_toDate" class="f14">* To</label>
                                    <input id="e_toDate" class="form-control date" required />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="e_deadline" class="f14">* Deadline</label>
                                    <input id="e_deadline" class="form-control post-today" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary btn-sm px-3" data-dismiss="modal"><i class="fa fa-times"></i> &nbsp;Cancel</button>
                        <button type="submit" id="updateBtn" class="btn btn-primary btn-sm px-3"><i class="fa fa-check-circle"></i> &nbsp;Update</button>
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
                <h4 class="modal-title">Edit Personal Details <span></span></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form>
                <fieldset>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="e_assessmentTypeId" class="f14">* Assessment Type</label>
                                    <select id="e_assessmentTypeId" class="form-control custom-select" asp-items="@dropdownService.GetAssessmentTypes()" required>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="e_fromDate" class="f14">* From</label>
                                    <input id="e_fromDate" class="form-control date" required />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="e_toDate" class="f14">* To</label>
                                    <input id="e_toDate" class="form-control date" required />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="e_deadline" class="f14">* Deadline</label>
                                    <input id="e_deadline" class="form-control post-today" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary btn-sm px-3" data-dismiss="modal"><i class="fa fa-times"></i> &nbsp;Cancel</button>
                        <button type="submit" id="updateBtn" class="btn btn-primary btn-sm px-3"><i class="fa fa-check-circle"></i> &nbsp;Update</button>
                    </div>
                </fieldset>
            </form>

        </div>
    </div>
</div>

<!-- Edit Nok details Modal -->
<div class="modal fade" id="nokModal">
    <div class="modal-dialog modal-md modal-dialog-scrollable" style="margin-top:15vh;">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Personal Details <span></span></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form>
                <fieldset>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="e_assessmentTypeId" class="f14">* Assessment Type</label>
                                    <select id="e_assessmentTypeId" class="form-control custom-select" asp-items="@dropdownService.GetAssessmentTypes()" required>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="e_fromDate" class="f14">* From</label>
                                    <input id="e_fromDate" class="form-control date" required />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="e_toDate" class="f14">* To</label>
                                    <input id="e_toDate" class="form-control date" required />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="e_deadline" class="f14">* Deadline</label>
                                    <input id="e_deadline" class="form-control post-today" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary btn-sm px-3" data-dismiss="modal"><i class="fa fa-times"></i> &nbsp;Cancel</button>
                        <button type="submit" id="updateBtn" class="btn btn-primary btn-sm px-3"><i class="fa fa-check-circle"></i> &nbsp;Update</button>
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