<div class="row">
  <div class="col-3 ml-3 mt-3 petunjuk-map">
    <div class="card">
      <div class="card-body">
        <h6><strong><span class="fa fa-lg fa-info-circle mr-2 mb-2"></span> Petunjuk</strong></h6>
        <ul class="list-group list-group-flush">
          <!-- ZOOM IN & OUT -->
          <li class="list-group-item">
            <div class="row">
              <div class="col-auto">
                <img width="30" src="<?= base_url('assets/img/petunjuk_map/zoom.PNG') ?>">
              </div>
              <div class="col">
                <div class="row">
                  <strong>Zoom</strong>
                </div>
                <div class="row">
                  <small>Memperbesar (<span class="fa fa-plus"></span>) dan memperkecil (<span class="fa fa-minus"></span>) tampilan peta</small>
                </div>
              </div>
            </div>
          </li>
          <!-- ZOOM IN & OUT -->
          <li class="list-group-item">
            <div class="row">
              <div class="col-auto">
                <img width="30" src="<?= base_url('assets/img/petunjuk_map/geolokasi.PNG') ?>">
              </div>
              <div class="col">
                <div class="row">
                  <strong>Geolokasi</strong>
                </div>
                <div class="row">
                  <small>Menampilkan lokasi Anda saat ini pada peta</small>
                  <small><i>Anda perlu mengizinkan web untuk mengakses lokasi Anda dengan klik <strong>Allow</strong> pada panel tertampil</i></small>
                </div>
              </div>
            </div>
          </li>
          <!-- DEMOGRAFI -->
          <li class="list-group-item">
            <div class="row">
              <div class="col-auto">
                <img width="60" src="<?= base_url('assets/img/petunjuk_map/demografi.PNG') ?>">
              </div>
              <div class="col">
                <div class="row">
                  <strong>Data Penduduk</strong>
                </div>
                <div class="row">
                  <small>Menampilkan informasi jumlah penduduk Desa Singosaren</small>
                </div>
              </div>
            </div>
          </li>
          <!-- SARPRAS -->
          <li class="list-group-item">
            <div class="row">
              <div class="col-auto">
                <img width="60" src="<?= base_url('assets/img/petunjuk_map/sarpras.PNG') ?>">
              </div>
              <div class="col">
                <div class="row">
                  <strong>Data Sarana & Prasarana</strong>
                </div>
                <div class="row">
                  <small>Menampilkan informasi sarana dan prasarana Desa Singosaren</small>
                </div>
              </div>
            </div>
          </li>
          <!-- LAYERS -->
          <li class="list-group-item">
            <div class="row">
              <div class="col-auto">
                <img width="30" src="<?= base_url('assets/img/petunjuk_map/layer.PNG') ?>">
              </div>
              <div class="col">
                <div class="row">
                  <strong>Layers</strong>
                </div>
                <div class="row">
                  <small>Mengatur <i>basemap</i> tampilan peta dasar dan tampilan batas-batas wilayah</small>
                </div>
              </div>
            </div>
          </li>
          <!-- LAYERS -->
          <li class="list-group-item">
            <div class="row">
              <div class="col-auto">
                <img width="30" src="<?= base_url('assets/img/petunjuk_map/distancemeasure.PNG') ?>">
              </div>
              <div class="col">
                <div class="row">
                  <strong>Mengukur Jarak</strong>
                </div>
                <div class="row">
                  <small>Mengukur jarak antara satu titik lokasi ke titik lain</small>
                </div>
              </div>
            </div>
          </li>

        </ul>
      </div>
    </div>
  </div>
  <div class="col">

    <div id="maps" style="height: 640px; position: relative;">

      <div class="btn-group-vertical" role="group" aria-label="Basic example" style="position: absolute; z-index: 670; bottom: 0; margin-bottom: 50px">

        <div class="btn-group dropup">
          <button id="btnGroupDrop1" type="button" class="btn btn-xl btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="fa fa-male fa-lg"></span>
          </button>
          <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
            <h4 class="dropdown-header">Kategori Jumlah Penduduk</h4>
            <li class="dropdown-item" data-toggle="modal" data-target="#usiaModal" data-kategori="Usia">Usia</li>
            <li class="dropdown-item" data-toggle="modal" data-target="#agamaModal" data-kategori="Agama">Agama</li>
            <li class="dropdown-item" data-toggle="modal" data-target="#pendidikanModal" data-kategori="Pendidikan">Pendidikan</li>
            <li class="dropdown-item" data-toggle="modal" data-target="#pencaharianModal" data-kategori="Pencaharian">Mata Pencaharian</li>
          </div>
        </div>

        <div class="btn-group dropup">
          <button id="btnGroupDrop1" type="button" class="btn btn-xl btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="fa fa-building fa-lg"></span>
          </button>
          <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
            <h4 class="dropdown-header">Sarana & Prasarana</h4>
            <li class="dropdown-item" data-toggle="modal" data-target="#kesehatanModal" data-kategori="kesehatan">Kesehatan</li>
            <li class="dropdown-item" data-toggle="modal" data-target="#sarPendidikanModal" data-kategori="pendidikan">Pendidikan</li>
            <li class="dropdown-item" data-toggle="modal" data-target="#ekonomiModal" data-kategori="ekonomi">Ekonomi</li>
            <li class="dropdown-item" data-toggle="modal" data-target="#lainnyaModal" data-kategori="lainnya">Lainnya</li>
          </div>
        </div>

      </div>

    </div>

  </div>
