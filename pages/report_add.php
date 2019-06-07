<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Raporty</h1>
  </div>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-file-upload"></i> Dodaj wpis</h6>
    </div>
    <div class="card-body">
      <form id="form_report_add" action="inc/report_add.php" class="user" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md">
            <div class="form-group">
              <textarea type="text" rows="28" required class="form-control" name="r_text" placeholder="Treść raportu"></textarea>
            </div>
          </div>
        </div>
        <div class="col-md text-center">
					<button type="submit" class="btn btn-primary mt-4 btn-user">
            <i class="fas fa-fw fa-file-upload"></i> Dodaj wpis
          </button>
				</div>
      </form>
    </div>
  </div>
</div>