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
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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

  <div class="row">
    <div class="col">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Sprawdz Kartoteke obywatela</h6>
        </div>
        <div class="card-body">
          <form id="find_person">
            <div class="form-group">
              <label for="id_number">Numer dowodu obywatela</label>
              <input type="text" class="form-control" id="id_number" placeholder="Numer dowodu obywatela">
            </div>
            <button type="submit" class="btn btn-primary">Szukaj <i class="fas fa-fw fa-search"></i></button>
          </form>
        </div>
      </div>
    </div>
    <div id="find_person_result" class="col d-none">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Kartoteka :: AF31864876</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Position</th>
                  <th>Office</th>
                  <th>Age</th>
                  <th>Start date</th>
                  <th>Salary</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Position</th>
                  <th>Office</th>
                  <th>Age</th>
                  <th>Start date</th>
                  <th>Salary</th>
                </tr>
              </tfoot>
              <tbody>
                <tr>
                  <td>Quinn Flynn</td>
                  <td>Support Lead</td>
                  <td>Edinburgh</td>
                  <td>22</td>
                  <td>2013/03/03</td>
                  <td>$342,000</td>
                </tr>
                <tr>
                  <td>Charde Marshall</td>
                  <td>Regional Director</td>
                  <td>San Francisco</td>
                  <td>36</td>
                  <td>2008/10/16</td>
                  <td>$470,600</td>
                </tr>
              </tbody>
            </table>
          </div>
      </div>
    </div>
  </div>
</div>