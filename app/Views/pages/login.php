<?= $this->extend("components/layout") ?>

<?= $this->section("auth") ?>

<div class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <!-- <div class="card-header">
                                </div> -->
                                <div class="card-body">
                                    <h3 class="text-center font-weight-light my-4">Aplic Dashboard</h3>
                                    <form id="login-form">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="user_name" name="user_name" type="text" />
                                            <label for="inputEmail">Username</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="user_password" name="user_password" type="password" placeholder="Password" />
                                            <label for="inputPassword">Password</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                            <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="<?= base_url('forget') ?>">Forgot Password?</a>
                                            <button type="submit" class="btn btn-primary" id="form-btn">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="<?= base_url('assets/js/jquery-3.6.0.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url('assets/js/sweetalert2.all.min.js') ?>"></script>
    <script>
        $("#login-form").on("submit", function(e) {
            event.preventDefault();
            var form = $('#login-form');
            $.ajax({
                url: '<?= base_url() . "/login" ?>',
                type: 'post',
                data: form.serialize(),
                dataType: 'json',
                beforeSend: function() {
                    $('#form-btn').prop('disabled', true);
                    $('#form-btn').html('<i class="fa fa-spinner fa-spin"></i>');
                },
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
                            $('#form-btn').html('Login');
                            $('#form-btn').prop('disabled', false);
                            window.location = "<?= base_url() ?>";
                        })
                    } else {
                        Swal.fire({
                            toast: true,
                            position: 'center',
                            icon: 'error',
                            title: response.messages,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            $('#form-btn').html('Login');
                            $('#form-btn').prop('disabled', false);
                        })
                    }
                }
            });
        });
    </script>
</div>
<?= $this->endSection(); ?>