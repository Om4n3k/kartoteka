<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Raporty</h1>
  </div>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Ostatnie raporty</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th colspan="2">Numer wpisu</th>
              <th>Imię</th>
              <th>Nazwisko</th>
              <th>Data dodania</th>
            </tr>
          </thead>
          <tfoot>
           <tr>
           <th colspan="2">Numer wpisu</th>
              <th>Imię</th>
              <th>Nazwisko</th>
              <th>Data dodania</th>
            </tr>
          </tfoot>
          <tbody>
            <?=$core->createReportsTable()?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>