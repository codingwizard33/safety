<?php

use Aws\Polly\PollyClient;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::get('{any}', function () {

//    $client = new PollyClient([
//        'version' => 'latest',
//        'region' => 'us-east-1',
//        'credentials' => [
//            'key' => 'AKIAYXKND4GQ32FTRO7V',
//            'secret' => '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',
//        ],
//    ]);
//
//
//
//    $engines = ['standard','neural'];
//
//    foreach($engines as $engine) {
//        $text = "Synthesizing " . $engine . " speech using AWS PHP SDK. Does this sound " . $engine . "?";
//        try {
//            $arrtemp = [
//                'Text' => $text,
//                'OutputFormat' => 'mp3',
//                'VoiceId' => 'Kimberly',
//                'Engine' => $engine,
//            ];
//
//            $result = $client->synthesizeSpeech($arrtemp);
////            dd($result);
//
//        } catch (\Aws\Exception\AwsException $e) {
//            echo "Error: {$e->getMessage()}";
//        }
//        if (!empty($result['AudioStream'])) {
//            $audio = $result['AudioStream'];
//            file_put_contents('./pollyVoices/Kimberly' . $engine . 'Php.mp3', $audio);
//        }
//    }


    return view('welcome');
})->where('any', '.*');