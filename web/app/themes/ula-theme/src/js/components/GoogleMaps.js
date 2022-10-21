/**
 * GoogleMaps
 * ---------
 * @component App/Foundation
 * @version 1.0
 *
 */

class GoogleMaps {
    constructor(el) {
        this.map = document.querySelector(el);
        if (this.map == null) return;

        this.new_map();
    }

    new_map() {
        this.data = JSON.parse(this.map.dataset.marker);
        const gmap = new google.maps.Map(this.map, this.map_config());
        this.set_marker(gmap, this.data);
    }

    /*
     *  map_config
     *
     *  This function will style the map and set base arguments
     *
     *  @param   n/a
     *  @return  n/a
     */
    map_config() {
        return {
            zoom: 16,
            center: { lat: this.data.lat, lng: this.data.lng },
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            mapTypeControl: false,
            styles: [
                { elementType: 'geometry', stylers: [{ color: '#4C6059' }] },
                {
                    elementType: 'labels.icon',
                    stylers: [{ visibility: 'off' }],
                },
                {
                    elementType: 'labels.text.fill',
                    stylers: [{ color: '#95A09D' }],
                },
                {
                    elementType: 'labels.text.stroke',
                    stylers: [{color: '#212121'}],
                },
                {
                    featureType: 'administrative',
                    elementType: 'geometry',
                    stylers: [{ color: '#95A09D' }],
                },
                {
                    featureType: 'administrative.country',
                    elementType: 'labels.text.fill',
                    stylers: [{ color: '#9e9e9e' }],
                },
                {
                    featureType: 'administrative.land_parcel',
                    stylers: [{ visibility: 'off' }],
                },
                {
                    featureType: 'administrative.locality',
                    elementType: 'labels.text.fill',
                    stylers: [{ color: '#bdbdbd' }],
                },
                {
                    featureType: 'poi',
                    elementType: 'labels.text.fill',
                    stylers: [{ color: '#95A09D' }],
                },
                {
                    featureType: 'poi.park',
                    elementType: 'geometry',
                    stylers: [{ color: '#181818' }],
                },
                {
                    featureType: 'poi.park',
                    elementType: 'labels.text.fill',
                    stylers: [{ color: '#7D8A87' }],
                },
                {
                    featureType: 'poi.park',
                    elementType: 'labels.text.stroke',
                    stylers: [{ color: '#000' }],
                },
                {
                    featureType: 'road',
                    elementType: 'geometry.fill',
                    stylers: [{ color: '#7D8A87' }],
                },
                {
                    featureType: 'road',
                    elementType: 'labels.text.fill',
                    stylers: [{ color: '#000' }],
                },
                {
                    featureType: 'road.arterial',
                    elementType: 'geometry',
                    stylers: [{ color: '#7D8A87' }],
                },
                {
                    featureType: 'road.highway',
                    elementType: 'geometry',
                    stylers: [{ color: '#95A09D' }],
                },
                {
                    featureType: 'road.highway.controlled_access',
                    elementType: 'geometry',
                    stylers: [{ color: '#4e4e4e' }],
                },
                {
                    featureType: 'road.local',
                    elementType: 'labels.text.fill',
                    stylers: [{ color: '#616161' }],
                },
                {
                    featureType: 'transit',
                    elementType: 'labels.text.fill',
                    stylers: [{ color: '#95A09D' }],
                },
                {
                    featureType: 'water',
                    elementType: 'geometry',
                    stylers: [{ color: '#24282B' }],
                },
                {
                    featureType: 'water',
                    elementType: 'labels.text.fill',
                    stylers: [{ color: '#95A09D' }],
                },
            ],
        };
    }

    set_marker(map, marker) {
        let gmarker = new google.maps.Marker({
            position: new google.maps.LatLng(marker.lat, marker.lng),
            map: map,
            title: marker.title,
            animation: google.maps.Animation.DROP,
            icon: site.path + '/src/images/marker.svg',
        });

        this.center_map(map, marker);
    }

    /*
     *  center_map
     *
     *  This function will center the map, showing all markers attached to this map
     *
     *  @param   map (Google Map object)
     *  @return  n/a
     */
    center_map(map, marker) {
        const bounds = new google.maps.LatLngBounds();

        // loop through all markers and create bounds
        bounds.extend(new google.maps.LatLng(marker.lat, marker.lng));

        map.setCenter(bounds.getCenter());
        map.setZoom(16);
    }

}

new GoogleMaps('.js-google-map');
