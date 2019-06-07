<?php
$pederastian = $core->getPederastianInfo($_GET['id']);
?>
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Obywatel - <?=$pederastian['name']?> <?=$pederastian['surname']?></h1>
  </div>

  <div class="row">
    <div class="col-md-4">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Dane osobowe</h6>
        </div>
        <div class="card-body">
          <img src="<?=$pederastian['dl_path']?>" class="img-fluid mb-2"/>
          <img src="<?=$pederastian['p_path']?>" class="img-fluid"/>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Kartoteka</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th colspan="2">ID</th>
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
                  <th>Powód wpisu</th>
                  <th>Data dodania</th>
                  <th>Grzywna</th>
                  <th>Ilość miesięcy</th>
                  <th>Policjant</th>
                </tr>
              </tfoot>
              <tbody>
                <?=$core->createPederastianKartotekaTable($pederastian['id'],true)?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>