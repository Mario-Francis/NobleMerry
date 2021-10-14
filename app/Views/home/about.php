<?= $this->extend('shared/home_layout') ?>

<?= $this->section('body') ?>
<div class="page-title-area bg-1">
    <div class="container">
        <div class="page-title-content">
            <h2>About Us</h2>
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
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="about-area-content">
                    <span class="text-gold">About Our History</span>
                    <h3>About Noble Merry Ventures</h3>
                    <p class="text-gold">Noble Merry Ventures is an investment company that offers low risk investment opportunities to individuals in order promote wealth sharing and financial stability accross the nation.</p>
                </div>
                <div class="about-tab">
                    <div class="tab about-list-tab">
                        <ul class="tabs">
                            <li>
                                <a href="#">
                                    <i class="flaticon-goal"></i>
                                    Our Mission
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="flaticon-goal-1"></i>
                                    Our Vision
                                </a>
                            </li>
                        </ul>
                        <div class="tab_content">
                            <div class="tabs_item">
                                <div class="text">
                                    <p>Our mission is to make sure that every family across the federation of Nigeria has at least one member of their family who is a beneficiary of the NOBLE MERRY VENTURES project, that way lives and families will be touched positively and massively.</p>
                                </div>
                                <!-- <ul class="list">
                                        <li>
                                            <i class="flaticon-right"></i>
                                            Respect for all people
                                        </li>
                                        <li>
                                            <i class="flaticon-right"></i>
                                            Excellence in everything we do
                                        </li>
                                        <li>
                                            <i class="flaticon-right"></i>
                                            Truthfulness in our business
                                        </li>
                                        <li>
                                            <i class="flaticon-right"></i>
                                            Unquestionable integrity
                                        </li>
                                    </ul> -->
                            </div>
                            <div class="tabs_item">
                                <div class="text">
                                    <p>Our vision is to be among the top 5 investment company in Nigeria that provide investment opportunities to individuals in the middle/loweer class both in rural and urban areas of the nation. We envision a society where individuals can easily</p>
                                </div>
                                <ul class="list">
                                    <li>
                                        <i class="flaticon-right"></i>
                                        Cater for their day-to-day meals
                                    </li>
                                    <li>
                                        <i class="flaticon-right"></i>
                                        Access project/business financing
                                    </li>
                                    <li>
                                        <i class="flaticon-right"></i>
                                        Save money, invest and grow wealth
                                    </li>
                                    <!-- <li>
                                            <i class="flaticon-right"></i>
                                            Unquestionable integrity
                                        </li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-image">
                    <img src="<?= base_url('assets/img/custom/beneficiary.jpeg'); ?>" alt="image">
                    <div class="image-content bg-gold">
                        <h3>7+ Years</h3>
                        <p>In our years of experience in the investment industry, we have come accross different business fluctuation and hence tailored our strategy to minimal risk.
                        </p>
                        <!-- <a href="#" class="learn-more">
                                Learn More
                                <i class="flaticon-curve-arrow-1"></i>
                            </a> -->
                        <div class="dot"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row my-4">
            <div class="col-12">
                <p>
                    WE are duly registered with the Cooperate Affairs Commission of Nigeria (CAC) with our office address located at No 11 Enoma street Ago Palace way Okota Isolo Lagos Nigeria, presently we have members spread across almost all states of Nigeria and even in abroad such as United States of America and the United Arab Emirates and we hope to spread to other countries in no distance time.
                </p>
                <p>
                    We are into diverse kinds of businesses such as Agricultural food storage, production and packaging, international partnership with crypto based businesses, forex trading, shares, entrepreneural business skills workshop trainings, lands and properties, loans and projects partnership, we hope to expand our scope of investment as time goes on.
                </p>
                <h5 class="mt-4">Benefits of Patnering With Us</h5>
                <ul>
                    <li>
                        Financial Stability
                    </li>
                    <li>
                        Food on your table
                    </li>
                    <li>
                        Flexible referal benefit structures
                    </li>
                    <li>
                        Easy access to project capital financing
                    </li>
                    <li>
                        Good saving culture
                    </li>
                    <li>Settlement Fast track</li>
                    <li>Awards and Giveaway</li>
                </ul>
                <hr />
                <a href="#" class="default-btn hover-light-btn">
                    How it works
                </a>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>