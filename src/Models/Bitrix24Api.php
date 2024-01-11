<?php

namespace App\Models;

class Bitrix24Api
{
    private string $domain = "https://bx.talan.group:8082/rest/25329/u700sgc7xahq2bz3/";

    public function getDealsList()
    {
        $method = "crm.deal.list";

        return $this->callMethod($method);
    }

    function callMethod($method, array $params = Array())
    {
        $queryUrl = $this->domain . $method;
        $queryData = http_build_query($params);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_POST => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYPEER => 1,
            CURLOPT_URL => $queryUrl,
            CURLOPT_POSTFIELDS => $queryData,
        ));
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, 1);
    }

    public function getContact($contactId)
    {
        $method = 'crm.contact.get';
        $params = ['id' => $contactId];

        return $this->callMethod($method, $params);
    }
}