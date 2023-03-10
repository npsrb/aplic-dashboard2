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
        <h5 class="card-title">Table request</h5>
      </div>

      <!-- /.card-header -->
      <div class="card-body">
        <table id="data_table" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Request No</th>
              <th>Request Name</th>
              <th>Brief Description</th>
              <th>First Date</th>
              <th>Second Date</th>
              <th>Status</th>
              <th>Detail</th>
              <th>Approve</th>
              <th>Reject</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>

    <?= $this->endSection() ?>
    <?= $this->section("script") ?>
    <script>
      function accept(request_id) {
        $.ajax({
          url: '<?= base_url($controller . "/accept") ?>',
          type: 'post',
          data: {
            request_id: request_id
          },
          dataType: 'json',
          beforeSend: function() {
            Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes!'
            }).then((result) => {
              if (result.isConfirmed) {
                Swal.fire(
                  'Processing!',
                  'The Request has been submitted.',
                  'success'
                ).then(function() {
                  $('#data_table').DataTable().ajax.reload(null, false).draw(false);
                  $('#data-modal').modal('hide');
                })
              }
            })
          },
        });
      }

      function reject(request_id) {
        $.ajax({
          url: '<?= base_url($controller . "/reject") ?>',
          type: 'post',
          data: {
            request_id: request_id
          },
          dataType: 'json',
          beforeSend: function() {
            Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes!'
            }).then((result) => {
              if (result.isConfirmed) {
                Swal.fire(
                  'Processing!',
                  'The Request has been submitted.',
                  'success'
                ).then(function() {
                  $('#data_table').DataTable().ajax.reload(null, false).draw(false);
                  $('#data-modal').modal('hide');
                })

              }
            })
          },
        });
      }
    </script>


    <?= $this->endSection() ?>