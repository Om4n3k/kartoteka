<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kartoteka</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-file-upload"></i> Dodaj wpis</h6>
        </div>
        <ul id="m_Kartoteka" class="step d-flex flex-nowrap">
            <li class="step-item">
                <a data-toggle="tab" href="#step1">Dane przestępcy</a>
            </li>
            <li class="step-item">
                <a data-toggle="tab" href="#step2">Dane dotyczące wpisu</a>
            </li>
        </ul>
        <div class="card-body">
            <form id="form_kartoteka_add" action="inc/kartoteka_add.php" class="user" method="post" enctype="multipart/form-data">
                <div class="tab-content">
                    <div class="tab-pane container fade show active" id="step1">
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <input type="text" required class="form-control form-control-user" name="k_name" placeholder="Imię sprawcy">
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <input type="text" required class="form-control form-control-user" name="k_surname" placeholder="Nazwisko sprawcy">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label>Zdjęcie prawa jazdy</label>
                                    <input type="file" required class="form-control form-control-user" name="k_driver" accept="image/x-png,image/gif,image/jpeg" placeholder="Zdjęcie dowodu">
                                </div>
                                <div class="form-group">
                                    <label>Zdjęcie twarzy obywatela</label>
                                    <input type="file" required class="form-control form-control-user" name="k_photo" accept="image/x-png,image/gif,image/jpeg" placeholder="Zdjęcie obywatela">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <img id="driver_preview" class="img-fluid img-thumbnail" src="https://sanitationsolutions.net/wp-content/uploads/2015/05/empty-image.png" />
                            </div>
                            <div class="col-md">
                                <img id="photo_preview" class="img-fluid img-thumbnail" src="https://sanitationsolutions.net/wp-content/uploads/2015/05/empty-image.png" />
                            </div>
                        </div>
                        <div class="row">
                            <a class="btn btn-primary mx-auto my-2 btn-kartoteka" data-toggle="pill" href="#step2">Dane dotyczące wpisu</a>
                        </div>
                    </div>
                    <div class="tab-pane container fade" id="step2">
                        <div class="row">
                            <table class="table table-sm">
                                <tr>
                                    <td invisible> </td>
                                    <td><input class="button" type="button" value="C" onclick="clean()"></td>
                                    <td><input class="button" type="button" value="<" onclick="back()"></td>
                                    <td><input class="button" type="button" value="+" onclick="insert('+')"></td>
                                    <td><input class="button" type="button" value="=" onclick="equal()"></td>
                                </tr>
                                <tr>
                                    <td invisible> </td>
                                    <td><input class="button" type="button" style="height: 35px; /*width: 250px;*/ border-color: red;font-size: 15"  value="Poważne przestępstwa" disabled></td>
                                    <td><input class="button" type="button" style="height: 35px; /*width: 250px;*/ border-color: limegreen;font-size: 15"  value="Handel & Dystrybucja" disabled></td>
                                    <td><input class="button" type="button" style="height: 35px; /*width: 250px;*/ border-color: #FFC107;font-size: 15"  value="Wykroczenia drogowe" disabled></td>
                                    <td><input class="button" type="button" style="height: 35px; /*width: 250px;*/ border-color: #0288D1;font-size: 15"  value="Inne" disbaled></td>
                                </tr>
                                <tr>
                                    <td invisible> </td>
                                    <td><input class="button" type="button" value="Mordersto bez powodu" onclick="insert(50000, 200, 'MORDERSTWO BEZ POWODU', true)"></td>
                                    <td><input class="button" type="button" value="Przemyt nielegalnej broni" onclick="insert(15000, 40, 'PRZEMYT NIELEGALNEJ BRONI', true)"></td>
                                    <td><input class="button" type="button" value="Brak prawa jazdy" onclick="insert(2500, 5, 'BRAK PRAWA JAZDY', true)"></td>
                                    <td><input class="button" type="button" value="Opór przy aresztowaniu" onclick="insert(600, 5, 'OPÓR PRZY ARESZTOWANIU', true)"></td>
                                </tr>
                                <tr>
                                    <td invisible> </td>
                                    <td><input class="button" type="button" value="Mordersto w afekcie" onclick="insert(50000, 120, 'MORDERSTWO W AFEKCIE', true)"></td>
                                    <td><input class="button" type="button" value="Sprzedaż nielegalnej broni" onclick="insert(10000, 25, 'SPRZEDAŻ NIELEGALNEJ BRONI', true)"></td>
                                    <td><input class="button" type="button" value="Ucieczka z miejsca wypadku" onclick="insert(1000, 15, 'UCIECZKA Z MIEJSCA WYPADKU', true)"></td>
                                    <td><input class="button" type="button" value="Utrudnianie pracy policji" onclick="insert(1000, 10, 'UTRUDNIANIE PRACY POLICJI', true)"></td>
                                </tr>
                                <tr>
                                    <td invisible> </td>
                                    <td><input class="button" type="button" value="Próba morderstwa" onclick="insert(20000, 50, 'PRÓBA MORDERSTWA', true)"></td>
                                    <td><input class="button" type="button" value="Posiadanie nielegalnej broni" onclick="insert(2500, 5, 'POSIADANIE NIELEGALNEJ BRONI', true)"></td>
                                    <td><input class="button" type="button" value="Kradzież pojazdu" onclick="insert(1500, 10, 'KRADZIEŻ POJAZDU', true)"></td>
                                    <td><input class="button" type="button" value="Brak informacji o posiadaniu broni" onclick="insert(1500, 0, 'BRAK INFORMACJI O POSIADANIU BRONI', true)"></td>
                                </tr>
                                <tr>
                                    <td invisible> </td>
                                    <td><input class="button" type="button" value="Groźby karalne" onclick="insert(7000, 25, 'GROŹBY KARALNE', true)"></td>
                                    <td><input class="button" type="button" value="Posiadanie broni bez licencji" onclick="insert(2500, 5, 'POSIADANIE BRONI BEZ LICENCJI', true)"></td>
                                    <td><input class="button" type="button" value="Próba kradzieży pojazdu" onclick="insert(1000, 10, 'PRÓBA KRADZIEŻY POJAZDU', true)"></td>
                                    <td><input class="button" type="button" value="Łapówka" onclick="insert(5000, 10, 'ŁAPÓWKA', true)"></td>
                                </tr>
                                <tr>
                                    <td invisible> </td>
                                    <td><input class="button" type="button" value="Napad z bronią palną" onclick="insert(9000, 130, 'NAPAD Z BRONIĄ PALNĄ', true)"></td>
                                    <td><input class="button" type="button" value="Nielegalne użycie broni" onclick="insert(1000, 5, 'NIELEGALNEJ UŻYCIE BRONI', true)"></td>
                                    <td><input class="button" type="button" value="Jazda pod wpływem" onclick="insert(3000, 10, 'JAZDA POD WPŁYWEM', true)"></td>
                                    <td><input class="button" type="button" value="Odmowa okazania dokumentu" onclick="insert(1500, 5, 'ODMOWA OKAZANIA DOKUMENTU', true)"></td>
                                </tr>
                                <tr>
                                    <td invisible> </td>
                                    <td><input class="button" type="button" value="Napad na funkcjonariusza" onclick="insert(15000, 60, 'NAPAD NA FUNCKJONARIUSZA', true)"></td>
                                    <td><input class="button" type="button" value="Posiadanie narkotyków" onclick="insert(2500, 5, 'POSIADANIE NARKOTYKÓW', true)"></td>
                                    <td><input class="button" type="button" value="Spowodowanie wypadku pod wpływem" onclick="insert(6000, 30, 'SPOWODOWANIE WYPADKU POD WPŁYWEM', true)"></td>
                                    <td><input class="button" type="button" value="Składanie fałszywych zeznań" onclick="insert(3000, 15, 'SKŁADANIE FAŁSZYWYCH ZEZNAŃ', true)"></td>
                                </tr>
                                <tr>
                                    <td invisible> </td>
                                    <td><input class="button" type="button" value="Napad na bank" onclick="insert(50000, 30, 'NAPAD NA BANK', true)"></td>
                                    <td><input class="button" type="button" value="Posiadanie dużej ilości narkotyków" onclick="insert(5000, 20, 'POSIADANIE DUŻEJ ILOŚCI NARKOTYKÓW', true)"></td>
                                    <td><input class="button" type="button" value="Prowadzenie skradzionego pojazdu" onclick="insert(6000, 30, 'PROWADZENIE SKRADZIONEGO POJAZDU', true)"></td>
                                    <td><input class="button" type="button" value="Posiadanie wytrychów" onclick="insert(600, 5, 'POSIADANIE WYTRYCHÓW', true)"></td>
                                </tr>
                                <tr>
                                    <td invisible> </td>
                                    <td><input class="button" type="button" value="Napad na jubilera" onclick="insert(50000, 30, 'NAPAD NA JUBILERA', true)"></td>
                                    <td><input class="button" type="button" value="Sprzedaż narkotyków" onclick="insert(7000, 35, 'SPRZEDAŻ NARKOTYKÓW', true)"></td>
                                    <td><input class="button" type="button" value="Ucieczka i unikanie policji" onclick="insert(6000, 30, 'UCIECZKA I UNIKANIE POLICJI', true)"></td>
                                    <td><input class="button" type="button" value="Pobicie" onclick="insert(1000, 10, 'Pobicie', true)"></td>
                                </tr>
                                <tr>
                                    <td invisible> </td>
                                    <td><input class="button" type="button" value="Napad na sklep" onclick="insert(5000, 10, 'NAPAD NA SKLEP', true)"></td>
                                    <td><input class="button" type="button" value="Dystrybucja narkotyków" onclick="insert(15000, 50, 'DYSTRYBUCJA NARKOTYKÓW', true)"></td>
                                    <td><input class="button" type="button" value="Spow. wypadku z ofiarami" onclick="insert(4500, 25, 'SPOWODOWANIE WYPADKU Z OFIARAMI', true)"></td>
                                    <td><input class="button" type="button" value="Kradzież" onclick="insert(250, 5, 'KRADZIEŻ', true)"></td>
                                </tr>
                                <tr>
                                    <td invisible> </td>
                                    <td><input class="button" type="button" value="Porwanie" onclick="insert(5000, 10, 'PORWANIE', true)"></td>
                                    <td invisible> </td>
                                    <td><input class="button" type="button" value="Nieudzielenie pomocy poszkodowanemu" onclick="insert(2000, 10, 'NIEUDZIELENIE POMOCY POSZKODOWANEMU', true)"></td>
                                </tr>
                                <tr>
                                    <td invisible> </td>
                                    <td><input class="button" type="button" value="Napaść" onclick="insert(2500, 25, 'NAPAŚĆ', true)"></td>
                                </tr>
                                <tr>
                                    <td invisible> </td>
                                    <td><input class="button" type="button" value="Nieumyślne spowodowanie śmierci" onclick="insert(15000, 60, 'NIEUMYŚLNE SPOWODOWANIE ŚMIERCI', true)"></td>
                                </tr>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <input type="text" required class="form-control form-control-user" name="k_money" placeholder="Grzywna">
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <input type="text" required class="form-control form-control-user" name="k_months" placeholder="Ilość miesięcy">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                           <div class="col-md">
                              <div class="form-group">
                                 <textarea required class="form-control form-control-user" name="k_reason"></textarea>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                            <a class="btn btn-kartoteka btn-primary mx-auto my-2" data-toggle="pill" href="#step1">Dane przestępcy</a>
                            <button type="submit" class="btn btn-success mx-auto my-2">Dodaj wpis</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
