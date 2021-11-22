<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;


class ChartController extends Controller
{
    public function chart(Request $request){
        $url = "http://api.coronatracker.com/v3/stats/custom-debug";
        $client = new Client();
        $response = $client->request('GET', $url);
        $data = json_decode($response->getBody());
        // dd(json_decode($response->getBody()));
        // dd($data);
        return view('referral.chart', compact('data'));
        // $client = new Client(['base_uri' => 'https://api.kawalcorona.com/indonesia/provinsi']);
        // $response = $client->request('GET');
        // // $suspects = Http::get('https://api.kawalcorona.com/indonesia/provinsi');
        // // json_decode($response->getBody());
        // dd(json_decode($response->getBody(), true));
    }
}
