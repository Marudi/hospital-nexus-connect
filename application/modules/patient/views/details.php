<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"> <?php echo lang('details'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"> <?php echo lang('patient'); ?></li>
                                        <li class="breadcrumb-item active"> <?php echo lang('details'); ?></li>
                                        
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <section class="">
            <!-- page start-->
              <link href="common/extranal/css/patient/details.css" rel="stylesheet">
            <div class="row">
                <aside class="profile-nav col-lg-3">
                    <section class="card">
                        <div class="user-heading round row">
                            <a class="col-md-6">
                                <img src="<?php echo $patient->img_url ?>" alt="">
                            </a>
                            <div class="col-md-6">
                            <h1><?php echo $patient->name ?></h1>
                            </div>
                       
                        </div>
                    </section>
                </aside>


                <aside class="profile-info col-lg-9">
                    <section class="card">
                    <div class="card-header table_header" style="background-color: #5A9599;">
                                        <h4 class="card-title mb-0 col-lg-12">  <?php echo lang('doctor'); ?> : <?php echo $this->doctor_model->getDoctorById($patient->doctor)->name; ?></h4> 
                                      
                                    </div>
                        <!-- <div class="bio-graph-heading">
                            <?php echo lang('doctor'); ?> : <?php echo $this->doctor_model->getDoctorById($patient->doctor)->name; ?>
                        </div> -->
                        <div class="bio-graph-info">
                            <h1 style="text-align: center;">Bio Graph</h1>
                            <div class="row">
                                <div class="bio-row">
                                    <p><span><?php echo lang('name'); ?> </span>: <?php echo $patient->name; ?></p>
                                </div>

                                <div class="bio-row">
                                    <p><span><?php echo lang('email'); ?> </span>: <?php echo $patient->email; ?></p>
                                </div>

                                <div class="bio-row">
                                    <p><span><?php echo lang('address'); ?></span>: <?php echo $patient->address; ?></p>
                                </div>
                                <div class="bio-row">
                                    <p><span><?php echo lang('phone'); ?> </span>: <?php echo $patient->phone; ?></p>
                                </div>
                                <div class="bio-row">
                                    <p><span><?php echo lang('sex'); ?> </span>: <?php echo $patient->sex; ?></p>
                                </div>

                                <div class="bio-row">
                                    <p><span><?php echo lang('birth_date'); ?> </span>: <?php echo $patient->birthdate; ?></p>
                                </div>
                                <div class="bio-row">
                                    <p><span><?php echo lang('blood_group'); ?> </span>: <?php echo $patient->bloodgroup; ?></p>
                                </div>
                                <div class="bio-row">
                                    <p><span><?php echo lang('age'); ?></span>: 
                                        <?php
                                        $birthDate = strtotime($patient->birthdate);
                                        $birthDate = date('m/d/Y', $birthDate);
                                        $birthDate = explode("/", $birthDate);
                                        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y") - $birthDate[2]) - 1) : (date("Y") - $birthDate[2]));
                                        echo $age . ' Year(s)';
                                        ?>
                                    </p>
                                </div>

                                <div class="bio-row">
                                    <p>
                                        <span><?php echo lang('doctor'); ?> </span>:
                                        <?php
                                        echo $this->doctor_model->getDoctorById($patient->doctor)->name;
                                        ?>
                                    </p>
                                </div>
                                <div class="bio-row">
                                    <p><span><?php echo lang('patient_id'); ?> </span>: <?php echo $patient->id; ?></p>
                                </div>
                            </div>
                        </div>
                    </section>
                </aside>
            </div>
        </section>
        <!-- page end-->
    </div>
</div>
</div>
<!--main content end-->
<!--footer start-->
