<!--sidebar end-->
<!--main content start-->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0"><i class="fas fa-envelope mr-2"></i> FAQs</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a
                                        href="javascript: void(0);"><?php echo lang('home') ?>></a></li>
                                <li class="breadcrumb-item active">FAQs</li>


                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- page start-->
            <section class="card">
                <div class="card-header table_header">

                    <h4 class="card-title mb-0 col-lg-8">FAQs</h4>
                    <div class="col-lg-4 no-print pull-right">
                        <button type="button" class="btn btn-primary waves-effect waves-light w-xs"
                            data-bs-toggle="modal" data-bs-target="#myModal"> <i class="fa fa-plus-circle"></i> Add
                            FAQ</button>
                    </div>




                </div>

                <div class="card-body">
                    <div class="table-responsive adv-table">
                        <table class="table mb-0" id="editable-sample">
                            <thead>
                                <tr>
                                    <th>Question</th>
                                    <th>Answer</th>
                                    <th class="no-print"><?php echo lang('options'); ?></th>
                            </thead>
                            <tbody>


                                <?php foreach ($faqs as $faq) { ?>
                                <tr class="">

                                    <td> <?php echo $faq->title; ?></td>
                                    <td><?php echo $faq->description; ?></td>
                                    <td class="no-print d-flex gap-1">
                                        <a type="button" class="btn btn-primary btn-sm btn_width editbutton"
                                            title="<?php echo lang('edit'); ?>" data-toggle="modal"
                                            data-id="<?php echo $faq->id; ?>"><i class="fa fa-edit"> </i></a>
                                        <a class="btn btn-danger btn-sm btn_width delete_button"
                                            title="<?php echo lang('delete'); ?>"
                                            href="faq/delete?id=<?php echo $faq->id; ?>"
                                            onclick="return confirm('Are you sure you want to delete this item?');"><i
                                                class="fa fa-trash"> </i></a>
                                    </td>
                                </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <!-- page end-->
        </div>
    </div>
</div>
<!--main content end-->
<!--footer start-->





<!-- Add Faq Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> Add FAQ</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form role="form" action="faq/addNew" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="">
                        <div class="form-group">
                            <label for="exampleInputEmail1"> Question &ast;</label>
                            <input type="text" class="form-control form-control-lg" name="title" value='' required="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> Answer &ast;</label>
                            <input type="text" class="form-control form-control-lg" name="description" value=''
                                placeholder="" required="">
                        </div>


                        <div class="form-group">
                            <button type="submit" name="submit"
                                class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Faq Modal-->







<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> Edit FAQ</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form role="form" id="editFaqForm" class="clearfix" action="faq/addNew" method="post"
                    enctype="multipart/form-data">
                    <div class="">
                        <div class="form-group">
                            <label for="exampleInputEmail1"> Question &ast;</label>
                            <input type="text" class="form-control form-control-lg" name="title" value='' required="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> Answer &ast;</label>
                            <input type="text" class="form-control form-control-lg" name="description" value=''
                                placeholder="" required="">
                        </div>

                        <input type="hidden" name="id" value=''>

                        <div class="form-group">
                            <button type="submit" name="submit"
                                class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
                        </div>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
var language = "<?php echo $this->language; ?>";
</script>
<script src="common/extranal/js/faq.js"></script>