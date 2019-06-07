<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Policjanci</h1>
  </div>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Lista policjantów</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Poziom</th>
              <th>Imię</th>
              <th colspan="2">Nazwisko</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>ID</th>
              <th>Poziom</th>
              <th>Imię</th>
              <th colspan="2">Nazwisko</th>
            </tr>
          </tfoot>
          <tbody>
            <?=$core->createUsersTable()?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-user-plus"></i> Dodaj policjanta</h6>
    </div>
    <div class="card-body">
      <form id="form_police_add" class="user">
        <div class="row">
          <div class="col">
            <div class="form-group">
              <input type="text" required class="form-control form-control-user" id="p_name" placeholder="Imię">
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <input type="text" required class="form-control form-control-user" id="p_surname" placeholder="Nazwisko">
            </div>
          </div>
        </div>
        <div class="form-group">
          <input type="password" required class="form-control form-control-user" id="p_password" placeholder="Hasło">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <input type="text" required class="form-control form-control-user" id="p_login" placeholder="Login">
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <input type="number" min="0" max="8" required class="form-control form-control-user" id="p_level" placeholder="Poziom dostępu">
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary btn-user btn-block">
          Dodaj policjanta
        </a>
      </form>
    </div>
  </div>
</div>