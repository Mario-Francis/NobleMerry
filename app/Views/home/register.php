<?= $this->extend('shared/home_layout') ?>

<?= $this->section('body') ?>

<div class="page-title-area bg-1">
    <div class="container">
        <div class="page-title-content">
            <h2>Register</h2>
            <p class="text-gold">Already have an account? <a class="text-gold" href="<?=  base_url('auth/login') ?>">Log in</a></p>
            <!-- <ul>
            <li>
              <a href="index.html"> Home </a>
            </li>
            <li class="active">About</li>
          </ul> -->
        </div>
    </div>
</div>

<section id="about" class="about-section ptb-100">
    <div class="container">
        <div class="row my-4">
            <div class="col-lg-4 d-lg-block d-md-none">
                <img src="<?= base_url('assets/img/custom/signup.png'); ?>" alt="signup image" class="img-fluid " />
            </div>
            <div class="col-lg-8 col-md-12">
                <form id="registerForm">
                    <fieldset id="fieldset">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group py-2">
                                    <label for="fname">* First Name</label>
                                    <input id="fname" type="text" class="form-control" placeholder="First Name" required />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group py-2">
                                    <label for="lname">* Last Name</label>
                                    <input id="lname" type="text" class="form-control" placeholder="Last Name" required />
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group py-2">
                                    <label for="oname">Other Name</label>
                                    <input id="oname" type="text" class="form-control" placeholder="Other Name" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group py-2">
                                    <label for="gender">* Gender</label>
                                    <select id="gender" class="form-control form-select" required>
                                        <option value="">-- Select gender --</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group py-2">
                                    <label for="email">* Email</label>
                                    <input id="email" type="email" class="form-control" placeholder="Email" required />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group py-2">
                                    <label for="phone">* Phone Number</label>
                                    <input id="phone" type="text" class="form-control" placeholder="Phone Number" required />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group py-2">
                                    <label for="password">* Password</label>
                                    <input id="password" type="password" class="form-control" placeholder="Password" required />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group py-2">
                                    <label for="cpassword">* Confirm Password</label>
                                    <input id="cpassword" type="password" class="form-control" placeholder="Confirm Password" required />
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <hr />
                                <p class="text-end">
                                    <button type="submit" id="submitBtn" class="btn btn-gold px-5 rounded-0"><i class="fa fa-check-circle"></i> Submit</button>
                                </p>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<link href="<?= base_url('d_assets/lib/font-awesome/css/all.css'); ?>" rel="stylesheet" />
<?= $this->endSection() ?>

<?= $this->section('js') ?>
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
<script src="<?= base_url('d_assets/js/utilities.js') ?>"></script>
<script src="<?= base_url('d_assets/js/register.js') ?>"></script>
<?= $this->endSection() ?>