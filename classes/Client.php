<?php

namespace Stanford\CalMate\classes;

use Stanford\CalMate\CalMate;
use Microsoft\Graph\GraphServiceClient;
use Microsoft\Kiota\Authentication\Oauth\ClientCredentialContext;

class Client
{

    // The client credentials flow requires that you request the
    // /.default scope, and pre-configure your permissions on the
    // app registration in Azure. An administrator must grant consent
    // to those permissions beforehand.
    private $scopes = ['https://graph.microsoft.com/.default'];

    /**
     * @var
     */
    private $clientId;

    /**
     * @var
     */
    private $clientSecret;

    /**
     * @var
     */
    private $tenantId;


    private ClientCredentialContext $tokenContext;


    private GraphServiceClient $client;

    private CalMate $module;
    public function __construct($module)
    {
        $this->module = $module;
        // Other code to run when object is instantiated
    }

    /**
     * @return GraphServiceClient
     */
    public function getClient(): GraphServiceClient
    {
        if (!isset($this->client)) {
            $this->client = new GraphServiceClient($this->getTokenContext(), $this->getScopes());
        }
        return $this->client;
    }

    /**
     * @param GraphServiceClient $client
     */
    public function setClient(GraphServiceClient $client): void
    {
        $this->client = $client;
    }

    /**
     * @return string[]
     */
    public function getScopes(): array
    {
        return $this->scopes;
    }

    /**
     * @param string[] $scopes
     */
    public function setScopes(array $scopes): void
    {
        $this->scopes = $scopes;
    }

    /**
     * @return mixed
     */
    public function getClientId()
    {
        if(!isset($this->clientId)) {
            $this->setClientId($this->module->getProjectSetting('microsoft_client_id'));
        }
        return $this->clientId;
    }

    /**
     * @param mixed $clientId
     */
    public function setClientId($clientId): void
    {
        $this->clientId = $clientId;
    }

    /**
     * @return mixed
     */
    public function getClientSecret()
    {
        if(!isset($this->clientSecret)) {
            $this->setClientSecret($this->module->getProjectSetting('microsoft_client_secret'));
        }
        return $this->clientSecret;
    }

    /**
     * @param mixed $clientSecret
     */
    public function setClientSecret($clientSecret): void
    {
        $this->clientSecret = $clientSecret;
    }

    /**
     * @return mixed
     */
    public function getTenantId()
    {
        if(!isset($this->tenantId)) {
            $this->setTenantId($this->module->getProjectSetting('microsoft_tenant_id'));
        }
        return $this->tenantId;
    }

    /**
     * @param mixed $tenantId
     */
    public function setTenantId($tenantId): void
    {
        $this->tenantId = $tenantId;
    }

    /**
     * @return ClientCredentialContext
     */
    public function getTokenContext(): ClientCredentialContext
    {
        if(!$this->tokenContext){
            $this->setTokenContext(new ClientCredentialContext(
                $this->getClientId(),
                $this->getClientSecret(),
                $this->getTenantId()
            ));
        }
        return $this->tokenContext;
    }

    /**
     * @param ClientCredentialContext $tokenContext
     */
    public function setTokenContext(ClientCredentialContext $tokenContext): void
    {
        $this->tokenContext = $tokenContext;
    }


}