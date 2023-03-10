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
        <h5 class="card-title">Table menu</h5>
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
          <th>#</th>
          <th>Menu id</th>
          <th>Menu name</th>
          <th>Menu order</th>
          <th>Menu link</th>
          <th>Menu title</th>
          <th>Menu keyword</th>
          <th>Menu desc</th>
          <th>Menu status</th>
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
            <input type="hidden" id="menu_id" name="menu_id" class="form-control" placeholder="Menu id" maxlength="45" required value="<?= $id ?>">
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="menu_name" class="col-form-label"> Menu name: </label>
                <input type="text" id="menu_name" name="menu_name" class="form-control" placeholder="Menu name" minlength="0" maxlength="45">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="menu_order" class="col-form-label"> Menu order: </label>
                <input type="number" id="menu_order" name="menu_order" class="form-control" placeholder="Menu order" minlength="0" maxlength="11">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="menu_link" class="col-form-label"> Menu link: <span class="text-danger">*</span> </label>
                <input type="text" id="menu_link" name="menu_link" class="form-control" placeholder="Menu link" minlength="0" maxlength="45" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="menu_title" class="col-form-label"> Menu title: </label>
                <input type="text" id="menu_title" name="menu_title" class="form-control" placeholder="Menu title" minlength="0" maxlength="255">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="menu_keyword" class="col-form-label"> Menu keyword: </label>
                <input type="text" id="menu_keyword" name="menu_keyword" class="form-control" placeholder="Menu keyword" minlength="0" maxlength="255">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="menu_desc" class="col-form-label"> Menu desc: </label>
                <input type="text" id="menu_desc" name="menu_desc" class="form-control" placeholder="Menu desc" minlength="0" maxlength="255">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="menu_status" class="col-form-label"> Menu status: <span class="text-danger">*</span> </label>
                <input type="text" id="menu_status" name="menu_status" class="form-control" placeholder="Menu status" minlength="0" maxlength="45" required>
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
  function save(menu_id) {
    // reset the form 
    $("#data-form")[0].reset();
    $(".form-control").removeClass('is-invalid').removeClass('is-valid');
    if (typeof menu_id === 'undefined' || menu_id < 1) { //add
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
          menu_id: menu_id
        },
        dataType: 'json',
        success: function(response) {
          console.log(response);
          $('#model-header').removeClass('bg-success').addClass('bg-info');
          $("#info-header-modalLabel").text('<?= lang("App.edit") ?>');
          $("#form-btn").text(submitText);
          $('#data-modal').modal('show');
          //insert data to form
          $("#data-form #menu_id").val(response.menu_id);
          $("#data-form #menu_name").val(response.menu_name);
          $("#data-form #menu_order").val(response.menu_order);
          $("#data-form #menu_link").val(response.menu_link);
          $("#data-form #menu_title").val(response.menu_title);
          $("#data-form #menu_keyword").val(response.menu_keyword);
          $("#data-form #menu_desc").val(response.menu_desc);
          $("#data-form #menu_status").val(response.menu_status);

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