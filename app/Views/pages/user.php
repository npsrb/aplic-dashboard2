<?= $this->extend("components/layout") ?>

<?= $this->section("content") ?>

<h1 class="mt-4"><?= $title; ?></h1>
<ol class="breadcrumb mb-4">
  <li class="breadcrumb-item active"><?= $title; ?></li>
</ol>


<div class="card">
  <div class="card-header">
    <div class="row">
      <div class="col-lg-6 mt-2">
        <h5 class="card-title">Table user</h5>
      </div>
      <div class="col-lg-6">
        <button type="button" class="btn btn-dark" onclick="save()" title="<?= lang("App.new") ?>" style="float: right;"><i class="fa fa-plus"></i> <?= lang('App.new') ?></button>
      </div>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="data_table" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Number</th>
          <th>User name</th>
          <th>User email</th>
          <th>User password</th>
          <th>User date</th>
          <th>User phone</th>
          <th>User address</th>
          <th>User type</th>
          <th>User status</th>

          <th></th>
        </tr>
      </thead>
    </table>
  </div>
</div>

<div id="data-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md">
    <div class="modal-content">
      <div class="text-center bg-info p-3" id="model-header">
        <h4 class="modal-title text-white" id="info-header-modalLabel"></h4>
      </div>
      <div class="modal-body">
        <form id="data-form" class="pl-3 pr-3">
          <div class="row">
            <input type="hidden" id="user_id" name="user_id" class="form-control" placeholder="User id" maxlength="45" required>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="user_name" class="col-form-label"> User name: <span class="text-danger">*</span> </label>
                <input type="text" id="user_name" name="user_name" class="form-control" placeholder="User name" minlength="0" maxlength="45" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="user_email" class="col-form-label"> User email: <span class="text-danger">*</span> </label>
                <input type="email" id="user_email" name="user_email" class="form-control" placeholder="User email" minlength="0" maxlength="45" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="user_password" class="col-form-label"> User password: <span class="text-danger">*</span> </label>
                <input type="password" id="user_password" name="user_password" class="form-control" placeholder="User password" minlength="0" maxlength="45" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="user_date" class="col-form-label"> User date: <span class="text-danger">*</span> </label>
                <input type="date" id="user_date" name="user_date" class="form-control" dateISO="true" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="user_phone" class="col-form-label"> User phone: <span class="text-danger">*</span> </label>
                <input type="text" id="user_phone" name="user_phone" class="form-control" placeholder="User phone" minlength="0" maxlength="45" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="user_address" class="col-form-label"> User address: <span class="text-danger">*</span> </label>
                <textarea cols="40" rows="5" id="user_address" name="user_address" class="form-control" placeholder="User address" minlength="0" required></textarea>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="user_type" class="col-form-label"> User type: <span class="text-danger">*</span> </label>
                <input type="text" id="user_type" name="user_type" class="form-control" placeholder="User type" minlength="0" maxlength="45" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="user_status" class="col-form-label"> User status: <span class="text-danger">*</span> </label>
                <input type="text" id="user_status" name="user_status" class="form-control" placeholder="User status" minlength="0" maxlength="45" required>
              </div>
            </div>
          </div>

          <div class="form-group text-center">
            <div class="btn-group">
              <button type="submit" class="btn btn-success mr-2" id="form-btn" style="margin-right:5px;"><?= lang("App.save") ?></button>
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><?= lang("App.cancel") ?></button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>



<?= $this->section("script") ?>
<script>
  function save(user_id) {
    // reset the form 
    $("#data-form")[0].reset();
    $(".form-control").removeClass('is-invalid').removeClass('is-valid');
    if (typeof user_id === 'undefined' || user_id < 1) { //add
      urlController = '<?= base_url($controller . "/add") ?>';
      submitText = '<?= lang("App.save") ?>';
      $('#model-header').removeClass('bg-info').addClass('bg-success');
      $("#info-header-modalLabel").text('<?= lang("App.add") ?>');
      $("#form-btn").text(submitText);
      $('#data-modal').modal('show');
    } else { //edit
      urlController = '<?= base_url($controller . "/edit") ?>';
      submitText = '<?= lang("App.update") ?>';
      $.ajax({
        url: '<?php echo base_url($controller . "/getone") ?>',
        type: 'post',
        data: {
          user_id: user_id
        },
        dataType: 'json',
        success: function(response) {
          console.log(response);
          $('#model-header').removeClass('bg-success').addClass('bg-info');
          $("#info-header-modalLabel").text('<?= lang("App.edit") ?>');
          $("#form-btn").text(submitText);
          $('#data-modal').modal('show');
          //insert data to form
          $("#data-form #user_id").val(response.user_id);
          $("#data-form #user_name").val(response.user_name);
          $("#data-form #user_email").val(response.user_email);
          $("#data-form #user_password").val(response.user_password);
          $("#data-form #user_date").val(response.user_date);
          $("#data-form #user_phone").val(response.user_phone);
          $("#data-form #user_address").val(response.user_address);
          $("#data-form #user_type").val(response.user_type);
          $("#data-form #user_status").val(response.user_status);

        }
      });
    }
    $.validator.setDefaults({
      highlight: function(element) {
        $(element).addClass('is-invalid').removeClass('is-valid');
      },
      unhighlight: function(element) {
        $(element).removeClass('is-invalid').addClass('is-valid');
      },
      errorElement: 'div ',
      errorClass: 'invalid-feedback',
      errorPlacement: function(error, element) {
        if (element.parent('.input-group').length) {
          error.insertAfter(element.parent());
        } else if ($(element).is('.select')) {
          element.next().after(error);
        } else if (element.hasClass('select2')) {
          //error.insertAfter(element);
          error.insertAfter(element.next());
        } else if (element.hasClass('selectpicker')) {
          error.insertAfter(element.next());
        } else {
          error.insertAfter(element);
        }
      },
      submitHandler: function(form) {
        var form = $('#data-form');
        $(".text-danger").remove();
        $.ajax({
          // fixBug get url from global function only
          // get global variable is bug!
          url: getUrl(),
          type: 'post',
          data: form.serialize(),
          cache: false,
          dataType: 'json',
          beforeSend: function() {
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
                $('#data_table').DataTable().ajax.reload(null, false).draw(false);
                $('#data-modal').modal('hide');
              })
            } else {
              if (response.messages instanceof Object) {
                $.each(response.messages, function(index, value) {
                  var ele = $("#" + index);
                  ele.closest('.form-control')
                    .removeClass('is-invalid')
                    .removeClass('is-valid')
                    .addClass(value.length > 0 ? 'is-invalid' : 'is-valid');
                  ele.after('<div class="invalid-feedback">' + response.messages[index] + '</div>');
                });
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
            $('#form-btn').html(getSubmitText());
          }
        });
        return false;
      }
    });

    $('#data-form').validate({

      //insert data-form to database

    });
  }
</script>


<?= $this->endSection() ?>