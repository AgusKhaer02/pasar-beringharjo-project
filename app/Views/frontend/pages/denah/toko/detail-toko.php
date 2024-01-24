<?= $this->extend('frontend/layouts/template'); ?>

<?= $this->section('title'); ?>
Galeri
<?= $this->endSection(); ?>



<?= $this->section('content'); ?>
<div class="row">
    <div class="col-lg-12 mb-5 mb-lg-0">
        <h2><?= $toko['name']; ?></h2>
        <div style="width:100%;display:flex;justify-content:center;">
            <div id="divMap" style="position:relative;width:60vw;height:400px;"></div>
        </div>
        <div class="mt-5"></div>

        <h1>Produk</h1>
        <div class="row mt-5">
            <?php foreach ($produk as $item) : ?>
                <div class="col-md-3">
                    <a href="<?= base_url('denah/toko/produk/'.$item['slug'])?>">
                        <div class="card" style="width: 18rem;">
                            <img src="https://api2.kemenparekraf.go.id/storage/app/uploads/public/620/b45/0e4/620b450e4dc53482958166.jpg" class="card-img-top" alt="Batik 3 Bersaudara">
                            <div class="card-body">
                                <h4 class="card-title"><?= $item['nama'] ?></h4>
                                <h4>Rp <?= $item['harga'] ?></h4>

                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>



<?= $this->section('script'); ?>
<script src="<?= base_url('assets/js/bing-map-script.js')?>"></script>
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

    function initializeMap() {
        var position = JSON.parse('<?= $coords ?>');
        curPos = new Microsoft.Maps.Location(position['lat'], position['lng']);
        var customPinSVG = "<?= base_url('assets/images/market-icon.png') ?>";
        var iconSize = new Microsoft.Maps.Size(2, 2);
        mapOptions = {
            credentials: 'AjW6-dZZoaykuiVK9bgOrU5QLbDs9npiO77bQ6LRQEJvyfcULC7wT77-ByTsmiwv',
            center: curPos,
            mapTypeId: Microsoft.Maps.MapTypeId.road,
            zoom: 20
        };

        map = new Microsoft.Maps.Map($("#divMap").get(0), mapOptions);

        // kondisi awal ketika halaman di load
        var pin = new Microsoft.Maps.Pushpin(curPos, {
            icon: customPinSVG, // Set the custom SVG as the pin icon
            anchor: new Microsoft.Maps.Point(12, 24),
            width: iconSize.width,
            height: iconSize.height
        });
        map.entities.push(pin);

        map.setView({
            center: curPos,
            zoom: 20
        });

        addPolygon(map);
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
        var callout = new Microsoft.Maps.Infobox(defaultPos, calloutOptions);
        map.entities.push(callout);
    }
</script>
<?= $this->endSection(); ?>