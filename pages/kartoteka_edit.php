<?php
$kartoteka = $core->getWpisFromKartoteka($_GET['id']);
$kartoteka['data_koniec'] = date('Y-m-d',$kartoteka['data']);
?>
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Kartoteka</h1>
  </div>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-file-upload"></i> Edytuj wpis</h6>
    </div>
    <div class="card-body">
      <form id="form_kartoteka_edit" action="inc/kartoteka_add.php" class="user" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md">
            <div class="form-group">
              <label>Miesiące</label>
              <input type="number" value="<?=$kartoteka['months']?>" required class="form-control form-control-user" name="k_time">
              <input type="text" name="k_id" value="<?=$kartoteka['id']?>" hidden>
            </div>
          </div>
          <div class="col-md">
            <div class="form-group">
              <label>Grzywna</label>
              <input type="number" value="<?=$kartoteka['money']?>" required class="form-control form-control-user" name="k_money">
            </div>
          </div>
        </div>
        <div class="form-group">
          <textarea required class="form-control form-control-user" name="k_reason" placeholder="Powód wpisu"><?=$kartoteka['powod']?></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-4 btn-user btn-block">
          <i class="fas fa-fw fa-file-upload"></i> Edytuj wpis
        </a>
      </form>
    </div>
  </div>
</div>