</div>

<!-- DATA USIA MODAL -->
<div class="modal fade" id="usiaModal" tabindex="-1" role="dialog" aria-labelledby="usiaModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h4 class="text-center">Jumlah Penduduk menurut Usia</h4>
        <div class="row">
          <div class="col mb-5">
            <canvas id="usia"></canvas>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-7 mb-3 table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col" class="text-center">Kelompok Usia</th>
                  <th scope="col" class="text-center">L</th>
                  <th scope="col" class="text-center">P</th>
                  <th scope="col" class="text-center">Jumlah</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="text-center">1 - 9 th</td>
                  <td class="text-center">279</td>
                  <td class="text-center">271</td>
                  <td class="text-center">550</td>
                </tr>
                <tr>
                  <td class="text-center">10 - 19 th</td>
                  <td class="text-center">308</td>
                  <td class="text-center">275</td>
                  <td class="text-center">583</td>
                </tr>
                <tr>
                  <td class="text-center">20 - 29 th</td>
                  <td class="text-center">317</td>
                  <td class="text-center">272</td>
                  <td class="text-center">589</td>
                </tr>
                <tr>
                  <td class="text-center">30 - 39 th</td>
                  <td class="text-center">281</td>
                  <td class="text-center">305</td>
                  <td class="text-center">586</td>
                </tr>
                <tr>
                  <td class="text-center">40 - 49 th</td>
                  <td class="text-center">274</td>
                  <td class="text-center">284</td>
                  <td class="text-center">558</td>
                </tr>
                <tr>
                  <td class="text-center">50 - 59 th</td>
                  <td class="text-center">253</td>
                  <td class="text-center">259</td>
                  <td class="text-center">512</td>
                </tr>
                <tr>
                  <td class="text-center">60 - 69 th</td>
                  <td class="text-center">173</td>
                  <td class="text-center">136</td>
                  <td class="text-center">309</td>
                </tr>
                <tr>
                  <td class="text-center">>70 th</td>
                  <td class="text-center">65</td>
                  <td class="text-center">89</td>
                  <td class="text-center">154</td>
                </tr>
                <tr>
                  <td class="text-center" colspan="3"><strong>Total</strong></td>
                  <td class="text-center">3841</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-header">
        <small><i>Klik di luar kotak untuk menutup panel</i></small>
      </div>
    </div>
  </div>
</div>
<!-- END DATA USIA MODAL -->

