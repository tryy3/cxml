<?php

namespace CXml\Models;

use CXml\Models\Responses\ResponseInterface;

class Header
{
    private $fromIdentity;
    private $toIdentity;
    private $senderIdentity;
    private $senderSharedSecret;
    private $senderUserAgent;

    public function getSenderIdentity()
    {
        return $this->senderIdentity;
    }

    public function setSenderIdentity($senderIdentity): self
    {
        $this->senderIdentity = $senderIdentity;
        return $this;
    }

    public function getToIdentity()
    {
        return $this->toIdentity;
    }

    public function setToIdentity($toIdentity): self
    {
        $this->toIdentity = $toIdentity;
        return $this;
    }

    public function getFromIdentity()
    {
        return $this->fromIdentity;
    }

    public function setFromIdentity($fromIdentity): self
    {
        $this->fromIdentity = $fromIdentity;
        return $this;
    }

    public function getSenderSharedSecret()
    {
        return $this->senderSharedSecret;
    }

    public function setSenderSharedSecret($senderSharedSecret): self
    {
        $this->senderSharedSecret = $senderSharedSecret;
        return $this;
    }

    public function getSenderUserAgent()
    {
        return $this->senderUserAgent;
    }

    public function setSenderUserAgent($senderUserAgent): self
    {
        $this->senderUserAgent = $senderUserAgent;
        return $this;
    }

    public function parse(\SimpleXMLElement $headerXml): void
    {
        $this->fromIdentity = (string)$headerXml->xpath('From/Credential/Identity')[0];
        $this->toIdentity = (string)$headerXml->xpath('To/Credential/Identity')[0];
        $this->senderIdentity = (string)$headerXml->xpath('Sender/Credential/Identity')[0];
        $this->senderSharedSecret = (string)$headerXml->xpath('Sender/Credential/SharedSecret')[0];

        $senderUserAgent = $headerXml->xpath('Sender/UserAgent');
        if ($senderUserAgent) $this->senderUserAgent = (string)$senderUserAgent[0];
    }

    public function render(\SimpleXMLElement $parentNode): void
    {
        $headerNode = $parentNode->addChild('Header');

        $this->addNode($headerNode, 'From', $this->getFromIdentity() ?? 'Unknown');
        $this->addNode($headerNode, 'To', $this->getToIdentity() ?? 'Unknown');
        $this->addNode($headerNode, 'Sender', $this->getSenderIdentity() ?? 'Unknown', $this->getSenderSharedSecret() ?? 'Unknown')
            ->addChild('UserAgent', $this->getSenderUserAgent() ?? 'Unknown');
    }

    private function addNode(\SimpleXMLElement $parentNode, string $nodeName, string $identity, ?string $password = null): \SimpleXMLElement
    {
        $node = $parentNode->addChild($nodeName);

        $credentialNode = $node->addChild('Credential');
        $credentialNode->addAttribute('domain', 'DUNS');

        $credentialNode->addChild('Identity', $identity);

        if ($password) $credentialNode->addChild('SharedSecret', $password);

        return $node;
    }
}
