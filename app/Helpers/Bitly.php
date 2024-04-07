<?php

namespace App\Helpers;

class Bitly
{
    private string $token = 'd8ea2a62080a2e1a2608fcffd9466d80b1972996';

    public string $link = '';

    public function __construct(string $url, string $campaignName, string $source, string $medium)
    {
        $source = urlencode($source);
        $medium = urlencode($medium);
        $campaignName = urlencode($campaignName);
        $url = $url."?utm_source=$source&utm_medium=$medium&utm_campaign=$campaignName";

        $this->link = $this->createLink($url);
    }

    public function getLink()
    {
        return $this->link;
    }

    private function createLink($url)
    {
        $apiurl = 'https://api-ssl.bitly.com/v4/bitlinks';

        $curl = curl_init($apiurl);
        curl_setopt($curl, CURLOPT_URL, $apiurl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = [
            'Content-Type: application/json',
            "Authorization: Bearer $this->token",
        ];

        $fields = [
            'domain' => 'bit.ly',
            'long_url' => $url,
        ];

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($fields));
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);

        return json_decode($resp, true)['link'];
    }
}
