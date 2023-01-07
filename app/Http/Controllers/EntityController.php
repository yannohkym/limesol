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
       // dd($entries->entries[0]);
        $array = $entries->entries;
        //dd($array);
        $chunks = array_chunk($array, floor(count($array) / 3));
        dd($chunks);

        foreach ($chunks as $i => $items) {
            foreach ($items as $item) {
                // create a new model instance
                $data = new EntityOne();
                $data->api =$item->API;
                $data->description =$item->Description;
                $data->auth =$item->Auth;
                $data->https =$item->HTTPS;
                $data->cors =$item->Cors;
                $data->link =$item->Link;
                $data->category =$item->Category;
                // set the table name based on the chunk number
                //$data->setTable('entity_ones_table' . ($i + 1));
                $data->save();
            }
        }

        return 'Entries from the  api were saved';
    }
    public function endpoint(Request $request,EntityOne $entries){
        //$entries =$entries->all();
        $entries = EntityOne::where('cors', '=', 'yes')->get();
        dd($entries[0]);
        // do something with the data
        // return a response
        return response()->json([
            'success' => true,
            'data' => $entries,
        ]);

    }
    public function saveToEntity2(){
        //a script that can login to a router as an admin panel and extract the list of connected devices
        //// should also be able to change the ssid of the wifi.
    }
    public function saveToEntity3(){

    }
}
