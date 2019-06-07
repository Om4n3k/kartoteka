<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Konto :: <?=$user->name?> <?=$user->surname?></h1>
  </div>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-user-circle"></i> Zarządzanie kontem</h6>
    </div>
    <div class="card-body">
      <form id="form_save_settings_main">
        <div class="form-group">
          <div class="row">
            <div class="col-md">
              <label>Login</label>
              <input type="text" class="form-control form-control-user" id="u_login" required value="<?=$user->login?>">
            </div>
          </div>
          <div class="row mt-md-2">
            <div class="col-md">
              <label>Imię</label>
              <input type="text" class="form-control form-control-user" id="u_name" required value="<?=$user->name?>">
            </div>
            <div class="col-md">
              <label>Nazwisko</label>
              <input type="text" class="form-control form-control-user" id="u_surname" required value="<?=$user->surname?>">
            </div>
          </div>
          <button type="submit" class="btn btn-primary mt-3 btn-user btn-block">
            <i class="fas fa-fw fa-upload"></i> Zapisz ustawienia
          </button>
        </div>
      </form>
    </div>
  </div>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-key"></i> Zmiana hasła</h6>
    </div>
    <div class="card-body">
      <form id="form_save_settings_password">
        <div class="form-group">
          <div class="row">
            <div class="col-md">
              <label>Stare hasło</label>
              <input type="password" class="form-control form-control-user" id="p_old_password" required>
            </div>
          </div>
          <div class="row mt-md-2">
            <div class="col-md">
              <label>Nowe hasło</label>
              <input type="password" class="form-control form-control-user" id="p_new_password" required>
            </div>
            <div class="col-md">
              <label>Powtórz nowe hasło</label>
              <input type="password" class="form-control form-control-user" id="p_new_password_r" required>
            </div>
          </div>
          <button type="submit" class="btn btn-primary mt-3 btn-user btn-block">
            <i class="fas fa-fw fa-key"></i> Zmień hasło
          </button>
        </div>
      </form>
    </div>
  </div>
</div>