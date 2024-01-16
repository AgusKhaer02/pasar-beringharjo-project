<?= $this->extend('frontend/layouts/template'); ?>


<?= $this->section('title'); ?>
Ubah Profil Toko
<?= $this->endSection(); ?>


<?= $this->section('style'); ?>
<style>
  /* Style for the unchecked state */
  input[type="radio"] {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    outline: none;
    width: 20px;
    /* Set your desired width */
    height: 20px;
    /* Set your desired height */
    border: 2px solid #00ff00;
    /* Green rectangular border */
    border-radius: 4px;

    /* Optional: Add rounded corners */
  }

  /* Style for the checked state */
  input[type="radio"]:checked {
    background-color: #00ff00;
    /* Green background when checked */
  }

  #drop-container {
    border: 2px dashed #ccc;
    padding: 20px;
    text-align: center;
  }

  #image-preview {
    max-width: 100%;
    max-height: 300px;
    margin-top: 10px;
  }
</style>
<?= $this->endSection(); ?>



<?= $this->section('content'); ?>
<section class="h-100 gradient-custom-2">
  <form action="<?= base_url('toko/update-profile') ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="PUT">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-lg-12 col-xl-12">
          <div class="card">
            <div class="rounded-top text-white d-flex flex-row" style="background: url('https://batikkhasdaerah.com/wp-content/uploads/2022/06/Kesan-dari-batik-Jogja-dan-Solo-memiliki-perbedaan.jpg') no-repeat fixed center; background-size:cover; height:200px;">

              <!-- Ubah Foto Profil -->
              <div class="modal fade" id="fotoSampulModal" tabindex="-1" role="dialog" aria-labelledby="fotoSampulModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="fotoSampulModalLabel">Ubah Foto Sampul</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Selesai</button>
                    </div>
                  </div>
                </div>
              </div>
              <button type="button" class="btn btn-info btn-sm" style="position: absolute;right:0px; top:10rem;" data-toggle="modal" data-target="#fotoSampulModal"><i class="fas fa-image"></i> Ubah Sampul</button>

              <div class="ms-4 mt-5 d-flex flex-column" style="width:150px;">
                <img src="<?= base_url('assets/images/toko-placeholder.png') ?>" alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2" style="width: 150px; z-index: 1">
                <button type="button" class="btn btn-info btn-sm p-2" data-toggle="modal" data-target="#fotoProfiModal"><i class="fas fa-image"></i> Ubah Foto Profil</button>

                <!-- Ubah Foto Profil -->
                <div class="modal fade" id="fotoProfiModal" tabindex="-1" role="dialog" aria-labelledby="fotoProfiModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="fotoProfiModalLabel">Ubah Foto Profil</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div id="drop-container">
                          <p>Drag and drop an image or click to choose a file</p>
                          <input type="file" id="file-input" style="width:40%; background:#DDD;" accept="image/*"> <br>
                          <img id="image-preview" alt="Preview">
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Selesai</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="ml-3 text-light" style="margin-top: 130px;">
                <h1 class="text-light" style="text-shadow: 2px 2px #023300;"><?= $toko['name']; ?></h1>
              </div>
            </div>

            <div class="card-body p-4 text-black mt-2">
              <div class="d-flex justify-content-between align-items-center mb-4">
                <p class="lead fw-normal mb-0">Detail Info</p>
              </div>
              <input type="text" value="<?= session('id_toko'); ?>" name="id_toko" hidden>
              <div class="row">
                <div class="col-md-6">
                  <!-- nomor telp -->
                  <div class="form-group">
                    <label for="exampleInputNoTelp1">Nomor Telepon</label>
                    <input type="number" class="form-control" name="no_telp" id="exampleInputNoTelp1" aria-describedby="noTelpHelp" value="<?= $toko['no_telp']; ?>" required>
                    <small id="noTelpHelp" class="form-text text-muted">Pastikan gunakan nomor telepon yang aktif</small>
                  </div>

                  <!-- alamat -->
                  <div class="form-group">
                    <label for="exampleInputNoTelp1">Alamat</label> <br>
                    <textarea name="address" class="form-control" id="" cols="30" rows="5" required><?= $toko['address']; ?></textarea>
                  </div>

                  <!-- pilih lokasi bagiannya -->
                  <div class="form-group">
                    <label for="selectLokasi">Lokasi Bagian Pasar</label>
                    <select name="id_lokasi" class="form-control">
                      <option value="" disabled selected>== Pilih Bagiannya == </option>
                      <?php foreach ($lokasi as $item) : ?>
                        <option value="<?= $item['id']; ?>" <?= ($toko['id_lokasi'] == $item['id']) ? 'selected' : '' ?>><?= $item['bagian']; ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>

                </div>
                <div class="col-md-6">

                  <!-- lokasi (titik koordinat) -->
                  <label>Pilih Lokasi</label>
                  <div id="divMap" style="position:relative;width:100%;height:400px;"></div>
                  <buttom id="btnLocationNow" class="btn btn-warning btn-sm mt-2">Ambil Lokasi Sekarang</buttom>
                  <input type="text" name="coordinate" value="<?= $toko['coordinate']; ?>" id="txtCoordinate" hidden>
                  <br><br>

                  <!-- lokasi lantai (1,2,3) -->
                  <label>Lokasi Lantai</label>
                  <div class="form-check">
                    <?php
                    $maxLantai = 3;
                    for ($lantai = 1; $lantai <= $maxLantai; $lantai++) {
                    ?>
                      <?php if ($lantai == (int) $toko['lantai']) : ?>
                        <input type="radio" id="lantaiRadio" name="lantai" value="<?= $lantai; ?>" checked>
                        <label for="">Lantai <?= $lantai; ?></label>

                      <?php else : ?>
                        <input type="radio" id="lantaiRadio" name="lantai" value="<?= $lantai; ?>">
                        <label for="">Lantai <?= $lantai; ?></label>
                      <?php endif ?>
                    <?php
                    }
                    ?>
                  </div>
                </div>

              </div>
              <button type="submit" id="submit" class="btn btn-primary">Selesai</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</section>
