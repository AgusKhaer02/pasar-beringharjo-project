<?= $this->extend('backend/layouts/template') ;?>

<?= $this->section('title') ;?>
Denah
<?= $this->endSection() ;?>

<?= $this->section('content') ;?>
    <h1 class="mt-4">Denah</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Denah</li>
    </ol>
    
    <a href="<?= base_url('admin/denah/new-post') ?>" class="btn btn-primary btn-float">
        <h4><i class="fa fa-plus btn-content-float"></i></h4>
    </a>

    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>LOS</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($denah as $index => $item) : ?>
            <tr>
                <td><?= $index++ ?></td>
                <td><?= $item['los'] ?></td>
                <td>
                    
                </td>
            </tr>
        <?php endforeach ?>
    </table>
<?= $this->endSection() ;?>


<?= $this->section('script-js') ;?>

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
    
    $(document).ready(function(){
        $("#btnDelete").click(function (e) { 
            e.preventDefault();
            
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#delete-post-form").submit();
                }
            });   
        });     
    });
</script>
<?= $this->endSection() ;?>
