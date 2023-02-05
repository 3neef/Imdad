<?php

namespace App\Http\Services\General;

use App\Models\BusinessType;
use App\Models\Emdad\RelatedCompanies;
use App\Models\LookupLocation;

use function PHPUnit\Framework\isEmpty;

class WathiqService
{
    public function getRelatedCompanies($id, $idType)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.wathq.sa/v5/commercialregistration/related/' . $id . '/' . $idType,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'apiKey: skwAyrXpbfHcLAJAna6JSN5kIz4KRGU3',
            ),
        ));

        

        $response = curl_exec($curl);
        curl_close($curl);
        if (is_array(json_decode($response))) {
            foreach (json_decode($response) as $relatedCompany) {
                $related = new RelatedCompanies();
                $related->cr_name = $relatedCompany->crName;
                $related->cr_number = $relatedCompany->crNumber;
                $related->business_type = $relatedCompany->businessType->name;
                $related->relation = $relatedCompany->relation->name;
                $related->identity = $id;
                $related->identity_type = $idType;
                $related->save();
            }
        }
    }

    public static function getLocations()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.wathq.sa/v5/commercialregistration//lookup/locations',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'apiKey: skwAyrXpbfHcLAJAna6JSN5kIz4KRGU3',
            ),
        ));

        

        $response = curl_exec($curl);
        curl_close($curl);

        if (is_array(json_decode($response))) {
            foreach (json_decode($response) as $location) {
                $lookup_location = new LookupLocation();
                $lookup_location->loc_number = $location->id;
                $lookup_location->name_ar = $location->name;
                $lookup_location->name_en = $location->nameEn;
                $lookup_location->save();
            }
        }
        return $response;
    }


    public static function getBusinessTypes()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.wathq.sa/v5/commercialregistration//lookup/businessTypes',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'apiKey: skwAyrXpbfHcLAJAna6JSN5kIz4KRGU3',
            ),
        ));

        

        $response = curl_exec($curl);
        curl_close($curl);

        if (is_array(json_decode($response))) {
            foreach (json_decode($response) as $type) {
                $business_type = new BusinessType();
                $business_type->type_id = $type->id;
                $business_type->name_ar = $type->name;
                $business_type->name_en = $type->nameEn;
                $business_type->save();
            }
        }
        return $response;
    }
}
