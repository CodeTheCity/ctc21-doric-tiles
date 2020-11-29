<?php

function get_id_from_url($url) 
{
    // entity [4] is the object id
    $out = explode('/', $url);
    return $out[4];
}

$file = fopen("../data/placenames_updated.csv", "r");
$outfile = fopen("../data/quickstatements.txt", "w");
while(($data = fgetcsv($file, 500, ",")) !== FALSE)
{
    // if there's a Scots language entry, add it to the list
    if ($data[2] !== '') {
        $output_string = get_id_from_url($data[0]) . "\t" . "Lsco" . "\t" . $data[2] . "\n";
        fwrite($outfile, $output_string);
    }
}
fclose($file);
fclose($outfile);
