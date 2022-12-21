<?php

namespace App\Http\Controllers;

use App\Models\EntityOne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
class EntityController extends Controller
{
    public function fetch(){

        $client = new Client();
        $response = $client->get('https://api.publicapis.org/entries');
        $entries = json_decode($response->getBody());
        $third = floor(count($entries) / 3);
        $thirds = array_chunk($entries, $third);
        foreach ($entries as $entri){
            foreach ($entri as $entry){

                $data = new EntityOne();
                $data->api =$entry->API;
                $data->description =$entry->Description;
                $data->auth =$entry->Auth;
                $data->https =$entry->HTTPS;
                $data->cors =$entry->Cors;
                $data->link =$entry->Link;
                $data->category =$entry->Category;
                $data->save();
            }
        }


        return 'Entries from the  api were saved';




    }
    public function saveToEntity1(){

//a script that can login to a router as an admin panel and extract the list of connected devices
//// should also be able to change the ssid of the wifi.
    }
    public function saveToEntity2(){

    }
    public function saveToEntity3(){

    }
}