<!-- DATA AGAMA MODAL -->
<div class="modal fade" id="agamaModal" tabindex="-1" role="dialog" aria-labelledby="agamaModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h4 class="text-center mb-3">Jumlah Penduduk menurut Agama</h4>
        <div class="row">
          <div class="col mb-5">
            <canvas id="agama"></canvas>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-7 mb-3 table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>No<br></th>
                  <th>Agama</th>
                  <th>Jumlah<br></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Islam</td>
                  <td>3822<br></td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Kristen</td>
                  <td>8</td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>Katolik</td>
                  <td>6</td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>Hindu</td>
                  <td>4</td>
                </tr>
                <tr>
                  <td>5</td>
                  <td>Budha</td>
                  <td>1</td>
                </tr>
                <tr>
                  <td>6</td>
                  <td>Lainnya</td>
                  <td>-</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-header">
        <small><i>Klik di luar kotak untuk menutup panel</i></small>
      </div>
    </div>
  </div>
</div>
<!-- END DATA AGAMA MODAL -->

<!-- PENDIDIKAN -->
<div class="modal fade" id="pendidikanModal" tabindex="-1" role="dialog" aria-labelledby="pendidikanModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h4 class="text-center mb-3">Jumlah Penduduk menurut Pendidikan</h4>
        <div class="row">
          <div class="col mb-5">
            <canvas id="pendidikan"></canvas>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-8 mb-3 table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tingkat Pendidikan</th>
                  <th>Jumlah Penduduk</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Tidak/Belum Sekolah</td>
                  <td>638</td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Tidak Lulus SD</td>
                  <td>367</td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>SD</td>
                  <td>847</td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>SLTP</td>
                  <td>540</td>
                </tr>
                <tr>
                  <td>5</td>
                  <td>SLTA / SMK</td>
                  <td>1033</td>
                </tr>
                <tr>
                  <td>6</td>
                  <td>Perguruan Tinggi</td>
                  <td>301</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-header">
        <small><i>Klik di luar kotak untuk menutup panel</i></small>
      </div>
    </div>
  </div>
</div>
<!-- END PENDIDIKAN -->

<!-- MATA PENCAHARIAN -->
<div class="modal fade" id="pencaharianModal" tabindex="-1" role="dialog" aria-labelledby="pencaharianModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h4 class="text-center mb-3">Jumlah Penduduk menurut Mata Pencaharian</h4>
        <div class="row">
          <div class="col-lg-12 mb-5">
            <canvas id="pencaharian"></canvas>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-7 mb-3 table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Mata Pencaharian</th>
                  <th>Jumlah Penduduk</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Pegawai negeri sipil</td>
                  <td>86</td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>Polisi</td>
                  <td>8</td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>Pedagang</td>
                  <td>14</td>
                </tr>
                <tr>
                  <td>5</td>
                  <td>Petani</td>
                  <td>9</td>
                </tr>
                <tr>
                  <td>6</td>
                  <td>Buruh tani</td>
                  <td>68</td>
                </tr>
                <tr>
                  <td>7</td>
                  <td>Karyawan swasta</td>
                  <td>407</td>
                </tr>
                <tr>
                  <td>8</td>
                  <td>Karyawan BUMN</td>
                  <td>13</td>
                </tr>
                <tr>
                  <td>9</td>
                  <td>Buruh harian lepas</td>
                  <td>798</td>
                </tr>
                <tr>
                  <td>10</td>
                  <td>Tukang jahit</td>
                  <td>18</td>
                </tr>
                <tr>
                  <td>11</td>
                  <td>Mekanik</td>
                  <td>2</td>
                </tr>
                <tr>
                  <td>12</td>
                  <td>Wiraswasta</td>
                  <td>682</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-header">
        <small><i>Klik di luar kotak untuk menutup panel</i></small>
      </div>
    </div>
  </div>
</div>
<!-- END MATA PENCAHARIAN -->

