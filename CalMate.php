<?php

namespace Stanford\CalMate;

use Stanford\CalMate\classes\Client;

include_once "vendor/autoload.php";
include_once "classes/Client.php";

class CalMate extends \ExternalModules\AbstractExternalModule
{
    private Client $client;

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        if (!isset($this->client)) {
            $this->client = new Client($this);
        }
        return $this->client;
    }

    /**
     * @param Client $client
     */
    public function setClient(Client $client): void
    {
        $this->client = $client;
    }
}
