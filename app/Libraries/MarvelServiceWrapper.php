<?php
namespace App\Libraries;
use CodeIgniter\HTTP\CURLRequest;
use Config\Services;
use CodeIgniter\I18n\Time;

/**
 * Service MarvelServiceWrapper
 * A Service wrapper class for interacting with the Marvel API
 */
class MarvelServiceWrapper {
   protected $curl;
   protected $ts;
   protected $hash;

 /**
  * Constructor method
  * CurlRequest to process marvel api request, and set values instance
  */
 public function __construct(){
   $this->curl = Services::curlrequest(['baseURI'=>'https://gateway.marvel.com:443/v1/public/']);
   $this->ts = Time::now()->getTimestamp();
   $this->hash = hash('md5', $this->ts. config('MarvelService')->privateKey . config('MarvelService')->publicKey);
 }

 /**
  * Get List characters
  *
  * @return array
  */
 public function listCharacters (){
      $params = [
        'apikey' => config('MarvelService')->publicKey,
        'ts' => $this->ts,
        'hash' => $this->hash
      ];

      $queryBuild = http_build_query($params);
      $queryParams = $this->curl->get('characters?' . $queryBuild);
      $bodyJson = json_decode($queryParams->getBody(), true);
      $result = $bodyJson['data']['results'];
      $charactersResults = [];

      foreach ($result as $character){
        $charactersResult = [
            'id' => $character['id'],
            'name' => $character['name'],
            'description' => $character['description'],
            'thumbnail' => $character['thumbnail']['path'].'.'. $character['thumbnail']['extension'],
        ];
        $charactersResults[] = $charactersResult;
      }
     return $charactersResults;
   }
}