<!-- SARANA KESEHATAN MODAL -->
<div class="modal fade" id="kesehatanModal" tabindex="-1" role="dialog" aria-labelledby="kesehatanModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <h4 class="text-center mb-3">Prasarana Kesehatan</h4>
        <div class="row">
          <div class="col table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Sarana</th>
                  <th>Jumlah</th>
                  <th>Satuan</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Posyandu</td>
                  <td>8</td>
                  <td>unit</td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Puskesmas Pembantu</td>
                  <td>1</td>
                  <td>unit</td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>Poskesdes</td>
                  <td>1</td>
                  <td>unit</td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>Posbindu</td>
                  <td>4</td>
                  <td>unit</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-header">
        <small><i>Klik di luar kotak untuk menutup panel</i></small>
      </div>
    </div>
  </div>
</div>
<!-- END SARANA KESEHATAN MODAL -->


<!-- SARANA PENDIDIKAN MODAL -->
<div class="modal fade" id="sarPendidikanModal" tabindex="-1" role="dialog" aria-labelledby="sarPendidikanModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <h4 class="text-center mb-3">Prasarana Pendidikan</h4>
        <div class="row">
          <div class="col table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Sarana</th>
                  <th>Jumlah</th>
                  <th>Satuan</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Gedung Paud</td>
                  <td>4</td>
                  <td>unit</td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Gedung TK</td>
                  <td>2</td>
                  <td>unit</td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>Gedung SD</td>
                  <td>1</td>
                  <td>unit</td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>Taman Pendidikan Alqur'an</td>
                  <td>9</td>
                  <td>unit</td>
                </tr>
                <tr>
                  <td>5</td>
                  <td>Lembaga Bimbingan Belajar Paket B &amp; C</td>
                  <td>1</td>
                  <td>unit</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-header">
        <small><i>Klik di luar kotak untuk menutup panel</i></small>
      </div>
    </div>
  </div>
</div>
<!-- END SARANA PENDIDIKAN MODAL -->


<!-- SARANA EKONOMI MODAL -->
<div class="modal fade" id="ekonomiModal" tabindex="-1" role="dialog" aria-labelledby="ekonomiModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <h4 class="text-center mb-3">Prasarana Ekonomi</h4>
        <div class="row">
          <div class="col table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Sarana</th>
                  <th>Jumlah</th>
                  <th>Satuan</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Pasar desa</td>
                  <td>1</td>
                  <td>unit</td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Toko / warung</td>
                  <td>81</td>
                  <td>unit</td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>Warung makan</td>
                  <td>24</td>
                  <td>unit</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-header">
        <small><i>Klik di luar kotak untuk menutup panel</i></small>
      </div>
    </div>
  </div>
</div>
<!-- END SARANA EKONOMI MODAL -->


<!-- SARANA LAINNYA MODAL -->
<div class="modal fade" id="lainnyaModal" tabindex="-1" role="dialog" aria-labelledby="lainnyaModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <h4 class="text-center mb-3">Prasarana Lainnya</h4>
        <div class="row">
          <div class="col table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Sarana</th>
                  <th>Jumlah</th>
                  <th>Satuan</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Jalan</td>
                  <td>7,1</td>
                  <td>km</td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Sumur resapan</td>
                  <td>170</td>
                  <td>titik</td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>Penerangan jalan</td>
                  <td>340</td>
                  <td>titik</td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>Tempat Ibadah</td>
                  <td>12</td>
                  <td>unit</td>
                </tr>
                <tr>
                  <td>5</td>
                  <td>Lapangan Olahraga</td>
                  <td>2</td>
                  <td>unit</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-header">
        <small><i>Klik di luar kotak untuk menutup panel</i></small>
      </div>
    </div>
  </div>
</div>
<!-- END SARANA LAINNYA MODAL -->

