<?= $this->extend('frontend/layouts/template'); ?>


<?= $this->section('title'); ?>
Lengkapi Data Anda
<?= $this->endSection(); ?>


<?= $this->section('content'); ?>
<section class="h-100 gradient-custom-2">
    <form action="<?= base_url('toko/submit-more-info') ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT">

        <div class="container py-2 h-100">

            <h1>Lengkapi Data Anda</h1>
            <hr>
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-12 col-xl-12">
                    <div class="card">

                        <div class="rounded-top text-white d-flex flex-row" style="background: url('https://batikkhasdaerah.com/wp-content/uploads/2022/06/Kesan-dari-batik-Jogja-dan-Solo-memiliki-perbedaan.jpg') no-repeat fixed center; background-size:cover; height:200px;">
                            <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
                                <img src="<?= base_url('assets/images/toko-placeholder.png') ?>" alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2" style="width: 150px; z-index: 1">
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
                                    <div class="form-group">
                                        <label for="exampleInputNoTelp1">Nomor Telepon</label>
                                        <input type="number" class="form-control" name="no_telp" placeholder="08XXXXXXX" id="exampleInputNoTelp1" aria-describedby="noTelpHelp" required>
                                        <small id="noTelpHelp" class="form-text text-muted">Pastikan gunakan nomor telepon yang aktif</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputNoTelp1">Alamat</label> <br>
                                        <textarea name="address" class="form-control" id="" cols="30" rows="5" placeholder="Alamat lengkap anda...." required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Pilih Lokasi</label>
                                    <div id="divMap" style="position:relative;width:100%;height:400px;"></div>
                                    <buttom id="btnLocationNow" class="btn btn-warning btn-sm mt-2">Ambil Lokasi Sekarang</buttom>
                                    <input type="text" name="coordinate" id="txtCoordinate" hidden>
                                    <br><br>
                                    <label>Lokasi Lantai</label>
                                    <div class="form-check">

                                        <input type="radio" class="form-check-input" id="option1" name="lantai" value="1" checked>
                                        <label class="form-check-label mr-5" for="option1">Lantai 1</label>

                                        <input type="radio" class="form-check-input" id="option2" name="lantai" value="2">
                                        <label class="form-check-label mr-5" for="option2">Lantai 2</label>

                                        <input type="radio" class="form-check-input" id="option2" name="lantai" value="3">
                                        <label class="form-check-label" for="option2">Lantai 3</label>
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
    var baseArea = new Microsoft.Maps.Polygon([
        new Microsoft.Maps.Location(-7.798376, 110.365255),
        new Microsoft.Maps.Location(-7.798568, 110.366441),
        new Microsoft.Maps.Location(-7.799140, 110.366381),
        new Microsoft.Maps.Location(-7.799047, 110.365182),
    ], null);

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


    });

    function initializeMap() {
        curPos = new Microsoft.Maps.Location(-7.798661, 110.365318);

        setCoordsValueToText(-7.798661, 110.365318);

        mapOptions = {
            credentials: 'AjW6-dZZoaykuiVK9bgOrU5QLbDs9npiO77bQ6LRQEJvyfcULC7wT77-ByTsmiwv',
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
        addPolygon(map);
        pickLocation();
    }

    function showRecentLocation(position) {
        // map.entities.clear();

        var recentLocation = new Microsoft.Maps.Location(position.coords.latitude, position.coords.longitude);

        if (isLocationInsidePolygon(recentLocation, baseArea)) {
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

    function pickLocation() {
        // Add click event listener to the map
        Microsoft.Maps.Events.addHandler(map, 'click', function(e) {
            // Get the coordinates of the clicked point
            var location = e.location;

            if (isLocationInsidePolygon(location, baseArea)) {
                // Clear existing pushpins
                map.entities.clear();

                clearAllInfoboxes(map);
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