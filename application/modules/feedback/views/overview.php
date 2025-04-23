<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/main.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/custom.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/scripts/responsive.dataTables.min.css'); ?>">
<div class="main-content">
<div class="page-content">
<style>
    .dropdown-menu {
    background-color: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 0.25rem;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    min-width: 10rem !important;
}
</style>
    <div class="container-fluid">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <a href="#">
                        <i class="pe-7s-home icon-gradient bg-mean-fruit"></i>
                    </a>
                </div>
                <div>
                    Feedback Management Dashboard
                    <div class="page-title-subheading">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <!-- Breadcrumb items can be added here -->
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="feedback/overview" id="chart_filter_frm" method="post" accept-charset="utf-8">
        <div class="form-group mb-3">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" class="form-control" name="daterange" id="from_date" value="<?php echo set_value('daterange', $daterange); ?>">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="mb-2 me-2 btn btn-shadow btn-primary w-100">Filter</button>
                </div>
            </div>
        </div>
    </form>
    <div class="mb-3 card form-group">
        <div class="tabs-lg-alternate card-header">
            <ul class="nav nav-justified">
                <li class="nav-item">
                    <a href="feedback" target="_blank" class="nav-link minimal-tab-btn-1">
                        <div class="widget-number text-info">
                            <span class="pe-2 opactiy-6">
                                <i class="fa fa-users"></i>
                            </span>
                            <span id="span_total_user"><?php echo $total_feedback; ?></span>
                        </div>
                        <div class="tab-subheading">Total Feedback </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="feedback" target="_blank" class="nav-link minimal-tab-btn-2">
                        <div class="widget-number">
                            <span class="pe-2 text-success">
                                <i class="fa fa-comments"></i>
                            </span>
                            <span id="span_total_comments"><?php echo $feedback_id2; ?></span>
                        </div>
                        <div class="tab-subheading"><?php echo $this->roadmap_model->getRoadmapById(2)->title; ?> Feedback</div>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="feedback" target="_blank" class="nav-link minimal-tab-btn-3">
                        <div class="widget-number text-danger">
                            <span class="pe-2 opactiy-6">
                                <i class="fa fa-bullhorn"></i>
                            </span>
                            <span id="span_total_roadmap"><?php echo $feedback_id4; ?></span>
                        </div>
                        <div class="tab-subheading"><?php echo $this->roadmap_model->getRoadmapById(4)->title; ?> Feedback</div>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="feedback" target="_blank" class="nav-link minimal-tab-btn-4">
                        <div class="widget-number text-warning">
                            <span class="pe-2 opactiy-6">
                                <i class="fa fa-puzzle-piece"></i>
                            </span>
                            <span id="span_total_feedbacks"><?php echo $feedback_id5; ?></span>
                        </div>
                        <div class="tab-subheading"><?php echo $this->roadmap_model->getRoadmapById(5)->title; ?> Feedback</div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="tab-minimal-0">
                <div class="card-body">
                    <figure class="highcharts-figure">
                        <div id="total_user_chart" data-highcharts-chart="0" role="region"
                            aria-label="Feature Request Chart. Highcharts interactive chart." aria-hidden="false"
                            style="overflow: hidden;">
                            <!-- Highcharts chart content -->
                        </div>
                        <p class="highcharts-description highcharts-linked-description" aria-hidden="true"></p>
                    </figure>
                    <figure class="highcharts-figure">
                        <div id="top_ten_charts" data-highcharts-chart="1" role="region"
                            aria-label="Top Ten Feedback Ideas. Highcharts interactive chart." aria-hidden="false"
                            style="overflow: hidden;">
                            <!-- Highcharts chart content -->
                        </div>
                        <p class="highcharts-description highcharts-linked-description" aria-hidden="true"></p>
                    </figure>
                </div>
            </div>
        </div>
    </div>

                        </div></div></div>
<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/scripts/toastr.js'); ?>"></script>
<!-- <script type="text/javascript" src="<?php echo base_url('/assets/main.js'); ?>"></script> -->
<script type="text/javascript" src="<?php echo base_url('assets/scripts/jquery.dataTables.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/scripts/dataTables.bootstrap4.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/scripts/dataTables.responsive.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/scripts/custom.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/highcharts/highcharts.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/highcharts/variable-pie.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/highcharts/export-data.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/highcharts/accessibility.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/highcharts/exporting.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/highcharts/highcharts-3d.js'); ?>"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    Highcharts.chart('total_user_chart', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Feedback Overview'
        },
        xAxis: {
            categories: ['Total Feedback', '<?php echo $this->roadmap_model->getRoadmapById(1)->title; ?> Feedback', '<?php echo $this->roadmap_model->getRoadmapById(2)->title; ?> Feedback', '<?php echo $this->roadmap_model->getRoadmapById(3)->title; ?> Feedback', '<?php echo $this->roadmap_model->getRoadmapById(4)->title; ?> Feedback', '<?php echo $this->roadmap_model->getRoadmapById(5)->title; ?> Feedback']
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total Count'
            }
        },
        series: [{
            name: 'Count',
            data: [
                {y: <?php echo $total_feedback; ?>, color: '#78C3FB'},
                {y: <?php echo $feedback_id1; ?>, color: '#444054'},
                {y: <?php echo $feedback_id2; ?>, color: '#fd7e14'},
                {y: <?php echo $feedback_id3; ?>, color: '#8085E9'}, 
                {y: <?php echo $feedback_id4; ?>, color: '#F15C80'},
                {y: <?php echo $feedback_id5; ?>, color: '#E4D354'}
            ]
        }]
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    Highcharts.chart('top_ten_charts', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Top 10 Feedback Ideas'
        },
        xAxis: {
            categories: [
                <?php foreach ($top_feedback as $feedback) {
                            echo "'" . $feedback->board . "',";
                        } ?>
            ]
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total Count'
            }
        },
        series: [{
            name: 'Count',
            data: [
                <?php 
                $colors = ['#78C3FB', '#444054', '#fd7e14', '#8085E9', '#F15C80', '#E4D354'];
                $i = 0;
                foreach ($top_feedback as $feedback) {
                    echo "{y:" . $feedback->count . ", color:'" . $colors[$i % 6] . "'},";
                    $i++;
                } 
                ?>
            ]
        }]
    });
});
</script>