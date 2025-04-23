<footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <?php echo date('Y'); ?> &copy; <?php echo $this->db->get('settings')->row()->footer_message; ?>
                            </div>
                            <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block text-danger">
                                    <!-- Crafted with <i class="mdi mdi-heart text-danger"></i> by -->
                                    <u><b><i class="fas fa-hands-helping"></i> <a href="files/dev/USER GUIDE FOR KLINICX.pdf" target="_blank" class="text-reset">User Guide</a></b> </u>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                   
                </footer>
  <!-- </div> -->
  </div>

  <?php
  
  $user=$this->ion_auth->get_user_id();
  $color_top=  $this->db->get_where('users',array('id'=>$user))->row()->color; ?>
    <!-- Right Sidebar -->
    <a href="settings" class="right-bar-toggle layout-setting-btn no-print" id="right-bar-toggle">
            <i class="icon-sm mb-2" data-feather="settings"></i> <span class="align-middle">Settings</span>
        </a>

         <div class="right-bar" style="display: none !important;">
            <div data-simplebar class="h-100">
                <div class="rightbar-title d-flex align-items-center bg-primary p-3">

                    <h5 class="m-0 me-2 text-white">Settings</h5>

                    <a href="javascript:void(0);" class="right-bar-toggle-close ms-auto">
                        <i class="mdi mdi-close noti-icon"></i>
                    </a>
                </div>

                <!-- Settings -->
                <hr class="m-0" />

                <div class="p-4">
                    <h6 class="mb-3">Choose Layout</h6>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout"
                            id="layout-vertical" value="vertical">
                        <label class="form-check-label" for="layout-vertical">Vertical</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout"
                            id="layout-horizontal" value="horizontal">
                        <label class="form-check-label" for="layout-horizontal">Horizontal</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Theme Mode</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-mode"
                            id="layout-mode-light" value="light" <?php if ($color_top=='light'){ echo 'checked';}?>>
                        <label class="form-check-label" for="layout-mode-light">Light</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-mode"
                            id="layout-mode-dark" value="dark"  <?php if ($color_top=='dark'){ echo 'checked';}?>>
                        <label class="form-check-label" for="layout-mode-dark">Dark</label>
                    </div>

                    <h6 class="mt-4 mb-3">Layout Width</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-width"
                            id="layout-width-fluid" value="fluid" onchange="document.body.setAttribute('data-layout-size', 'fluid')">
                        <label class="form-check-label" for="layout-width-fluid">Fluid</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-width"
                            id="layout-width-boxed" value="boxed" onchange="document.body.setAttribute('data-layout-size', 'boxed')">
                        <label class="form-check-label" for="layout-width-boxed">Boxed</label>
                    </div>

                    <h6 class="mt-4 mb-3">Layout Position</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-position"
                            id="layout-position-fixed" value="fixed" onchange="document.body.setAttribute('data-layout-scrollable', 'false')">
                        <label class="form-check-label" for="layout-position-fixed">Fixed</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-position"
                            id="layout-position-scrollable" value="scrollable" onchange="document.body.setAttribute('data-layout-scrollable', 'true')">
                        <label class="form-check-label" for="layout-position-scrollable">Scrollable</label>
                    </div>

                    <h6 class="mt-4 mb-3">Topbar Color</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="topbar-color"
                            id="topbar-color-light" value="light" onchange="document.body.setAttribute('data-topbar', 'light')">
                        <label class="form-check-label" for="topbar-color-light">Light</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="topbar-color"
                            id="topbar-color-dark" value="dark" onchange="document.body.setAttribute('data-topbar', 'dark')">
                        <label class="form-check-label" for="topbar-color-dark">Dark</label>
                    </div>

                    <div id="sidebar-setting">
                        <h6 class="mt-4 mb-3 sidebar-setting">Sidebar Size</h6>

                        <div class="form-check sidebar-setting">
                            <input class="form-check-input" type="radio" name="sidebar-size"
                                id="sidebar-size-default" value="default" onchange="document.body.setAttribute('data-sidebar-size', 'lg')">
                            <label class="form-check-label" for="sidebar-size-default">Default</label>
                        </div>
                        <div class="form-check sidebar-setting">
                            <input class="form-check-input" type="radio" name="sidebar-size"
                                id="sidebar-size-compact" value="compact" onchange="document.body.setAttribute('data-sidebar-size', 'md')">
                            <label class="form-check-label" for="sidebar-size-compact">Compact</label>
                        </div>
                        <div class="form-check sidebar-setting">
                            <input class="form-check-input" type="radio" name="sidebar-size"
                                id="sidebar-size-small" value="small" onchange="document.body.setAttribute('data-sidebar-size', 'sm')">
                            <label class="form-check-label" for="sidebar-size-small">Small (Icon View)</label>
                        </div>

                        <h6 class="mt-4 mb-3 sidebar-setting">Sidebar Color</h6>

                        <div class="form-check sidebar-setting">
                            <input class="form-check-input" type="radio" name="sidebar-color"
                                id="sidebar-color-light" value="light" onchange="document.body.setAttribute('data-sidebar', 'light')">
                            <label class="form-check-label" for="sidebar-color-light">Light</label>
                        </div>
                        <div class="form-check sidebar-setting">
                            <input class="form-check-input" type="radio" name="sidebar-color"
                                id="sidebar-color-dark" value="dark" onchange="document.body.setAttribute('data-sidebar', 'dark')">
                            <label class="form-check-label" for="sidebar-color-dark">Dark</label>
                        </div>
                        <div class="form-check sidebar-setting">
                            <input class="form-check-input" type="radio" name="sidebar-color"
                                id="sidebar-color-brand" value="brand" onchange="document.body.setAttribute('data-sidebar', 'brand')">
                            <label class="form-check-label" for="sidebar-color-brand">Brand</label>
                        </div>
                    </div>

                    <h6 class="mt-4 mb-3">Direction</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-direction"
                            id="layout-direction-ltr" value="ltr">
                        <label class="form-check-label" for="layout-direction-ltr">LTR</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-direction"
                            id="layout-direction-rtl" value="rtl">
                        <label class="form-check-label" for="layout-direction-rtl">RTL</label>
                    </div>
                </div>

            </div> 
        </div> 
      
        <div class="rightbar-overlay"></div>

      

    </body>
