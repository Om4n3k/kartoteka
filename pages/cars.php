<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Baza pojazdów</h1>
  </div>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Baza pojazdów</h6>
    </div>
    <div class="card-body">
      <select name="pagination-setting" onChange="changePagination(this.value);" class="form-control mb-3" id="pagination-setting">
        <option value="all-links">Pokazuj liczby</option>
        <option value="prev-next">Pokazuj - Następny, poprzedni</option>
      </select>
      <div id="pagination-result">
      <script>
        document.addEventListener("DOMContentLoaded", function(event) { 
          getresult('inc/getresult.php');
        });
        </script>
      </div>
    </div>
  </div>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Szukaj</h6>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">Szukaj według</span>
        </div>
        <select id="searchCar--Type" class="form-control">
          <option value="0" selected>Nazwisko</option>
          <option value="1">Rejestracja</option>
        </select>
        <input id="searchCar--Value" type="text" required class="form-control">
        <div class="input-group-append">
          <a class="btn btn-primary" href="a--SearchCar" style="color:#fff">Szukaj</a>
        </div>
      </div>
    </div>
    <div class="card-body" id="searchCar--Result">
      <div class="table-responsive">
        <table class="table table-sm table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Rejestracja</th>
              <th>Imię właściciela</th>
              <th>Nazwisko właściciela</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Rejestracja</th>
              <th>Imię właściciela</th>
              <th>Nazwisko właściciela</th>
            </tr>
          </tfoot>
          <tbody id="searchCar--ResultTable">
            <!-- Tutaj wrzuci rezultat, prawda?-->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>