<?= $this->endSection(); ?>


<?= $this->section('script'); ?>
<script src="<?= base_url('assets/js/bing-map-script.js') ?>"></script>
<script>
  var mapOptions = null;
  var curPos = null;
  var map = null;
  var area = null;


  function setCoordsValueToText(lat, lng) {
    var coordinates = {
      "lat": lat,
      "lng": lng
    };
    var coordinate = JSON.stringify(coordinates);
    $('#txtCoordinate').val(coordinate);
  }

  $(document).ready(function() {
    // Load the Bing Maps module before initializing the map
    Microsoft.Maps.loadModule('Microsoft.Maps.Map', {
      callback: initializeMap()
    });

    dropContainer();
  });

  function dropContainer() {
    const $dropContainer = $("#drop-container");
    const $fileInput = $("#file-input");
    const $imagePreview = $("#image-preview");

    $dropContainer.on("dragover", (e) => {
      e.preventDefault();
      $dropContainer.addClass("drag-active");
    });

    $dropContainer.on("dragleave", () => {
      $dropContainer.removeClass("drag-active");
    });

    $dropContainer.on("drop", (e) => {
      e.preventDefault();
      $dropContainer.removeClass("drag-active");

      if (e.originalEvent.dataTransfer.files.length > 0) {
        const file = e.originalEvent.dataTransfer.files[0];
        displayImage(file);
      }
    });

    $dropContainer.on("click", () => {
      $fileInput.click();
    });

    $fileInput.on("change", function() {
      const file = this.files[0];
      displayImage(file);
    });

    function displayImage(file) {
      if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
          $imagePreview.attr("src", e.target.result);
        };

        reader.readAsDataURL(file);
      }
    }
  }

  function inputFile() {
    $('#file-input').change(function(event) {
      const fileInput = event.target;
      const file = fileInput.files[0];

      if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
          $('#image-preview').html(`<img src="${e.target.result}" alt="Preview">`);
        };

        reader.readAsDataURL(file);
      }
    });
  }

  function initializeMap() {
    curPos = new Microsoft.Maps.Location(-7.798661, 110.365318);

    setCoordsValueToText(-7.798661, 110.365318);

    mapOptions = {
      credentials: '<?= $bingMapsAPIKey ?>',
      center: curPos,
      mapTypeId: Microsoft.Maps.MapTypeId.road,
      zoom: 20
    };

    map = new Microsoft.Maps.Map($("#divMap").get(0), mapOptions);

    // kondisi awal ketika halaman di load
    var pin = new Microsoft.Maps.Pushpin(curPos);
    map.entities.push(pin);

    map.setView({
      center: curPos,
      zoom: 20
    });

    $("#btnLocationNow").click(function(e) {
      navigator.geolocation.getCurrentPosition(showRecentLocation, OnError);
    });
    area = addPolygon(map, null);
    pickLocation();
  }

  function showRecentLocation(position) {
    // map.entities.clear();

    var recentLocation = new Microsoft.Maps.Location(position.coords.latitude, position.coords.longitude);

    if (isLocationInsidePolygon(recentLocation, area)) {
      // console.log("location " + position.coords.latitude + ", " + position.coords.longitude);
      var pin = new Microsoft.Maps.Pushpin(recentLocation);
      map.entities.push(pin);

      map.setView({
        center: recentLocation,
        zoom: 20 // Adjust the zoom level as needed
      });

      // set to text untuk submit titik koordinat
      setCoordsValueToText(position.coords.latitude, position.coords.longitude);
    } else {
      alert("Tidak dapat menempatkan pin : Anda berada di luar pasar beringharjo.");
    }
  }

  function isLocationInsidePolygon(location, polygon) {
    // Convert the polygon's array of locations to an array of LatLng objects
    var polygonCoords = polygon.getLocations().map(function(loc) {
      return new Microsoft.Maps.Location(loc.latitude, loc.longitude);
    });

    // Create a bounding box (rectangle) that contains the polygon
    var boundingBox = Microsoft.Maps.LocationRect.fromLocations(polygonCoords);

    // Check if the location is inside the bounding box
    return boundingBox.contains(location);
  }

  function pickLocation() {
    // Add click event listener to the map
    Microsoft.Maps.Events.addHandler(map, 'click', function(e) {
      // Get the coordinates of the clicked point
      var location = e.location;

      if (isLocationInsidePolygon(location, area)) {
        // Clear existing pushpins
        map.entities.clear();

        clearAllInfoboxes();
        addPolygon(map);
        // Add a pushpin for the selected location
        var pin = new Microsoft.Maps.Pushpin(location);
        map.entities.push(pin);
        // set to text untuk submit titik koordinat
        setCoordsValueToText(location.latitude, location.longitude);
      } else {
        alert("Tidak dapat menempatkan pin : Silahkan pilih lokasi hanya di sekitar lokasi pasar beringharjo.");
      }

    });
  }

  function clearAllInfoboxes() {
    // Iterate through the entities and remove only infobox entities
    for (var i = map.entities.getLength() - 1; i >= 0; i--) {
      var entity = map.entities.get(i);
      if (entity instanceof Microsoft.Maps.Infobox) {
        map.entities.remove(entity);
      }
    }
  }


  function OnError(err) {
    alert(err.message);
    var calloutOptions = {
      title: "Location Information",
      description: "This is the default location."
    };
    var defaultPos = new Microsoft.Maps.Location(-7.798661, 110.365318);
    var callout = new Microsoft.Maps.Infobox(defaultPos, calloutOptions);
    map.entities.push(callout);
  }
</script>
<?= $this->endSection(); ?>