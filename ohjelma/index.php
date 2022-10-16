<?php
    function json_data_to_csv($json_file, $csv_file) {
        header('Content-type: text/plain; charset=UTF-8');

        $json = file_get_contents($json_file);
        $file_csv = fopen($csv_file, "w");
        $decoded_json_file = json_decode($json, true);
        
        $header = false;
        foreach($decoded_json_file as $row) {
            if(empty($header)) {
                $header = array_keys($row);
                fputcsv($file_csv, $header);
            }

            $array = array();

            foreach($row as $value) {
                array_push($array, $value);
            }   
            fputcsv($file_csv, $array);
        }
        fclose($file_csv);
    }
    
    $json_file = "export.json";
    $csv_file = "tuotetiedot.csv";
    json_data_to_csv($json_file, $csv_file);
?>