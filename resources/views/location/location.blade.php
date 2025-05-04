@extends('layouts.tabler')
<style id="compiled-css" type="text/css">
    #my-map {
        width: 100%;
        height: 100%;
        margin: 0;
    }
</style>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
<script>
    let zooMarker;
    var map;
    var myAPIKey = "fef3d039831a43c48ce29513f31b27e2";
    var isRetina = L.Browser.retina;
</script>
@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div id="demo"></div>
            <x-alert />
            <div class="row">
                <div class="col-12">
                    @livewire('location-component')
                </div>
                <div class="col-12">
                    <div class="form-group mt-2">
                        <div style="width: 100%;height: 600px;border: 1px solid gray;border-radius: 3px;">
                            <div id="my-map"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            map = L.map("my-map").setView([53.8149662, -1.5148837], 16);
            var baseUrl = "https://maps.geoapify.com/v1/tile/osm-bright/{z}/{x}/{y}.png?apiKey=" + myAPIKey;
            var retinaUrl = "https://maps.geoapify.com/v1/tile/osm-bright/{z}/{x}/{y}@2x.png?apiKey=" +
                myAPIKey;
            L.tileLayer(isRetina ? retinaUrl : baseUrl, {
                apiKey: myAPIKey,
                maxZoom: 20,
                id: "osm-bright",
            }).addTo(map);
            const zooMarkerPopup = L.popup().setContent('Current Location');
            const markerIcon = L.icon({
                iconUrl: `https://api.geoapify.com/v1/icon/?type=material&color=red&icon=user&iconType=awesome&scaleFactor=2&apiKey=${myAPIKey}`,
                iconSize: [31, 46],
                iconAnchor: [15.5, 42],
                popupAnchor: [0, -45]
            });
            zooMarker = L.marker([53.8149662, -1.5148837], {
                icon: markerIcon
            }).bindPopup(zooMarkerPopup).addTo(map);
        </script>
    </div>
@endsection