</html>



<script src="common/js/jquery.js"></script>
<script src="common/js/bootstrap.min.js"></script>
<script src="common/js/jquery.scrollTo.min.js"></script>

<script src="common/js/moment.min.js"></script>
<script  type="text/javascript" src="common/assets/DataTables/pdfmake.min.js"></script>
<script  type="text/javascript" src="common/assets/DataTables/vfs_fonts.js"></script>
<script  type="text/javascript" src="common/assets/DataTables/datatables.min.js"></script>


<script src="common/js/respond.min.js" ></script>
<script type="text/javascript" src="common/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="common/assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="common/assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>


<script type="text/javascript" src="common/assets/jquery-multi-select/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="common/assets/jquery-multi-select/js/jquery.quicksearch.js"></script>
<script type="text/javascript" src="common/assets/ckeditor/build/ckeditor.js"></script>
<!-- <script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/decoupled-document/ckeditor.js"></script> 
<script src="https://cdn.ckeditor.com/ckeditor5/12.3.1/classic/ckeditor.js"></script>-->
<!-- <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script> -->
<script type="text/javascript" src="common/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>

<script type="text/javascript" src="common/assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script src="common/js/advanced-form-components.js"></script>
<script src="common/js/jquery.cookie.js"></script>
<!--common script for all pages--> 
<!-- <script src="common/js/jquery.nicescroll.js" type="text/javascript"></script> -->
<script src="common/js/common-scripts.js"></script>
<script src="common/js/lightbox.js"></script>
<script class="include" type="text/javascript" src="common/js/jquery.dcjqaccordion.2.7.js"></script>
<!--script for this page only-->
<script src="common/js/editable-table.js"></script>

<script src="common/assets/fullcalendar/fullcalendar.js"></script>

<script type="text/javascript" src="common/assets/bootstrap-fileupload/bootstrap-fileupload.js"></script>
<script type="text/javascript" src="common/assets/select2/js/select2.min.js"></script>
<script src="common/js/bootstrap-select.min.js"></script>
<script src="common/js/bootstrap-select-country.min.js"></script>
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js"></script>

<?php $this->load->view('home/footer_extended'); ?>

<?php
$language = $this->language;