<script type="text/javascript">
  $(function() {

    // var url = window.location.origin;
    // var arr = url.split("/");
    // var result = arr[0] + "//" + arr[2];
    // console.log(url);

    // ============================BASEMAP============================
    var basemap1 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '<a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    });
    var basemap2 = L.tileLayer('https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
      maxZoom: 20,
      subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
      attribution: 'Google Satellite | copyright @wira-geomaps'
    });
    var basemap3 = L.tileLayer('https://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}', {
      maxZoom: 20,
      subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
      attribution: 'Google Terrain | copyright @wira-geomaps'
    });
    var basemap4 = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
      attribution: 'Tiles &copy; Esri &mdash; Source: Esri and the GIS User Community'
    });

    // ============================CREATE MAP============================

    var map = L.map('maps', {
      center: [-7.838, 110.399],
      zoom: 16,
      layers: [basemap1, basemap2, basemap3, basemap4]
    });

    // ============================PANE LABEL============================

    map.createPane('labels');
    map.getPane('labels').style.zindex = 650;
    map.getPane('labels').style.pointerEvents = 'none';

    var positronLabels = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_only_labels/{z}/{x}/{y}.png', {
      attribution: '©OpenStreetMap, ©CartoDB',
      pane: 'labels'
    }).addTo(map);

    // ============================PANE DUSUN============================

    map.createPane("pane_dusun");
    map.getPane("pane_dusun").style.zIndex = 402;

    var dusun = L.geoJSON(null, {
      pane: "pane_dusun",
      style: function(feature) {
        // switch (feature.properties.Id) {
        //      case 0: return {fillColor: "#0B7A75", fillOpacity: 0.5, weight: 1, color: "#FFFFFF"};
        //      case 1: return {fillColor: "#D7C9AA", fillOpacity: 0.5, weight: 1, color: "#FFFFFF"};
        //      case 2: return {fillColor: "#7B2D26", fillOpacity: 0.5, weight: 1, color: "#FFFFFF"};
        //  }
        return {
          fillColor: "rgba(45, 216, 129,0)",
          fillOpacity: 0.6,
          color: "#2dd881",
          weight: 5,
          opacity: 0.5,
        };
      },
      /* Highlight & Popup */
      onEachFeature: function(feature, layer) {
        layer.on({
          mouseover: function(e) {
            var layer = e.target;
            layer.setStyle({
              weight: 2,
              color: "#00FFFF",
              opacity: 1,
              fillColor: "yellow",
              fillOpacity: 0.6,
            });

          },
          mouseout: function(e) {
            dusun.resetStyle(e.target);
            map.closePopup();
          },
          click: function(e) {

            $.post('<?= base_url('home/get_dukuh') ?>', {
              id: e.target.feature.properties.Id
            }, function(response) {

              var content = "<table class='table table-bordered'><tbody><tr><th scope='row'>ID</th><td>" + feature.properties.Id + "</td></tr><tr><th scope='row'>Pedukuhan</th><td>" + response.dukuh + "</td></tr><tr><th scope='row'>Jml Penduduk</th><td>" + response.penduduk + " jiwa</td></tr><tr><th scope='row'>Luas</th><td>" + response.luas + " m<sup>2</sup></td></tr></tbody></table><small><i>Klik untuk ubah data</i></small>";

              layer.bindPopup(content).openPopup();


            }, 'json');
            // feature.properties.Desa = "Singosaren";
            // var content = "<table class='table table-bordered'><tbody><tr><th scope='row'>Desa</th><td>"+feature.properties.Desa+"</td></tr><tr><th scope='row'>Dusun</th><td>"+feature.properties.Id+"</td></tr></tbody></table>";

            // dusun.bindPopup(content); //Popup
          }
        });
      }

    });

    $.getJSON("<?= base_url('assets/data_maps/batas_dusun.geojson') ?>", function(data) {
      if (jQuery.isEmptyObject(data)) {
        console.log("no data");
      } else {
        dusun.addData(data);
      }
    });

    // ============================END PANE DUSUN============================


    // ============================PANE DESA============================

    map.createPane("pane_desa");
    map.getPane("pane_desa").style.zIndex = 401;

    var desa = L.geoJSON(null, {
      pane: "pane_desa",
      style: function(feature) {
        return {
          fillColor: "#ffa69e",
          fillOpacity: 0,
          // color: "#ffa69e", 
          weight: 4,
          opacity: 1,
        };
      },
      /* Highlight & Popup */
      onEachFeature: function(feature, layer) {
        layer.on({
          mouseover: function(e) {
            var layer = e.target;
            layer.setStyle({
              weight: 2,
              color: "#00FFFF",
              opacity: 1,
              fillColor: "yellow",
              fillOpacity: 0.6,
            });
          },
          mouseout: function(e) {
            desa.resetStyle(e.target);
            map.closePopup();
          },
          click: function(e) {
            feature.properties.Desa = "Singosaren";
            var content = "<table class='table table-bordered'><tbody><tr><th scope='row'>Desa</th><td>" + feature.properties.Desa + "</td></tr><tr><th scope='row'>Luas</th><td>" + feature.properties.Luas + "</td></tr></tbody></table>";

            desa.bindPopup(content); //Popup
          }
        });
      }

    });

    $.getJSON("<?= base_url('assets/data_maps/batas_desa.geojson') ?>", function(data) {
      if (jQuery.isEmptyObject(data)) {
        console.log("no data");
      } else {
        desa.addData(data);
      }
    });

    // ============================END PANE DESA============================


    // ============================PANE RT============================

    map.createPane("pane_rt");
    map.getPane("pane_rt").style.zIndex = 403;

    var rt = L.geoJSON(null, {
      pane: "pane_rt",
      style: function(feature) {
        return {
          fillColor: "#rgba(169, 109, 163,0)",
          fillOpacity: 0,
          color: "#e57a44",
          weight: 2,
          opacity: 1,
        };
      },
      /* Highlight & Popup */
      onEachFeature: function(feature, layer) {
        layer.on({
          mouseover: function(e) {
            var layer = e.target;
            layer.setStyle({
              weight: 2,
              color: "#00FFFF",
              opacity: 1,
              fillColor: "yellow",
              fillOpacity: 0.6,
            });
          },
          mouseout: function(e) {
            rt.resetStyle(e.target);
            map.closePopup();
          },
          click: function(e) {

            $.post('<?= base_url('home/get_rt') ?>', {
              rt: e.target.feature.properties.RT,
              dukuh: e.target.feature.properties.Dukuh
            }, function(response) {

              var content = "<table class='table table-bordered'><tbody><tr><th scope='row'>RT</th><td>" + e.target.feature.properties.RT + "</td></tr><tr><th scope='row'>Pedukuhan</th><td>" + response.dukuh + "</td></tr><tr><th scope='row'>Jml Penduduk</th><td>" + response.penduduk_rt + " jiwa</td></tr><tr><th scope='row'>Luas</th><td>" + response.luas_rt + " m<sup>2</sup></td></tr></tbody></table><small><i>Klik untuk ubah data</i></small>";

              layer.bindPopup(content).openPopup();

            }, 'json');
            // feature.properties.Desa = "Singosaren";
            // var content = "<table class='table table-bordered'><tbody><tr><th scope='row'>Desa</th><td>"+feature.properties.Desa+"</td></tr><tr><th scope='row'>Dusun</th><td>"+feature.properties.Id+"</td></tr><tr><th scope='row'>RT</th><td>"+feature.properties.RT+"</td></tr></tbody></table>";

            // rt.bindPopup(content); //Popup
          }
        });
      }

    });

    $.getJSON("<?= base_url('assets/data_maps/batas_rt.geojson') ?>", function(data) {
      if (jQuery.isEmptyObject(data)) {
        console.log("no data");
      } else {
        rt.addData(data);
      }
    });

    // ============================END PANE RT============================


    // ============================PANE PERSIL============================

    map.createPane("pane_persil");
    map.getPane("pane_persil").style.zIndex = 404;

    var persil = L.geoJSON(null, {
      pane: "pane_persil",
      style: function(feature) {
        return {
          fillColor: "rgba(87, 217, 69, 0)",
          fillOpacity: 0.6,
          color: "black",
          weight: 0.5,
          opacity: 0.7,
        };
      },
      /* Highlight & Popup */
      onEachFeature: function(feature, layer) {
        layer.on({
          mouseover: function(e) {
            var layer = e.target;
            layer.setStyle({
              weight: 2,
              color: "#00FFFF",
              opacity: 1,
              fillColor: "yellow",
              fillOpacity: 0.6,
            });
          },
          mouseout: function(e) {
            persil.resetStyle(e.target);
            map.closePopup();
          },
          click: function(e) {

            var rt = e.target.feature.properties.RT;
            var dukuh = e.target.feature.properties.Dukuh;
            var no = e.target.feature.properties.Nomor;


            $.post('<?= base_url('home/get_persil') ?>', {
              no: no,
              rt: rt
            }, function(response) {
              if (response == null) {
                // code
                var content = "<table class='table table-bordered'><tbody><tr><th scope='row'>Nomor</th><td>" + e.target.feature.properties.Nomor + "</td></tr><tr><th scope='row'>RT</td><td>" + e.target.feature.properties.RT + "</td></tr></tbody></table>";

              } else {
                var content = "<table class='table table-bordered'><tbody><tr><th scope='row'>Nomor</th><td>" + no + "</td></tr><tr><th scope='row'>RT</td><td>" + rt + "</td></tr></tr><tr><th scope='row'>Pedukuhan</th><td>" + response.dukuh + "</td></tr><tr><th scope='row'>RW</th><td>" + response.rw + "</td></tr><tr><th scope='row'>Penduduk</th><td>" + response.penduduk + "</td></tr><tr><th scope='row'>Luas</th><td>" + response.luas + "</td></tr></tbody></table>";

              }

              // $('.card-body input#id').val(response.rt_id);

              persil.bindPopup(content); //Popup
            }, 'json');

            // $.post('<?= base_url('home/get_persil') ?>', {
            //   no: no,
            //   rt: rt
            // }, function(response) {
            //   console.log(response);
            //   if (response == null) {
            //     var content = "<table class='table table-bordered'><tbody><tr><th scope='row'>Nomor</th><td>" + no + "</td></tr><tr><th scope='row'>RT</td><td>" + rt + "</td></tr></tbody></table>";

            //   } else {

            //     var content = "<table class='table table-bordered'><tbody><tr><th scope='row'>Nomor</th><td>" + no + "</td></tr><tr><th scope='row'>RT</td><td>" + rt + "</td></tr></tr><tr><th scope='row'>Pedukuhan</th><td>" + response.dukuh + "</td></tr><tr><th scope='row'>RW</th><td>" + response.rw + "</td></tr><tr><th scope='row'>Penduduk</th><td>" + response.penduduk + "</td></tr><tr><th scope='row'>Luas</th><td>" + response.luas + "</td></tr></tbody></table>";

            //   }
            //   var content = "<table class='table table-bordered'><tbody><tr><th scope='row'>Nomor</th><td>" + no + "</td></tr><tr><th scope='row'>RT</td><td>" + rt + "</td></tr></tbody></table>";
            //   persil.bindPopup(content); //Popup
            // }, 'json');
            // feature.properties.Desa = "Singosaren";
            // var content = "<table class='table table-bordered'><tbody><tr><th scope='row'>Desa</th><td>" + feature.properties.Desa + "</td></tr><tr><th scope='row'>Dusun</th><td>" + feature.properties.Dukuh + "</td></tr><tr><th scope='row'>RT</td><td>" + feature.properties.RT + "</td></tr></tr><tr><th scope='row'>No Persil</th><td>" + feature.properties.Nomor + "</td></tr></tbody></table>";

            // persil.bindPopup(content); //Popup
          }
        });
      }

    });

    $.getJSON("<?= base_url('assets/data_maps/batas_persil.geojson') ?>", function(data) {
      if (jQuery.isEmptyObject(data)) {
        console.log("no data");
      } else {
        persil.addData(data);
      }
    });

    // ============================END PANE PERSIL============================


    // ============================PANE JALAN============================

    map.createPane("pane_jalan");
    map.getPane("pane_jalan").style.zIndex = 405;

    var jalan = L.geoJSON(null, {
      pane: "pane_jalan",
      style: function(feature) {
        return {
          fillColor: "#ecd444",
          fillOpacity: 0.6,
          color: "#ecd444",
          weight: 1,
          opacity: 0.5,
        };
      },
      /* Highlight & Popup */
      onEachFeature: function(feature, layer) {
        layer.on({
          mouseover: function(e) {
            var layer = e.target;
            layer.setStyle({
              weight: 2,
              color: "#00FFFF",
              opacity: 1,
              fillColor: "yellow",
              fillOpacity: 0.6,
            });
          },
          mouseout: function(e) {
            jalan.resetStyle(e.target);
            map.closePopup();
          },
          click: function(e) {
            feature.properties.Desa = "Singosaren";
            var content = "<table class='table table-bordered'><tbody><tr><td scope='row'>Jalan</td><td>" + feature.properties.Nomor + "</td></tr></tbody></table>";

            jalan.bindPopup(content); //Popup
          }
        });
      }

    });

    $.getJSON("<?= base_url('assets/data_maps/jalan.geojson') ?>", function(data) {
      if (jQuery.isEmptyObject(data)) {
        console.log("no data");
      } else {
        jalan.addData(data);
      }
    });

    // ============================END PANE JALAN============================


    //============================Foto Udara======================================

    var imagery = L.tileLayer('<?= base_url('assets/data_maps/') ?>tile/{z}/{x}/{y}.png', {
      minZoom: 13,
      maxZoom: 21,
      tms: false,
      attribution: 'Generated by WiraData-Geomaps'
    });
    // imagery.addTo(map)

    // var popup = L.popup();

    // function onMapClick(e) {
    //   var lat = e.latlng.lat.toString();
    //   var lng = e.latlng.lng.toString();
    //   var name = prompt();

    //   alert('Tempat ini adalah '+name+' yang berlokasi di '+lat+', '+lng);
    // popup
    //     .setLatLng(e.latlng)
    //     .setContent("You clicked the map at " + e.latlng.toString())
    //     .openOn(map);
    // }

    // map.on('click', onMapClick);

    // ============================CREATE LAYER CONTROL============================

    map.addLayer(dusun);

    var baseMaps = { //Pilihan Basemap
      'OpenStreetMap': basemap1,
      'Google Satellite': basemap2,
      'Google Stamen Terrain': basemap3,
      'ESRI World Imagery': basemap4,
    };

    var overlays = {
      'Desa': desa,
      'Dusun': dusun,
      'RT': rt,
      'Persil': persil,
      'Jalan': jalan,
      'Foto Udara': imagery
    }

    L.control.layers(baseMaps, overlays).addTo(map);


    //==============================Mouse Coordinate
    L.control.mousePosition({
      separator: ', ',
      prefix: 'Koordinat : '
    }).addTo(map);

    //========================Scale Bar================
    L.control.scale({
      maxWidth: 150,
      imperial: false,
    }).addTo(map);


    //============measuremet
    var measureControl = new L.Control.Measure({
      primaryLengthUnit: 'meters',
      secondaryLengthUnit: 'kilometers',
      primaryAreaUnit: 'hectares',
      secondaryAreaUnit: 'sqmeters',
      activeColor: 'green',
      completedColor: 'blue'
    });
    measureControl.addTo(map);

    //=============Geolocation
    var locateControl = L.control.locate({
      position: "topleft",
      drawCircle: true,
      follow: true,
      setView: true,
      keepCurrentZoomLevel: false,
      markerStyle: {
        weight: 1,
        opacity: 0.8,
        fillOpacity: 0.8,
      },
      circleStyle: {
        weight: 1,
        clickable: false,
      },
      icon: "fa fa-crosshairs",
      metric: true,
      strings: {
        title: "Klik untuk mengetahui lokasimu",
        popup: "Lokasimu sekarang di sini. Akurasi {distance} {unit}",
        outsideMapBoundsMsg: "Kamu berada di luar area peta"
      },
      locateOptions: {
        maxZoom: 15,
        watch: true,
        enableHighAccuracy: true,
        maximumAge: 10000,
        timeout: 10000
      }
    }).addTo(map);


  })
</script>