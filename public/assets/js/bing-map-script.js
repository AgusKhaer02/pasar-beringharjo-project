function mapDesc() {
    
}


function addPolygon(map, bagian = "BaseArea") {

    // base area
    var baseArea = new Microsoft.Maps.Polygon([
        new Microsoft.Maps.Location(-7.798376, 110.365255),
        new Microsoft.Maps.Location(-7.798568, 110.366441),
        new Microsoft.Maps.Location(-7.799140, 110.366381),
        new Microsoft.Maps.Location(-7.799047, 110.365182),
    ], null);

    baseArea.setOptions({ fillColor: 'rgba(108, 245, 66, 0.5)' });
    map.entities.push(baseArea);

    // NEXT UPGRADE
    // barat
    // var barat = new Microsoft.Maps.Polygon([
    //     new Microsoft.Maps.Location(-7.798387, 110.365254),
    //     new Microsoft.Maps.Location(-7.798577, 110.366441),
    //     new Microsoft.Maps.Location(-7.799148, 110.366383),
    //     new Microsoft.Maps.Location(-7.799022, 110.365195),
    // ], null);
    // barat.setOptions({ fillColor: 'rgba(108, 245, 66, 0.5)' });
    // map.entities.push(barat);

    // tengah
    // var tengah = new Microsoft.Maps.Polygon([
    //     new Microsoft.Maps.Location(-7.798589, 110.366484),
    //     new Microsoft.Maps.Location(-7.798744, 110.367732),
    //     new Microsoft.Maps.Location(-7.799219, 110.367683),
    //     new Microsoft.Maps.Location(-7.799149, 110.366435),
    // ], null);
    // tengah.setOptions({ fillColor: 'rgba(245, 230, 66, 0.5)' });
    // map.entities.push(tengah);

    // timur
    // var timur = new Microsoft.Maps.Polygon([
    //     new Microsoft.Maps.Location(-7.798751, 110.367757),
    //     new Microsoft.Maps.Location(-7.798795, 110.368327),
    //     new Microsoft.Maps.Location(-7.799264, 110.368286),
    //     new Microsoft.Maps.Location(-7.799216, 110.367716),
    // ], null);
    // tengah.setOptions({ fillColor: 'rgba(245, 66, 129, 0.5)' });
    // map.entities.push(timur);

    // switch (bagian) {
    //     case 'Barat':
    //         return barat;
    //     case 'Tengah':
    //         return tengah;
    //     case 'Timur':
    //         return timur;
    //     default:
    //         return baseArea;
    // }
}
