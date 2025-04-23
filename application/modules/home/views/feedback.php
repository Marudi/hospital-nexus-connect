<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/main.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/custom.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/scripts/responsive.dataTables.min.css'); ?>">
<div style="margin:100px">
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <a href="<?php echo site_url('admin'); ?>">
                    <i class="pe-7s-home icon-gradient bg-mean-fruit"></i>
                </a>
            </div>
            <div>
            Feedback Management Platform Dashboard
                <div class="page-title-subheading">
                    <nav class="" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

    </div>
</div>


<div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header"><strong>Category</strong></div>
                            <div class="card-body">
                                <form action="https://idea.themesic.com/admin/category/store" method="post"
                                    accept-charset="utf-8">
                                    <input type="hidden" name="csrf_test_name" value="0a3d2de384ebae0a7bb833b609830704">
                                    <div class="tab-content rounded-bottom">
                                        <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-237"
                                            style="width: 100%; overflow: hidden;">
                                            <div class="mb-3">
                                                <label class="form-label">Title</label>
                                                <input class="form-control " type="text" name="title"
                                                    placeholder="Category Title" value="">
                                                <div class="invalid-feedback">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Description</label>
                                                <input class="form-control " type="text" name="description"
                                                    placeholder="Category Description" value="">
                                                <div class="invalid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-3">
                                            <button type="submit"
                                                class="mb-2 me-2 btn btn-shadow btn-primary">Save</button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
</div>

                    <script type="text/javascript" src="<?php echo base_url('assets/scripts/toastr.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('/assets/main.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/scripts/jquery.dataTables.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/scripts/dataTables.bootstrap4.min.js'); ?>">
    </script>
    <script type="text/javascript" src="<?php echo base_url('assets/scripts/dataTables.responsive.min.js'); ?>">
    </script>
    <script type="text/javascript" src="<?php echo base_url('assets/scripts/custom.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/highcharts/highcharts.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/highcharts/variable-pie.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/highcharts/export-data.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/highcharts/accessibility.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/highcharts/exporting.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/highcharts/highcharts-3d.js'); ?>"></script>