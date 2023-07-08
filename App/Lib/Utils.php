<?php

namespace App\Lib;

class Utils
{
    public static function removeDuplicates($array): array {
        $uniqueArray = array();
        foreach ($array as $element) {
            if (!in_array($element, $uniqueArray)) {
                $uniqueArray[] = $element;
            }
        }
        return $uniqueArray;
    }

    public static function print_array(array $array) {
        echo "<pre>";
        print_r($array);
    }

    public static function reorganiseArray(array $array){
        $tempArray = array();
        for ($i = 0; $i < count($array); $i++) {
                array_push($tempArray, $array[$i][0]); 
        }
        return $tempArray;
    }
    

    public static function calculPourCentage(int $value, int $total) {
        $pourCent = ($value * 100) / $total;
        $rounded = round($pourCent, 2);
        $formatted = number_format($rounded, 2);
        return $formatted;
    }

    public static function uploadPhoto(array $fileInfos) {
        if(($fileInfos['photo']) && $fileInfos['photo']['error'] == 0) {
            $fileInfo = pathinfo($fileInfos['photo']['name']);
            $extension = strtolower($fileInfo['extension']);
            $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];

            if(in_array($extension, $allowedExtensions)){
                $photoDir = 'templates/assets/images/profiles/'.basename($_FILES['photo']['name']);
                move_uploaded_file($_FILES['photo']['tmp_name'], $photoDir);
                return $photoDir;
            }
        }
    }

    public static function getWeather() {
        $city_name = 'Antananarivo';
        $api_key = '99d40e5c44d0fa0dbadebd80c49c5a3f';
        $url = "http://api.openweathermap.org/data/2.5/weather?q=" . urlencode($city_name) . "&appid=" . $api_key . "&units=metric";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        $temperature = $data["main"]['temp'];
        $weatherIconCode = $data['weather'][0]['icon'];
        $weather = [
            'temp' => $temperature,
            'icon' => $weatherIconCode
        ];
        return $weather;
    }
}

