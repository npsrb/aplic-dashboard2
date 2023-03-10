<?= $this->extend("components/layout") ?>

<?= $this->section("content") ?>

<h1 class="mt-4"><?= $title; ?></h1>
<ol class="breadcrumb mb-4">
  <li class="breadcrumb-item active"><?= $title; ?></li>
</ol>
<?php

//echo session()->user_id;
//echo session()->username;
//echo session()->user_email;
//echo session()->user_password;
//echo session()->user_date;
//echo session()->user_phone;
//echo session()->user_address;
//echo session()->user_type;
//echo session()->user_status;
//echo session()->leaveamount;
//echo session()->position;
//echo session()->lead;
//echo session()->level;
?>
<div class="card">
  <div class="card-header">
    <div class="row">
      <div class="col-lg-6 mt-2">
        <h5 class="card-title">Table request</h5>
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
          <th>Request ID</th>
          <th>Request Name</th>
          <th>Brief Description</th>
          <th>Firstdate</th>
          <th>Seconddate</th>
          <th>File</th>
          <th>Detail</th>
          <th>Action</th>
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
            <input type="hidden" id="request_id" name="request_id" class="form-control" placeholder="Request id" maxlength="20">
          </div>
          <div class="row">
            <input type="hidden" id="user_user_id" name="user_user_id" class="form-control" value="<?php echo session()->user_id;    ?>" maxlength="20">
          </div>
          <div class="row">
            <input type="hidden" id="user_lead" name="user_lead" class="form-control" value="<?php echo session()->lead;    ?>" maxlength="50">
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="request_name" class="col-form-label"> Request Name: <span class="text-danger">*</span> </label>
                <select name="request_name" id="request_name" class="form-control" required>
                  <option value="Annual Leave">Annual Leave</option>
                  <option value="Married(self) Leave">Married(self) Leave</option>
                  <option value="Married(family) Leave">Married(family) Leave</option>
                  <option value="Child Circumsion/Baptism Leave">Child Circumsion/Baptism Leave</option>
                  <option value="Child Birth Leave">Child Birth Leave</option>
                  <option value="Family Mourning Leave">Family Mourning Leave</option>
                  <option value="Natural Disaster Leave">Natural Disaster Leave</option>
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="briefdescription" class="col-form-label"> Brief Description: </label>
                <textarea cols="40" rows="5" id="briefdescription" name="briefdescription" class="form-control" placeholder="Brief Description" minlength="0"></textarea>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="firstdate" class="col-form-label"> First Date: <span class="text-danger">*</span> </label>
                <input type="date" id="firstdate" name="firstdate" class="form-control" dateISO="true" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="seconddate" class="col-form-label"> Second Date: <span class="text-danger">*</span> </label>
                <input type="date" id="seconddate" name="seconddate" class="form-control" dateISO="true" required>
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
  function save(request_id) {
    // reset the form 
    $("#data-form")[0].reset();
    $(".form-control").removeClass('is-invalid').removeClass('is-valid');
    if (typeof request_id === 'undefined' || request_id < 1) { //add
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
          request_id: request_id
        },
        dataType: 'json',
        success: function(response) {
          console.log(response);
          $('#model-header').removeClass('bg-success').addClass('bg-info');
          $("#info-header-modalLabel").text('<?= lang("App.edit") ?>');
          $("#form-btn").text(submitText);
          $('#data-modal').modal('show');
          //insert data to form
          $("#data-form #request_id").val(response.request_id);
          $("#data-form #request_name").val(response.request_name);
          $("#data-form #briefdescription").val(response.briefdescription);
          $("#data-form #firstdate").val(response.firstdate);
          $("#data-form #seconddate").val(response.seconddate);
          $("#data-form #RequestStatus").val(response.RequestStatus);
          $("#data-form #file").val(response.file);
          $("#data-form #Detail").val(response.Detail);
          $("#data-form #user_user_id").val(response.user_user_id);
          $("#data-form #user_lead").val(response.user_lead);
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