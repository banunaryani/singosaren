

    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

      <div class="row">
      	<!-- kolom data -->
      	<div class="overflow-auto col-5" style="max-height: 600px;">
      		<?= $this->session->flashdata('message'); ?>
      		<div class="card mb-2">
      			<div class="card-body px-3">
      				<div class="form-group">
	      				<small><span class="fas fa-fw fa-info-circle"></span> <i>Klik wilayah pada peta untuk mulai mengedit data</i></small>
	      				<br>
      				</div>
		      		<form class="data-peta" method="post" action="<?= base_url('admin/peta/') ?>">
		      			<div class="form-group row">
		      				<label class="col-4" for="id"><strong>ID</strong></label>
		      				<div class="col">
			      				<input type="text" class="form-control-plaintext" id="id" name="id" readonly>
		      				</div>
		      			</div>
		      			<div class="form-group row">
		      				<label class="col-4" for="persil"><strong>No. Persil</strong></label>
		      				<div class="col">
			      				<input type="text" class="form-control" id="persil" name="persil">
		      				</div>
		      			</div>
		      			<div class="form-group row">
		      				<label class="col-4" for="rt"><strong>RT</strong></label>
		      				<div class="col">
			      				<input type="text" class="form-control" id="rt" name="rt">
		      				</div>
		      			</div>
		      			<div class="form-group row">
		      				<label class="col-4" for="pedukuhan"><strong>Pedukuhan</strong></label>
		      				<div class="col">
			      				<input type="text" class="form-control" id="pedukuhan" name="pedukuhan">
		      				</div>
		      			</div>
		      			<div class="form-group row">
		      				<label class="col-4" for="pilihPedukuhan"><strong>Pedukuhan</strong></label>
		      				<div class="col">
			      				<select class="form-control" name="pilihPedukuhan" id="pilihPedukuhan">
			      					<?php foreach ($dukuh as $d) {
			      					?>
			      					<option value="<?= $d['id'] ?>"><?= $d['dukuh'] ?></option>
			      					<?php
			      					} ?>
			      				</select>
		      				</div>
		      			</div>

                <hr>

                <div class="form-group row">
                  <label class="col-4" for="rw"><strong>RW</strong></label>
                  <div class="col">
                    <input type="text" class="form-control" id="rw" name="rw">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-4" for="penduduk"><strong>Jml Penduduk</strong></label>
                  <div class="col">
                    <input type="text" class="form-control" id="penduduk" name="penduduk">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-4" for="luas"><strong>Luas Area (m<sup>2</sup>)</strong></label>
                  <div class="col">
                    <input type="text" class="form-control" id="luas" name="luas">
                  </div>
                </div>

		      			<div class="d-flex justify-content-end">
			      			<button type="submit" class="btn btn-primary"><span class="fas fa-fw fa-check"></span> Simpan</button>
		      			</div>
		      		</form>
      			</div>
      			<!-- end card body -->
      		</div>
      		<!-- end card -->

      		<div class="card">
      			<div class="card-body mx-2">
      				<nav>
      					<div class="nav nav-tabs" id="nav-tab" role="tablist">
      						<a class="nav-item nav-link active" id="nav-pedukuhan-tab" data-toggle="tab" href="#nav-pedukuhan" role="tab" aria-controls="nav-pedukuhan" aria-selected="true">Pedukuhan</a>
      						<a class="nav-item nav-link" id="nav-rt-tab" data-toggle="tab" href="#nav-rt" role="tab" aria-controls="nav-rt" aria-selected="false">RT</a>
      						<a class="nav-item nav-link" id="nav-persil-tab" data-toggle="tab" href="#nav-persil" role="tab" aria-controls="nav-persil" aria-selected="false">Persil</a>
      						<!-- <a class="nav-item nav-link" id="nav-jalan-tab" data-toggle="tab" href="#nav-jalan" role="tab" aria-controls="nav-jalan" aria-selected="false">Jalan</a> -->
      					</div>
      				</nav>
      				<div class="tab-content" id="nav-tabContent">
      					<div class="tab-pane fade show active" id="nav-pedukuhan" role="tabpanel" aria-labelledby="nav-pedukuhan-tab">
                  <div class="table-responsive">
        						<table class="table mt-3 tabel-pedukuhan">
        							<thead>
        								<tr>
        									<th scope="col">ID</th>
        									<th scope="col">Pedukuhan</th>
                          <th scope="col">Jml Penduduk</th>
                          <th scope="col">Luas (m<sup>2</sup>)</th>
        								</tr>
        							</thead>
        							<tbody>
        								<?php foreach ($dukuh as $d) {
        								?>
        								<tr id="<?= $d['id'] ?>">
        									<th scope="row"><?= $d['id'] ?></th>
        									<td><?= $d['dukuh'] ?></td>
                          <td><?= $d['penduduk'] ?></td>
                          <td><?= $d['luas'] ?></td>
        								</tr>
        								<?php
        								} ?>
        							</tbody>
        						</table>
                  </div>
      					</div>
      					<div class="tab-pane fade" id="nav-rt" role="tabpanel" aria-labelledby="nav-rt-tab">
                  <div class="table-responsive">
        						<table class="table mt-3 tabel-rt">
        							<thead>
        								<tr>
        									<th scope="col">RT</th>
        									<th scope="col">Pedukuhan</th>
                          <th scope="col">Jml Penduduk</th>
                          <th scope="col">Luas (m<sup>2</sup>)</th>
        								</tr>
        							</thead>
        							<tbody>
        								<?php foreach ($rt as $d) {
        								?>
        								<tr id="<?= $d['id'].'-'.$d['rt'] ?>">
        									<th><?= $d['rt'] ?></th>
        									<td><?= ($d['dukuh'])? $d['dukuh']:'[kosong]' ?></td>
                          <td><?= $d['penduduk'] ?></td>
                          <td><?= $d['luas'] ?></td>
        								</tr>
        								<?php
        								} ?>
        							</tbody>
        						</table>
                  </div>
      					</div>
      					<div class="tab-pane fade" id="nav-persil" role="tabpanel" aria-labelledby="nav-persil-tab">
                  <div class="table-responsive">
        						<table class="table mt-3 tabel-persil">
        							<thead>
        								<tr>
        									<th scope="col">Persil</th>
        									<th scope="col">RT</th>
                          <th scope="col">RW</th>
        									<th scope="col">Pedukuhan</th>
                          <th scope="col">Jml Penduduk</th>
                          <th scope="col">Luas (m<sup>2</sup>)</th>
        								</tr>
        							</thead>
        							<tbody>
        								<?php
        								foreach ($persil as $d) {
        								?>
        								<tr id="<?= $d['dukuh_id'].'-'.$d['rt'].'-'.$d['no_persil'] ?>">
        									<th><?= $d['no_persil'] ?></th>
        									<th><?= $d['rt'] ?></th>
                          <th><?= $d['rw'] ?></th>
        									<td><?= ($d['dukuh'])? $d['dukuh']:'[kosong]' ?></td>
                          <td><?= $d['penduduk'] ?></td>
                          <td><?= $d['luas'] ?></td>
        								</tr>
        								<?php
        								} ?>
        							</tbody>
        						</table>
                  </div>
      					</div>
      					<!-- <div class="tab-pane fade" id="nav-jalan" role="tabpanel" aria-labelledby="nav-jalan-tab">...j</div> -->
      				</div>
      			</div>
      		</div>
      	</div>
      	<!-- end kolom data -->

      	<!-- kolom peta -->
      	<div class="col">
	      	<div id="maps" style="height: 600px"></div>
      	</div>
      </div>

    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- End of Main Content -->

  <script type="text/javascript">
  $(function(){

  	$('.data-peta').hide();

  	$('.tabel-persil').DataTable({
  		paging: false
  	});
  	$('.tabel-rt').DataTable({
  		paging: false
  	});




    // var url = window.location.origin;
  // var arr = url.split("/");
  // var result = arr[0] + "//" + arr[2];
  // console.log(url);

  // ============================BASEMAP============================
  var basemap3 = L.tileLayer('https://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}', {
    maxZoom: 20,
    subdomains:['mt0','mt1','mt2','mt3'],
    attribution: 'Google Terrain | copyright @wira-geomaps'
  });
  var basemap4 = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
    attribution: 'Tiles &copy; Esri &mdash; Source: Esri and the GIS User Community'
  });

  // ============================CREATE MAP============================

  var map = L.map('maps', {
    center: [-7.838,110.399],
    zoom: 16,
    layers: [basemap3, basemap4]
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

  var dusun = L.geoJSON(null,{
    pane: "pane_dusun",
    style: function (feature) { 
       return {
        fillColor: "rgba(45, 216, 129,0)", 
        fillOpacity: 0.6, 
        color: "#2dd881", 
        weight: 5, 
        opacity: 0.5, 
      };
    },
    /* Highlight & Popup */
    onEachFeature: function (feature, layer) {
      layer.on({
        mouseover: function (e) { 
          var layer = e.target; 
          layer.setStyle({ 
            weight: 2, 
            color: "#00FFFF", 
            opacity: 0.4, 
            fillColor: "yellow", 
            fillOpacity: 0.4, 

          });

          $('.nav-tabs .nav-item#nav-pedukuhan-tab').tab('show');

    	  $('.tabel-pedukuhan tr#'+e.target.feature.properties.Id).addClass('table-active');

    	  $.post('<?= base_url('admin/peta/get_dukuh') ?>', {
        		id: e.target.feature.properties.Id
        	}, function(response){

	          var content = "<table class='table table-bordered'><tbody><tr><th scope='row'>ID</th><td>"+feature.properties.Id+"</td></tr><tr><th scope='row'>Pedukuhan</th><td>"+response.dukuh+"</td></tr><tr><th scope='row'>Jml Penduduk</th><td>"+response.penduduk+" jiwa</td></tr><tr><th scope='row'>Luas</th><td>"+response.luas+" m<sup>2</sup></td></tr></tbody></table><small><i>Klik untuk ubah data</i></small>";

	          layer.bindPopup(content).openPopup();

        	}, 'json');


        },
        mouseout: function (e) { 
          dusun.resetStyle(e.target); 
          map.closePopup(); 

          $('.tabel-pedukuhan tr#'+e.target.feature.properties.Id).removeClass('table-active');
        },
        click: function (e) {

        	var id = e.target.feature.properties.Id;

        	$('.data-peta').show();

        	$('.nav-tabs .nav-item#nav-pedukuhan-tab').tab('show');

        	$('.card-body input#pedukuhan').val('');
        	$('.card-body input#id').val(id);
          $('.card-body input#penduduk').val('');
          $('.card-body input#luas').val('');

        	$('.card-body input#persil').parents('.form-group').hide();
        	$('.card-body input#rt').parents('.form-group').hide();
        	$('.card-body select#pilihPedukuhan').parents('.form-group').hide();
          $('.card-body input#rw').parents('.form-group').hide();

        	$.post('<?= base_url('admin/peta/get_dukuh') ?>', {
        		id: id
        	}, function(response){
        		$('.card-body input#pedukuhan').val(response.dukuh);
            $('.card-body input#penduduk').val(response.penduduk);
            $('.card-body input#luas').val(response.luas);
        		// alert(response.dukuh);
        	}, 'json');

        	$('.data-peta').attr('action', '<?= base_url('admin/peta/edit_pedukuhan') ?>');
        }
      });
    }

  });



  $.getJSON("<?= base_url('assets/data_maps/batas_dusun.geojson') ?>", function(data) {
      if (jQuery.isEmptyObject(data)) {
          console.log("no data");
      }
      else {
          dusun.addData(data);
      }
  });


  // ============================END PANE DUSUN============================


  // ============================PANE DESA============================

  map.createPane("pane_desa");
  map.getPane("pane_desa").style.zIndex = 401;

  var desa = L.geoJSON(null,{
    pane: "pane_desa",
    style: function (feature) { 
      return {
        fillColor: "#ffa69e", 
        fillOpacity: 0, 
        // color: "#ffa69e", 
        weight: 4, 
        opacity: 1, 
      };
    },
    /* Highlight & Popup */
    onEachFeature: function (feature, layer) {
      layer.on({
        mouseover: function (e) { 
          var layer = e.target; 
          layer.setStyle({ 
            weight: 8, 
            color: "#00FFFF", 
            opacity: 1, 
            fillColor: "yellow", 
            fillOpacity: 0.6, 
          });
        },
        mouseout: function (e) { 
          desa.resetStyle(e.target); 
          map.closePopup(); 
        },
        click: function (e) {
          feature.properties.Desa = "Singosaren";
          var content = "<table class='table table-bordered'><tbody><tr><th scope='row'>Desa</th><td>"+feature.properties.Desa+"</td></tr><tr><th scope='row'>Luas</th><td>"+feature.properties.Luas+"</td></tr></tbody></table>";

          desa.bindPopup(content); //Popup
        }
      });
    }

  });

  $.getJSON("<?= base_url('assets/data_maps/batas_desa.geojson') ?>", function(data) {
      if (jQuery.isEmptyObject(data)) {
          console.log("no data");
      }
      else {
          desa.addData(data);
      }
  });

  // ============================END PANE DESA============================


  // ============================PANE RT============================

  map.createPane("pane_rt");
  map.getPane("pane_rt").style.zIndex = 404;

  var rt = L.geoJSON(null,{
    pane: "pane_rt",
    style: function (feature) { 
      return {
        fillColor: "#rgba(169, 109, 163,0)", 
        fillOpacity: 0, 
        color: "#e57a44", 
        weight: 2, 
        opacity: 1, 
      };
    },
    /* Highlight & Popup */
    onEachFeature: function (feature, layer) {
      layer.on({
        mouseover: function (e) { 
          var layer = e.target; 

          var rt = e.target.feature.properties.RT;
          var dukuh = e.target.feature.properties.Dukuh;

          $('.nav-tabs .nav-item#nav-rt-tab').tab('show');

          $('.tabel-rt tr#'+dukuh+'-'+rt).addClass('table-active');

    	  $.post('<?= base_url('admin/peta/get_rt') ?>', {
        		rt: e.target.feature.properties.RT,
            dukuh: e.target.feature.properties.Dukuh
        	}, function(response){

            console.log(response);

	          var content = "<table class='table table-bordered'><tbody><tr><th scope='row'>RT</th><td>"+e.target.feature.properties.RT+"</td></tr><tr><th scope='row'>Pedukuhan</th><td>"+response.dukuh+"</td></tr><tr><th scope='row'>Jml Penduduk</th><td>"+response.penduduk_rt+" jiwa</td></tr><tr><th scope='row'>Luas</th><td>"+response.luas_rt+" m<sup>2</sup></td></tr></tbody></table><small><i>Klik untuk ubah data</i></small>";

	          layer.bindPopup(content).openPopup();

        	}, 'json');

          layer.setStyle({ 
            weight: 2, 
            color: "#00FFFF", 
            opacity: 1, 
            fillColor: "yellow", 
            fillOpacity: 0.6, 
          });

        },
        mouseout: function (e) { 
          rt.resetStyle(e.target); 
          map.closePopup(); 
          $('.tabel-rt tr').removeClass('table-active');
        },
        click: function (e) {

        	$('.data-peta .form-group').show();

        	$('.nav-tabs .nav-item#nav-rt-tab').tab('show');

        	var rt = e.target.feature.properties.RT;
        	var dukuh = e.target.feature.properties.Dukuh;

        	$('.data-peta').show();

        	$('.card-body input#rt').val('');
          $('.card-body input#penduduk').val('');
          $('.card-body input#luas').val('');
        	$('.card-body select#pilihPedukuhan option').removeAttr('selected');
        	$('.card-body input#pedukuhan').parents('.form-group').hide();
        	$('.card-body input#id').parents('.form-group').hide();
          $('.card-body input#rw').parents('.form-group').hide();

        	$('.card-body input#persil').parents('.form-group').hide();

        	$.post('<?= base_url('admin/peta/get_rt') ?>', {
        		rt: rt,
            dukuh: dukuh
        	}, function(response){
        		$('.card-body select#pilihPedukuhan option[value='+response.dukuh_id+']').attr('selected','selected');
        		$('.card-body input#rt').val(response.rt);
            $('.card-body input#penduduk').val(response.penduduk_rt);
            $('.card-body input#luas').val(response.luas_rt);
        		// $('.card-body input#id').val(response.rt_id);
        		// alert(response.dukuh);
        	}, 'json');

        	$('.data-peta').attr('action', '<?= base_url('admin/peta/edit_rt') ?>');

        }
      });
    }

  });

  $.getJSON("<?= base_url('assets/data_maps/batas_rt.geojson') ?>", function(data) {
      if (jQuery.isEmptyObject(data)) {
          console.log("no data");
      }
      else {
          rt.addData(data);
      }
  });

  // ============================END PANE RT============================


  // ============================PANE PERSIL============================

  map.createPane("pane_persil");
  map.getPane("pane_persil").style.zIndex = 405;

	var i = 0;
	map.eachLayer(function(){ i += 1; });
	console.log('Map has', i, 'layers.');

  var persil = L.geoJSON(null,{
    pane: "pane_persil",
    style: function (feature) { 
      return {
        fillColor: "rgba(87, 217, 69, 0)", 
        fillOpacity: 0.6, 
        color: "black", 
        weight: 0.5, 
        opacity: 1, 
      };
    },
    /* Highlight & Popup */
    onEachFeature: function (feature, layer) {
      layer.on({
        mouseover: function (e) { 
          var layer = e.target; 
          layer.setStyle({ 
            weight: 2, 
            color: "#00FFFF", 
            opacity: 1, 
            fillColor: "yellow", 
            fillOpacity: 0.6, 
          });

          var rt = e.target.feature.properties.RT;
          var dukuh = e.target.feature.properties.Dukuh;
          var no = e.target.feature.properties.Nomor;

          $('.nav-tabs .nav-item#nav-persil-tab').tab('show');

          $('.tabel-persil tr#'+dukuh+'-'+rt+'-'+no).addClass('table-active');
        },
        mouseout: function (e) { 
          persil.resetStyle(e.target); 
          map.closePopup(); 
          var rt = e.target.feature.properties.RT;
          var dukuh = e.target.feature.properties.Dukuh;
          var no = e.target.feature.properties.Nomor;
          $('.tabel-persil tr#'+dukuh+'-'+rt+'-'+no).removeClass('table-active');
        },
        click: function (e) {
        	$('.data-peta .form-group').show();

        	$('.nav-tabs .nav-item#nav-persil-tab').tab('show');

        	var rt = e.target.feature.properties.RT;
        	var dukuh = e.target.feature.properties.Dukuh;
        	var no = e.target.feature.properties.Nomor;

        	$('.data-peta').show();

        	$('.card-body input#rt').val('');
          $('.card-body input#penduduk').val('');
          $('.card-body input#luas').val('');
        	$('.card-body select#pilihPedukuhan option').removeAttr('selected');
        	$('.card-body input#persil').val('');

        	$('.card-body input#pedukuhan').parents('.form-group').hide();
        	$('.card-body input#id').parents('.form-group').hide();


        	$.post('<?= base_url('admin/peta/get_dukuh') ?>', {
        		id: dukuh
        	}, function(response){
        		$('.card-body select#pilihPedukuhan option[value='+response.id+']').attr('selected','selected');
        		$('.card-body input#rt').val(rt);
	        	$('.card-body input#persil').val(no);
        		// $('.card-body input#id').val(response.rt_id);
	          var content = "<table class='table table-bordered'><tbody><tr><th scope='row'>Nomor</th><td>"+no+"</td></tr><tr><th scope='row'>RT</td><td>"+rt+"</td></tr></tr><tr><th scope='row'>Pedukuhan</th><td>"+response.dukuh+"</td></tr><tr><th scope='row'>RW</th><td>"+response.rw+"</td></tr><tr><th scope='row'>Penduduk</th><td>"+response.penduduk+"</td></tr><tr><th scope='row'>Luas</th><td>"+response.luas+"</td></tr></tbody></table>";

	          persil.bindPopup(content); //Popup
        	}, 'json');

        	$('.data-peta').attr('action', '<?= base_url('admin/peta/edit_persil') ?>');

        }
      });
    }

  });

  map.on('overlayadd',function(e){
  	let i = 0;
  	e.layer.eachLayer(function(){ i += 1; });
	console.log('Map has', i, 'layers.');
  });

  $.getJSON("<?= base_url('assets/data_maps/batas_persil.geojson') ?>", function(data) {
      if (jQuery.isEmptyObject(data)) {
          console.log("no data");
      }
      else {
          persil.addData(data);
      }
  });

  // ============================END PANE PERSIL============================


  // ============================PANE JALAN============================

  map.createPane("pane_jalan");
  map.getPane("pane_jalan").style.zIndex = 406;

  var jalan = L.geoJSON(null,{
    pane: "pane_jalan",
    style: function (feature) { 
      return {
        fillColor: "#ecd444", 
        fillOpacity: 0.6, 
        color: "#ecd444", 
        weight: 1, 
        opacity: 0.5, 
      };
    },
    /* Highlight & Popup */
    onEachFeature: function (feature, layer) {
      layer.on({
        mouseover: function (e) { 
          var layer = e.target; 
          layer.setStyle({ 
            weight: 2, 
            color: "#00FFFF", 
            opacity: 1, 
            fillColor: "yellow", 
            fillOpacity: 0.6, 
          });
        },
        mouseout: function (e) { 
          jalan.resetStyle(e.target); 
          map.closePopup(); 
        },
        click: function (e) {
          feature.properties.Desa = "Singosaren";
          var content = "<table class='table table-bordered'><tbody><tr><td scope='row'>Jalan</td><td>"+feature.properties.Nomor+"</td></tr></tbody></table>";

          jalan.bindPopup(content); //Popup
        }
      });
    }

  });

  $.getJSON("<?= base_url('assets/data_maps/jalan.geojson') ?>", function(data) {
      if (jQuery.isEmptyObject(data)) {
          console.log("no data");
      }
      else {
          jalan.addData(data);
      }
  });

  // ============================END PANE JALAN============================

    // $('.tabel-pedukuhan tr[id]').on('click',function(e){
    //       console.log(dusun.options);
    //   // dusun.options.onEachFeature(function(feature,layer){
    //   // });

    // })

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
    'Google Stamen Terrain': basemap3,
    'ESRI World Imagery': basemap4
  };

  var overlays = {
    'Desa' : desa,
    'Dusun' : dusun,
    'RT' : rt,
    'Persil' : persil,
    'Jalan' : jalan,
    'Foto Udara' : imagery
  }

  L.control.layers(baseMaps, overlays).addTo(map);

  })
</script>

  