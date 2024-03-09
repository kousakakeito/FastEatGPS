<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class RestaurantController extends Controller
{
    public function findRestaurants(Request $request)
    {
        $lat = $request->input('lat', '35.689487');//仮
        $lng = $request->input('lng', '139.691706');

        $client = new Client();
        $response = $client->request('GET', 'https://maps.googleapis.com/maps/api/place/nearbysearch/json', [
            'query' => [
                'location' => $lat . ',' . $lng,
                'radius' => 1000,
                'type' => 'restaurant',
                'opennow' => true,
                'key' => ''
            ]
        ]);

        $data = json_decode($response->getBody(), true);
        $restaurants = [];

        foreach ($data['results'] as $result) {
            if (count($restaurants) >= 50) break;
            $distance = '距離';

            $imageReference = isset($result['photos'][0]['photo_reference']) ? $result['photos'][0]['photo_reference'] : '';

            $restaurants[] = [
                'name' => $result['name'],
                'distance' => $distance,
                'image' => $imageReference
            ];
        }

        return response()->json($restaurants);
    }
}






