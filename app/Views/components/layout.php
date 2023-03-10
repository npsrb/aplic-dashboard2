<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>
<!-- login -->
<!-- dashboard -->
<?php if (strtolower($controller) !== "auth") { ?>

    <body class="sb-nav-fixed">
        <?= $this->include('components/top_navbar'); ?>
        <div id="layoutSidenav">
            <?= $this->include('components/side_navbar'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <?= $this->renderSection('content'); ?>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script src="js/scripts.js"></script>

        <!-- required script auto CRUD -->
        <script src="<?= base_url('assets/js/jquery-3.6.0.min.js') ?>"></script>
        <script src="<?= base_url('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>"></script>
        <script src=" <?= base_url('assets/js/adminlte.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/bootstrap4-toggle.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/sweetalert2.all.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/jquery.validate.min.js') ?>"></script>
        <script src="<?= base_url("assets/plugins/datatables/DataTables-1.11.3/js/jquery.dataTables.min.js"); ?>" type="text/javascript"></script>
        <script src="<?= base_url("assets/plugins/datatables/DataTables-1.11.3/js/dataTables.bootstrap5.min.js"); ?>" type="text/javascript"></script>
        <script src="<?= base_url("assets/plugins/datatables/Buttons-2.0.1/js/dataTables.buttons.min.js"); ?>" type="text/javascript"></script>
        <script src="<?= base_url("assets/plugins/datatables/JSZip-2.5.0/jszip.min.js"); ?>" type="text/javascript"></script>
        <script src="<?= base_url("assets/plugins/datatables/Buttons-2.0.1/js/buttons.print.min.js"); ?>" type="text/javascript"></script>
        <script src="<?= base_url("assets/plugins/datatables/Buttons-2.0.1/js/buttons.html5.min.js"); ?>" type="text/javascript"></script>
        <script src="<?= base_url("assets/plugins/datatables/Responsive-2.2.9/js/dataTables.responsive.min.js"); ?>" type="text/javascript"></script>
        <script src="<?= base_url("assets/plugins/datatables/Responsive-2.2.9/js/responsive.bootstrap5.min.js"); ?>" type="text/javascript"></script>
        <!-- end required script -->
        <style>
            #data_table_filter {
                float: right;
            }

            #data_table_wrapper>div:nth-child(2) {
                margin-top: 20px !important;
            }
        </style>
        <script>
            // dataTables
            $(function() {
                var table = $('#data_table').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "scrollCollapse": false,
                    "responsive": true,
                    "ajax": {
                        "url": '<?php echo base_url($controller . "/getall") ?>',
                        "type": "POST",
                        "dataType": "json",
                        async: "true"
                    }
                });
            });

            var urlController = '';
            var submitText = '';

            function getUrl() {
                return urlController;
            }

            function getSubmitText() {
                return submitText;
            }

            function remove(params) {
                Swal.fire({
                    title: "<?= lang("App.remove-title") ?>",
                    text: "<?= lang("App.remove-text") ?>",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '<?= lang("App.confirm") ?>',
                    cancelButtonText: '<?= lang("App.cancel") ?>'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: '<?php echo base_url($controller . "/remove") ?>',
                            type: 'post',
                            data: {
                                params: params
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.success === true) {
                                    Swal.fire({
                                        toast: true,
                                        position: 'center',
                                        icon: 'success',
                                        title: response.messages,
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then(function() {
                                        $('#data_table').DataTable().ajax.reload(null, false).draw(false);
                                    })
                                } else {
                                    Swal.fire({
                                        toast: false,
                                        position: 'center',
                                        icon: 'error',
                                        title: response.messages,
                                        showConfirmButton: false,
                                        timer: 3000
                                    })
                                }
                            }
                        });
                    }
                })
            }
        </script>

        <?= $this->renderSection('script'); ?>
    </body>
<?php } else { ?>
    <?= $this->renderSection('auth'); ?>
<?php } ?>

</html>