<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class MarvelService extends BaseConfig
{
    /**
    * Public key provided by Marvel https://developer.marvel.com/documentation/generalinfo for authenticating requests.
    *
    * @var string
    */
    public $publicKey;

    /**
     * Private key provided by Marvel https://developer.marvel.com/documentation/generalinfo for authenticating requests.
     *
     * @var string
     */
    public $privateKey;
}
