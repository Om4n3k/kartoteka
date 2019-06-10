<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Kartoteka</h1>
  </div>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Ostatnie wpisy do kartoteki</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-sm table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th colspan="2">ID</th>
              <th>Imię</th>
              <th>Nazwisko</th>
              <th>Powód wpisu</th>
              <th>Data dodania</th>
              <th>Grzywna</th>
              <th>Ilość miesięcy</th>
              <th>Policjant</th>
            </tr>
          </thead>
          <tfoot>
           <tr>
              <th colspan="2">ID</th>
              <th>Imię</th>
              <th>Nazwisko</th>
              <th>Powód wpisu</th>
              <th>Data dodania</th>
              <th>Grzywna</th>
              <th>Ilość miesięcy</th>
              <th>Policjant</th>
            </tr>
          </tfoot>
          <tbody>
            <?=$core->createKartotekaTable()?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>