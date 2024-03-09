<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class RestaurantController extends Controller
{
    public function fetch(Request $request)
    {

        $lat = '35.689487';
        $lng = '139.691706';

        $client = new Client();
        $response = $client->request('GET', 'https://maps.googleapis.com/maps/api/place/nearbysearch/json', [
            'query' => [
                'location' => $lat . ',' . $lng,
                'radius' => 1000,
                'type' => 'restaurant',
                'key' => 'YOUR_GOOGLE_MAPS_API_KEY'
            ]
        ]);

        $data = json_decode($response->getBody(), true);
        $restaurants = [];

        foreach ($data['results'] as $result) {
            if (count($restaurants) >= 50) break;
            $restaurants[] = [
                'name' => $result['name'],
                'distance' => '距離' 
            ];
        }

        return response()->json($restaurants);
    }
}







