<!-- Begin Page Content -->
<div class="container-fluid">
   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Strona Główna</h1>
   </div>

   <div class="row">
      <div class="col-xl-4 col-md-6 mb-4">
         <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
               <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                     <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Wpisów w kartotece</div>
                     <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$core->card_count?></div>
                  </div>
                  <div class="col-auto">
                     <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="col-xl-4 col-md-6 mb-4">
         <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
               <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                     <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Raportów</div>
                     <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$core->report_count?></div>
                  </div>
                  <div class="col-auto">
                     <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="col-xl-4 col-md-6 mb-4">
         <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
               <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                     <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Policjantów</div>
                     <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$core->users_count?></div>
                  </div>
                  <div class="col-auto">
                     <i class="fas fa-users fa-2x text-gray-300"></i>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
  <!--
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
-->
</div>
<!-- /.container-fluid -->