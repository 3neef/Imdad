<?php

namespace App\Http\Services\General;

use App\Models\Emdad\RelatedCompanies;

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
      
        foreach (json_decode($response) as $relatedCompany) {
            $related=new RelatedCompanies();
            $related->cr_name=$relatedCompany->crName;
            $related->business_type=$relatedCompany->businessType->name;
            $related->relation=$relatedCompany->relation->name;
            $related->identity=$id;
            $related->identity_type=$idType;
            $related->save();
        }
    }
}
