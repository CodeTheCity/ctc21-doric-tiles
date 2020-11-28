<?php

include_once('vendor/autoload.php');

use Goutte\Client;

function get_scots_placename ($placename) {
    $client = new Client();

    $crawler = $client->request('GET', 'https://www.scots-online.org/dictionary/english_scots.php');
    $form = $crawler->filter('form')->form();
    $crawler = $client->submit($form, ['word'=> $placename]);
    
    try {
        $results = $crawler->filter('div.results')->filter('span.hielicht')->eq(0)->text();
        return $results;
    } catch(InvalidArgumentException $e) {
        return "";
    }
    
}

$file = fopen("../data/placenames_original.csv", "r");
$outfile = fopen("../data/placenames_updated.csv", "w");
while(($data = fgetcsv($file, 500, ",")) !== FALSE)
{
    // if there's no scots language entry in the csv, get it and add it here
    if ($data[2] == '') {
        $data[2] = get_scots_placename($data[1]);
    }
    fwrite($outfile, $data[0] . "," . $data[1] . "," . $data[2] . "," . $data[3] . "\n");
}
fclose($file);
fclose($outfile);