var czydodalo = false;
var kk_money = document.getElementsByName("k_money")[0];
var kk_text = document.getElementsByName("k_reason")[0];
var kk_time = document.getElementsByName("k_months")[0];
var calculation = null;

function insert(num, time, name, flag) {
    let isArithmetic = false;
    var ile = num;
    if (num === '+' || num === '-' || num === '/' || num === '*') {
        isArithmetic = true;
    }
    let localTime = time;
    if (flag) {
        ile = 500;
        localTime = 5;
        if (!czydodalo) {
            ile = num;
            localTime = time;
            localName = name;
        }
        if (name) {
            kk_text.value += " | " + name;
        }
        kk_money.value = kk_money.value + ile;
        kk_money.value += "+";
        if (isArithmetic) {
            kk_time.value = kk_time.value + num;
        } else {
            kk_time.value = kk_time.value + localTime;
            kk_time.value += "+";
        }
        czydodalo = true;
    } else {
        kk_money.value = kk_money.value + ile;
        if (isArithmetic) {
            kk_time.value = kk_time.value + num;
        } else {
            kk_time.value = kk_time.value + localTime;
        }
    }
}
// addTD();
function equal() {
    var expPrice = kk_money.value;
    var expTime = kk_time.value;
    kk_money.value = eval(expPrice);
    kk_time.value = eval(expTime);
}

function back() {
    const priceField = kk_money;
    const timeField = kk_time;
    const priceValue = priceField.value;
    const timeValue = timeField.value;
    const newPriceValue = priceValue.slice(0, -1);
    const newTimeValue = timeValue.slice(0, -1);
    priceField.value = newPriceValue;
    timeField.value = newTimeValue;
}

function clean() {
    kk_money.value = "";
    kk_time.value = "";
    kk_text.value = "";
    czydodalo = false;
}
</script>