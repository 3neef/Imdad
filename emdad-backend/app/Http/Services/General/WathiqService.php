<?php

namespace App\Http\Services\General;

use App\Models\BusinessType;
use App\Models\Emdad\RelatedCompanies;
use App\Models\LookupActivities;
use App\Models\LookupLocation;
use App\Models\LookupNationality;
use App\Models\LookupRelation;

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


    public static function getRelations()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.wathq.sa/v5/commercialregistration//lookup/relations',
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
            foreach (json_decode($response) as $relation) {
                $lookup_relation = new LookupRelation();
                $lookup_relation->relation_id = $relation->id;
                $lookup_relation->name_ar = $relation->name;
                $lookup_relation->name_en = $relation->nameEn;
                $lookup_relation->save();
            }
        }
        return $response;
    }

    public static function getNationalities()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.wathq.sa/v5/commercialregistration//lookup/nationalities',
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
            foreach (json_decode($response) as $nationality) {
                $lookup_nationality = new LookupNationality();
                $lookup_nationality->country_id = $nationality->id;
                $lookup_nationality->country_ar = $nationality->country;
                $lookup_nationality->country_en = $nationality->countryEn;
                $lookup_nationality->isoAlpha2 = $nationality->isoAlpha2;
                $lookup_nationality->isoAlpha3 = $nationality->isoAlpha3;
                $lookup_nationality->save();
            }
        }
        return $response;
    }

    public static function getActivities()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.wathq.sa/v5/commercialregistration//lookup/activities',
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
            // return json_decode($response);
            foreach (json_decode($response) as $activity) {
                $lookup_activity = new LookupActivities();
                $lookup_activity->activity_id = $activity->id;
                $lookup_activity->name_ar = $activity->name;
                $lookup_activity->name_en = $activity->nameEn;
                $lookup_activity->level = $activity->level;
                $lookup_activity->category = json_encode($activity->category);
                $lookup_activity->save();
            }
        }
        return $response;
    }
}
