<?= $this->extend('frontend/layouts/template'); ?>

<?= $this->section('title'); ?>
Galeri
<?= $this->endSection(); ?>

<?= $this->section('style'); ?>
<style>
    #toggleFilterBtn {
        display: none;
    }

    #filterSection {
        display: block;
    }

    @media (max-width: 767px) {
        #filterSection {
            display: none;
        }

        #toggleFilterBtn {
            display: block;
        }
    }
</style>

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-lg-12 mb-5 mb-lg-0">
        <h2>Denah Pasar Beringharjo</h2>
        <hr>
        <div class="row">
            <div class="col-lg-3">
                <button id="toggleFilterBtn" class="btn btn-primary btn-sm my-2"><i class="fas fa-filter"></i> Filter Denah</button>
                <div id="filterSection">
                    <h4>Filter</h4>
                    <form action="#" method="post">
                        <div class="form-group">
                            <label for="">Lantai</label>
                            <select name="" id="" class="form-control">
                                <option value="">1</option>
                                <option value="">2</option>
                                <option value="">3</option>
                            </select>
                        </div>

                        <!-- <div class="form-group">
                            <label for="">Lokasi</label>
                            <select name="" id="" class="form-control">
                                <option value="">Beringharjo Barat (Pakaian)</option>
                                <option value="">Beringharjo Timur (Makanan)</option>
                                <option value="">Beringharjo Tengah (Kerajinan)</option>
                            </select>
                        </div> -->


                        <button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-search"></i> Cari </button>
                    </form>
                </div>

            </div>

            <div class="col-lg-9">
                <!-- <hr>
                <div class="row">
                    <div class="col">
                        <i class="fas fa-square" style="color:rgba(108, 245, 66, 0.5);"></i> Beringharjo Barat
                        <i class="fas fa-square" style="color:rgba(245, 230, 66, 0.5);"></i> Beringharjo Tengah
                        <i class="fas fa-square" style="color:rgba(245, 66, 129, 0.5);"></i> Berigharjo Timur
                    </div>
                </div>
                <hr> -->



                <div id="divMap" style="position:relative;width:60vw;height:400px;background:#FFF;"></div>
            </div>

        </div>
        <div class="mt-5"></div>

        <div class="owl-carousel">
            <?php
            for ($i = 0; $i < 10; $i++) {
                ?>
                <div class="card mx-2">
                    <div class="card-body" style="width:100%;border-radius:10px;border:1px solid #000;display:flex; justify-content:center;">
                        Pakaian
                    </div>
                </div>
            <?php
            }
?>
        </div>

        <h1>Lihat Toko lainnya</h1>
        <div class="row mt-5">
            <?php foreach ($toko['data'] as $item) : ?>
                <div class="col-md-3">
                    <a href="<?= base_url('denah/toko/' . $item['slug']) ?>">
                        <div class="card" style="width: 18rem;">
                            <img src="https://api2.kemenparekraf.go.id/storage/app/uploads/public/620/b45/0e4/620b450e4dc53482958166.jpg" class="card-img-top" alt="Batik 3 Bersaudara">
                            <div class="card-body">
                                <h4 class="card-title"><?= $item['name']; ?></h4>
                                <p class="card-text">Lantai : <?= $item['lantai']; ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach ?>
        </div>

        <?= $toko['page']->links(); ?>




    </div>
</div>
<?= $this->endSection(); ?>



<?= $this->section('script'); ?>

<script src="<?= base_url('assets/js/bing-map-script.js') ?>"></script>
<script>
    var mapOptions = null;
    var curPos = null;
    var map = null;
    var area = null;

    $(document).ready(function() {
        // Load the Bing Maps module before initializing the map
        Microsoft.Maps.loadModule('Microsoft.Maps.Map', {
            callback: initializeMap()
        });

        // Initial call to set the width when the page loads
        setDivMapWidth();

        $('#toggleFilterBtn').on('click', function() {
            $('#filterSection').toggle();
        });
    });
    // Function to set the width of divMap based on screen size
    function setDivMapWidth() {
        var screenWidth = $(window).width();
        var divMap = $('#divMap');

        // Set the width based on screen size
        if (screenWidth <= 767) { // Adjust this value based on your mobile screen size threshold
            divMap.css('width', '100vw'); // Set full width for mobile screens
        } else {
            divMap.css('width', '100%'); // Set 50% width for screens larger than mobile
        }
    }

    // Event listener to update the width when the window is resized
    $(window).resize(function() {
        setDivMapWidth();
    });

    var baseArea = new Microsoft.Maps.Polygon([
        new Microsoft.Maps.Location(-7.798376, 110.365255),
        new Microsoft.Maps.Location(-7.798568, 110.366441),
        new Microsoft.Maps.Location(-7.799140, 110.366381),
        new Microsoft.Maps.Location(-7.799047, 110.365182),
    ], null);

    function addPolygon(map, bagian = "BaseArea") {

        // base area
        baseArea.setOptions({ fillColor: 'rgba(108, 245, 66, 0.5)' });
        map.entities.push(baseArea);
    }



    function initializeMap() {
        curPos = new Microsoft.Maps.Location(-7.798661, 110.365318);

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

        setInterval(function() {
            navigator.geolocation.getCurrentPosition(showRecentLocation, OnError);
        }, 500);
        addPolygon(map);
        fetchAllPins();
    }

    function fetchAllPins() {
        var data = JSON.parse('<?= $toko['coords']; ?>');

        var customPinSVG = "<?= base_url('assets/images/market-icon.png') ?>";
        var iconSize = new Microsoft.Maps.Size(2, 2);

        data.forEach(element => {
            var position = new Microsoft.Maps.Location(element['lat'], element['lng'])
            // kondisi awal ketika halaman di load
            var pin = new Microsoft.Maps.Pushpin(position, {
                icon: customPinSVG, // Set the custom SVG as the pin icon
                anchor: new Microsoft.Maps.Point(12, 24),
                width: iconSize.width,
                height: iconSize.height
            });

            map.entities.push(pin);
        });
    }

    function showRecentLocation(position) {
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


    function OnError(err) {
        alert(err.message);
        var calloutOptions = {
            title: "Location Information",
            description: "This is the default location."
        };
        var defaultPos = new Microsoft.Maps.Location(-7.798661, 110.365318);
    }
</script>
<?= $this->endSection(); ?>