<?php

namespace CXml;

use CXml\Models\Requests\PunchOutSetupRequest;
use CXml\Models\Requests\RequestInterface;
use CXml\Models\Orders\OrderRequest;

class RequestFactory
{
    public function create(string $name): RequestInterface
    {
        switch ($name) {
            case 'PunchOutSetupRequest':
                return new PunchOutSetupRequest();
            case 'OrderRequest':
                return new OrderRequest();
        }

        throw new \Exception("Request type '$name' is not supported");
    }
}
