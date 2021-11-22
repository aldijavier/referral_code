<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Charts\CovidChart;

class ChartController extends Controller
{
    public function chart(Request $request){
        $url = "http://api.coronatracker.com/v3/stats/custom-debug";
        $client = new Client();
        $response = $client->request('GET', $url);
        $data = json_decode($response->getBody());
        
        $labels = collect($data)->flatten(1)->pluck('countryName');
        $data1   = collect($data)->flatten(1)->pluck('confirmed');
        $colors = $labels->map(function($item) {
            return $rand_color = '#' . substr(md5(mt_rand()), 0, 6);
        });

        $chart = new CovidChart;
        $chart->labels($labels);
        $chart->dataset('Kasus Positif', 'pie', $data1)->backgroundColor($colors);

        // dd(json_decode($response->getBody()));
        // dd($data);
        return view('referral.chart', compact('data', 'chart'));
        // $client = new Client(['base_uri' => 'https://api.kawalcorona.com/indonesia/provinsi']);
        // $response = $client->request('GET');
        // // $suspects = Http::get('https://api.kawalcorona.com/indonesia/provinsi');
        // // json_decode($response->getBody());
        // dd(json_decode($response->getBody(), true));
    }

    // public function chart()
    // {
    //     $suspects = collect(Http::get('https://api.kawalcorona.com/indonesia/provinsi')->json());
        
    //     $labels = $suspects->flatten(1)->pluck('Provinsi');
    //     $data   = $suspects->flatten(1)->pluck('Kasus_Posi');
    //     $colors = $labels->map(function($item) {
    //         return $rand_color = '#' . substr(md5(mt_rand()), 0, 6);
    //     });

    //     $chart = new CovidChart;
    //     $chart->labels($labels);
    //     $chart->dataset('Kasus Positif', 'pie', $data)->backgroundColor($colors);

    //     return view('corona', [
    //         'chart' => $chart,
    //     ]);
    // }
}
