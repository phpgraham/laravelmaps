<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use GeneaLabs\LaravelMaps\Facades\Map;
/**
 * Class HomeController.
 */
class MapsController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
      $config = array();
      $config['map_height'] = '550px';
      $config['zoom'] = '13';
      $config['draggableCursor'] = 'default';
      Map::initialize($config);

      app()
        ->make('\App\Http\Controllers\MapsController')
        ->callAction('markers_single', $parameters = array());

      Map::initialize($config);
      $map = Map::create_map();
      return view('home')->with('map', $map);
    }

    public function show($map)
    {
      //set up default configs
      $config = array();
      $config['map_height'] = '550px';
      $config['zoom'] = 'auto';
      $config['draggableCursor'] = 'default';
      $config['center'] = '37.4419, -122.1419';
      Map::initialize($config);
      //call feature configs and setup markers, etc
      app()
        ->make('\App\Http\Controllers\MapsController')
        ->callAction($map, $parameters = array());
      //create map, send to view
      $map = Map::create_map();
      return view('home')->with('map', $map);
    }

    public function markers_single()
    {
      $config['zoom'] = '13';
      Map::initialize($config);

      $marker = array();
      $marker['position'] = '37.4419, -122.1419';
      Map::add_marker($marker);
    }

    public function markers_multiple()
    {
      $marker = array();
      $marker['position'] = '37.429, -122.1519';
      $marker['infowindow_content'] = '1 - Hello World!';
      $marker['icon'] = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=A|9999FF|000000';
      Map::add_marker($marker);

      $marker = array();
      $marker['position'] = '37.409, -122.1319';
      $marker['draggable'] = TRUE;
      $marker['animation'] = 'DROP';
      Map::add_marker($marker);

      $marker = array();
      $marker['position'] = '37.449, -122.1419';
      $marker['onclick'] = 'alert("You just clicked me!!")';
      Map::add_marker($marker);
    }

    public function polyline()
    {
      $polyline = array();
      $polyline['points'] = array('37.429, -122.1319',
                '37.429, -122.1419',
                '37.4419, -122.1219');
      Map::add_polyline($polyline);
    }

    public function polygon()
    {
      $polygon = array();
      $polygon['points'] = array('37.425, -122.1321',
               '37.4422, -122.1622',
               '37.4412, -122.1322',
               '37.425, -122.1021');
      $polygon['strokeColor'] = '#000099';
      $polygon['fillColor'] = '#000099';
      Map::add_polygon($polygon);
    }

    public function drawing()
    {
      $config['drawing'] = true;
      $config['drawingDefaultMode'] = 'circle';
      $config['drawingModes'] = array('circle','rectangle','polygon');
      Map::initialize($config);
    }

    public function directions()
    {
      $config['directions'] = TRUE;
      $config['directionsStart'] = 'empire state building';
      $config['directionsEnd'] = 'statue of liberty';
      $config['directionsDivID'] = 'directionsDiv';
      Map::initialize($config);
    }

    public function streetview()
    {
      $config['map_type'] = 'STREET';
      $config['streetViewPovHeading'] = 90;
      Map::initialize($config);
    }

    public function clustering()
    {
      $config['center'] = '37.409, -122.1319';
      $config['zoom'] = '13';
      $config['cluster'] = TRUE;
      $config['clusterStyles'] = array(
        array(
          "url"=>"https://raw.githubusercontent.com/googlemaps/js-marker-clusterer/gh-pages/images/m1.png",
          "width"=>"53",
          "height"=>"53"
        ));
      Map::initialize($config);

      $marker = array();
      $marker['position'] = '37.409, -122.1319';
      Map::add_marker($marker);

      $marker = array();
      $marker['position'] = '37.409, -122.1419';
      Map::add_marker($marker);

      $marker = array();
      $marker['position'] = '37.409, -122.1219';
      Map::add_marker($marker);

      $marker = array();
      $marker['position'] = '37.409, -122.1519';
      Map::add_marker($marker);

    }

    public function kml_layer()
    {
      $config['onclick'] = 'alert(\'You just clicked at: \' + event.latLng.lat() + \', \' + event.latLng.lng());';
      $config['kmlLayerURL'] = 'https://www.google.com/maps/d/kml?mid=zQsfa8t0PJbc.kXZmQVidOFfE';
      Map::initialize($config);
    }

    //context menu
    public function right_click()
    {
      // set to false to remove from menu
      $contextMenuItems['centerMap'] = true;
      $contextMenuItems['addMarker'] = true;
      //TODO build array for design features of menu
      Map::add_context_menu($contextMenuItems);
    }

}
