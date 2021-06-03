<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;

class AddressController extends Controller
{
        public function hcvn(){
        $data_provinces = file_get_contents(asset('public/hcvn/tinh_tp.json'));
        $provinces  = json_decode($data_provinces);
        $data_districts = file_get_contents(asset('public/hcvn/quan_huyen.json'));
        $districts  = json_decode($data_districts);
//        dd($districts);
//        $newDistricts = array();
//        foreach ($districts as $key => $item){
//            $newDistricts[$item->parent_code][$key]['name'] = $item->name;
//            $newDistricts[$item->parent_code][$key]['type'] = $item->type;
//            $newDistricts[$item->parent_code][$key]['slug'] = $item->slug;
//            $newDistricts[$item->parent_code][$key]['name_with_type'] = $item->name_with_type;
//            $newDistricts[$item->parent_code][$key]['path'] = $item->path;
//            $newDistricts[$item->parent_code][$key]['path_with_type'] = $item->path_with_type;
//            $newDistricts[$item->parent_code][$key]['code'] = $item->code;
//            $newDistricts[$item->parent_code][$key]['parent_code'] = $item->parent_code;
//        }
//        dd($newDistricts);
//        $json_newDistricts = json_encode($newDistricts);
//        $url_districts = 'public/hcvn/districts.json';
//        file_put_contents($url_districts,$json_newDistricts);

        $data_wards = file_get_contents(asset('public/hcvn/xa_phuong.json'));
        $wards  = json_decode($data_wards);
//        dd($wards);
        $newWards = array();
        foreach ($wards as $key => $item){
            $newWards[$item->parent_code][$key]['name'] = $item->name;
            $newWards[$item->parent_code][$key]['type'] = $item->type;
            $newWards[$item->parent_code][$key]['slug'] = $item->slug;
            $newWards[$item->parent_code][$key]['name_with_type'] = $item->name_with_type;
            $newWards[$item->parent_code][$key]['path'] = $item->path;
            $newWards[$item->parent_code][$key]['path_with_type'] = $item->path_with_type;
            $newWards[$item->parent_code][$key]['code'] = $item->code;
            $newWards[$item->parent_code][$key]['parent_code'] = $item->parent_code;
        }
      $json_wards = json_encode($newWards);
//        $url_wards = 'public/hcvn/wards.json';
//        file_put_contents($url_wards, $json_wards);
    }

    public function getDistricts($provinces_id){
        $fileDistricts = file_get_contents(asset('public/hcvn/districts.json'));
        $dataDistricts = json_decode($fileDistricts);
        $districts = $dataDistricts->$provinces_id;
        return Response::json(array(
            'districts' => $districts,
        ));
    }
    public function getWards($districts_id){
        $filWards = file_get_contents(asset('public/hcvn/wards.json'));
        $dataWards = json_decode($filWards);
        $wards = $dataWards->$districts_id;
        return Response::json(array(
            'wards' => $wards,
        ));
    }

}
