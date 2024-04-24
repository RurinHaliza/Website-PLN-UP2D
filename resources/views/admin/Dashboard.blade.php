@extends('layouts.app')

@section('title', 'Dashboard')

@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.15.1/css/ol.css"
        type="text/css">
    <style>
        .map {
            height: 80vh;
            width: 100%;
        }

        .ol-popup {
            position: absolute;
            background-color: white;
            -webkit-filter: drop-shadow(0 1px 4px rgba(0, 0, 0, 0.2));
            filter: drop-shadow(0 1px 4px rgba(0, 0, 0, 0.2));
            padding: 15px;
            border-radius: 10px;
            border: 1px solid #cccccc;
            bottom: 12px;
            left: -50px;
            min-width: 280px;
        }

        .ol-popup:after,
        .ol-popup:before {
            top: 100%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
        }

        .ol-popup:after {
            border-top-color: white;
            border-width: 10px;
            left: 48px;
            margin-left: -10px;
        }

        .ol-popup:before {
            border-top-color: #cccccc;
            border-width: 11px;
            left: 48px;
            margin-left: -11px;
        }

        .ol-popup-closer {
            text-decoration: none;
            position: absolute;
            top: 2px;
            right: 8px;
        }

        .ol-popup-closer:after {
            content: "X";
        }
    </style>

    <link rel="stylesheet" href="https://unpkg.com/ol-popup@5.1.0/src/ol-popup.css" />

    <link rel="stylesheet" href="{{ asset('assets/js/ol-layerswitcher/dist/ol-layerswitcher.css') }}" />
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard Administrator</h1>
            </div>
        </section>

        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Feeder
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $feeder }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Penyulang
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $countPenyulang }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah GI
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $countGI }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-industry-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Trafo
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $countTrafo }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-industry-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah NVA
                                    Ini
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">15,000 mW</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Data ASSET
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">25000 mW</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-toolbox fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <div class="row">

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Analytical</h3>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>Beban Tertinggi Jatim Hari Ini</li>
                            <ul>
                                <li>MW: </li>
                                <li>Tanggal</li>
                                <li>Pukul</li>
                            </ul>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div id="map" class="map mb-3"></div>
                <div id="popup" class="ol-popup">
                    <a href="#" id="popup-closer" class="ol-popup-closer"></a>
                    <div id="popup-content"></div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.15.1/build/ol.js"></script>
    <script src="{{ asset('assets/js/ol4/proj4.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/ol-layerswitcher/dist/ol-layerswitcher.js') }}"></script>

    <script>
        var map, geojson, layer_name, layerSwitcher, featureOverlay;
        var container, content, closer;
        var mousePositionControl;

        proj4.defs("EPSG:32749", "+proj=utm +zone=49 +south +datum=WGS84 +units=m +no_defs +type=crs ");

        var projection = new ol.proj.Projection({
            code: 'EPSG:32749',
            units: 'm',
            axisOrientation: 'neu'
        });
        var view = new ol.View({
            center: ol.proj.fromLonLat([112.752, -7.2547]),
            zoom: 14,
            Projection: projection
        })

        var view_ov = new ol.View({
            Projection: projection,
            center: ol.proj.fromLonLat([112.752, -7.2547]),
            zoom: 14,

        });

        var surabaya = new ol.source.TileWMS({
            url: 'http://peta.cktr.web.id/geoserver/webgis/wms',
            params: {
                'LAYERS': 'webgis:LIDAR_SURABAYA',
                'TILED': true
            },
            serverType: 'geoserver'
        });

        var mode = "default";
        var vectorSource2 = new ol.source.Vector();
        var vectorLayer2 = new ol.layer.Vector({
            source: vectorSource2
        })
        var iconStyle = new ol.style.Style({
            image: new ol.style.Icon({
                anchor: [0.5, 1],
                anchorXUnits: 'fraction',
                anchorYUnits: 'fraction',
                opacity: 0.75,
                src: 'redpin.png'
            })
        });

        var google_road = new ol.layer.Tile({
            projection: 'EPSG:32749',
            type: 'base',
            visible: false,
            title: "Google Road",
            source: new ol.source.XYZ({

                url: 'https://mt0.google.com/vt/lyrs=m&hl=en&x={x}&y={y}&z={z}'
            })
        })

        var google_sat = new ol.layer.Tile({
            projection: 'EPSG:32749',
            type: 'base',
            visible: true,
            title: "Google Satellite",
            source: new ol.source.XYZ({

                url: 'https://mt0.google.com/vt/lyrs=s&hl=en&x={x}&y={y}&z={z}'
            })
        })

        var OSM2 = new ol.layer.Tile({
            source: new ol.source.OSM(),
            projection: 'EPSG:32749',

            type: 'base',
            title: 'Open Street Map',
            visible: false,
        });

        var OSM = new ol.layer.Tile({
            source: new ol.source.OSM(),
            projection: 'EPSG:32749',
            type: 'base',
            title: 'Open Street Map',
            visible: false,
        });

        var base_maps = new ol.layer.Group({
            'title': 'Base maps',
            layers: [
                google_sat, OSM, new ol.layer.Tile({
                    title: "Peta Surabaya",
                    type: 'base',
                    visible: false,
                    source: surabaya
                })
            ]
        });

        var map = new ol.Map({
            target: 'map',
            view: new ol.View({
                center: ol.proj.fromLonLat([
                    112.2384017,-7.5360639
                ]),
                zoom: 15
            }),
            controls: [mousePositionControl],
        });

        map.addLayer(base_maps);

        var overview = new ol.control.OverviewMap({
            view: view_ov,
            collapseLabel: 'O',
            label: 'O',
            layers: [OSM2]
        });

        map.addControl(overview);

        var full_sc = new ol.control.FullScreen({
            label: 'F'
        });
        map.addControl(full_sc);

        var zoom = new ol.control.Zoom({
            zoomInLabel: '+',
            zoomOutLabel: '-'
        });
        map.addControl(zoom);

        var slider = new ol.control.ZoomSlider();
        map.addControl(slider);


        var zoom_ex = new ol.control.ZoomToExtent({
            extent: [
                65.90, 7.48,
                98.96, 40.30
            ]
        });
        map.addControl(zoom_ex);

        var layerSwitcher = new ol.control.LayerSwitcher({
            activationMode: 'click',
            startActive: true,
            tipLabel: 'Layers', // Optional label for button
            groupSelectStyle: 'children', // Can be 'children' [default], 'group' or 'none'
            collapseTipLabel: 'Collapse layers',
        });
        map.addControl(layerSwitcher);

    </script>


@endpush