if ($language == 'english') {
    $lang = 'en-ca';
    $langdate = 'en-CA';
} elseif ($language == 'spanish') {
    $lang = 'es';
    $langdate = 'es';
} elseif ($language == 'french') {
    $lang = 'fr';
    $langdate = 'fr';
} elseif ($language == 'portuguese') {
    $lang = 'pt';
    $langdate = 'pt';
} elseif ($language == 'arabic') {
    $lang = 'ar';
    $langdate = 'ar';
} elseif ($language == 'italian') {
    $lang = 'it';
    $langdate = 'it';
} elseif ($language == 'zh_cn') {
    $lang = 'zh-cn';
    $langdate = 'zh-CN';
} elseif ($language == 'japanese') {
    $lang = 'ja';
    $langdate = 'ja';
} elseif ($language == 'russian') {
    $lang = 'ru';
    $langdate = 'ru';
} elseif ($language == 'turkish') {
    $lang = 'tr';
    $langdate = 'tr';
} elseif ($language == 'indonesian') {
    $lang = 'id';
    $langdate = 'id';
}


?>

 <!-- JAVASCRIPT -->
 <script src="public/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="public/assets/libs/metismenujs/metismenujs.min.js"></script>
        <script src="public/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="public/assets/libs/feather-icons/feather.min.js"></script>

        <!-- apexcharts -->
        <!-- <script src="public/assets/libs/apexcharts/apexcharts.min.js"></script> -->
        <!-- Chart JS -->
        <script src="public/assets/js/pages/chartjs.js"></script>

        <!-- <script src="public/assets/js/pages/dashboard.init.js"></script> -->
        <script type="text/javascript">var color_topbar = "<?php echo $color_top; ?>";</script>

        <script src="public/assets/js/app.js"></script>
        <script src="common/extranal/toast.js"></script>
<script src='common/assets/fullcalendar/locale/<?php echo $lang; ?>.js'></script>
<script type="text/javascript" src="common/assets/select2/js/select2.min.js"></script>
<!-- <script src="public/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script> -->
        <script src="public/assets/libs/metismenujs/metismenujs.min.js"></script>
<script type="text/javascript">
        var langdate = "<?php echo $langdate; ?>";
        $(document).ready(function() {
            $('.readonly').keydown(function(e) {
                e.preventDefault();
            });
            $('.vertical-menu-btn').on('click',function(){
                if($('body').hasClass('sidebar-enable')){
                    $('.position-relative').css({"padding-top":"20px"})
                }else{
                    $('.position-relative').css({"padding-top":""})
                }
            });
           
        });
</script>
 <!-- apexcharts -->
 <script src="public/assets/libs/apexcharts/apexcharts.min.js"></script>
<script src="common/extranal/js/footer.js"></script>
<script type="text/javascript">
     <?php  $message = $this->session->flashdata('feedback');
             if (!empty($message)) { ?>
                $(document).ready(function() {
                    toastr.info("<?php echo $message; ?>");
                });
                <?php     }

// unsel feedback value 
                $this->session->unset_userdata('feedback'); 
        ?>
    </script>

</body>
</html>
<?php if ($this->ion_auth->in_group(array('admin'))) { ?>
<script src="public/assets/libs/metismenujs/metismenujs.min.js"></script>
        <script src="public/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="public/assets/libs/feather-icons/feather.min.js"></script>

        <!-- apexcharts
        <script src="public/assets/libs/apexcharts/apexcharts.min.js"></script> -->
        <!-- Chart JS -->
        <script src="public/assets/js/pages/chartjs.js"></script>

        <!-- <script src="public/assets/js/pages/dashboard.init.js"></script> -->
       
        <?php } ?>
      

<script>
    $(document).ready(function() {
     if  (color_topbar==='light'||color_topbar==="") {
    
    document.body.setAttribute("data-layout-mode", "light");
    document.body.setAttribute("data-topbar", "light");
    document.body.setAttribute("data-sidebar", "dark");
    body.hasAttribute("data-layout") &&
      body.getAttribute("data-layout") == "horizontal" ?
      document.body.removeAttribute("data-sidebar") : "";
    updateRadio("topbar-color-light");
    updateRadio("sidebar-color-dark");
  } else {
    
    document.body.setAttribute("data-layout-mode", "dark");
    document.body.setAttribute("data-topbar", "dark");
    document.body.setAttribute("data-sidebar", "dark");
    body.hasAttribute("data-layout") &&
      body.getAttribute("data-layout") == "horizontal" ?
      "" :

    updateRadio("topbar-color-dark");
    updateRadio("sidebar-color-dark");
  }
});
    </script>

         