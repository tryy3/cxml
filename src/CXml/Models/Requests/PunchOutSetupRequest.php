<?php

namespace CXml\Models\Requests;

class PunchOutSetupRequest implements RequestInterface
{
    /** @var string|null */
    private $operation;

    /** @var string|null */
    private $buyerCookie;

    /** @var string|null */
    private $browserFormPostUrl;

    /** @var string|null */
    private $username;

    /** @var string|null */
    private $contactName;

    /** @var string|null */
    private $contactEmail;

    /** @noinspection PhpUndefinedFieldInspection */
    public function parse(\SimpleXMLElement $requestNode): void
    {
        $this->operation = (string)$requestNode->attributes()->operation;
        $this->buyerCookie = $requestNode->xpath('BuyerCookie')[0];
        $this->browserFormPostUrl = $requestNode->xpath('BrowserFormPost/URL')[0];
        $this->username = (string)$requestNode->xpath('Extrinsic')[0];
        $this->contactName = $requestNode->xpath('Contact/Name')[0];
        $this->contactEmail = $requestNode->xpath('Contact/Email')[0];
    }

    public function getOperation(): ?string
    {
        return $this->operation;
    }

    public function setOperation(?string $operation): self
    {
        $this->operation = $operation;
        return $this;
    }

    public function getBuyerCookie(): ?string
    {
        return $this->buyerCookie;
    }

    public function setBuyerCookie(?string $buyerCookie): self
    {
        $this->buyerCookie = $buyerCookie;
        return $this;
    }

    public function getBrowserFormPostUrl(): ?string
    {
        return $this->browserFormPostUrl;
    }

    public function setBrowserFormPostUrl(?string $browserFormPostUrl): self
    {
        $this->browserFormPostUrl = $browserFormPostUrl;
        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): self
    {
        $this->username = $username;
        return $this;
    }

    public function getContactName(): ?string
    {
        return $this->contactName;
    }

    public function setContactName(?string $contactName): self
    {
        $this->contactName = $contactName;
        return $this;
    }

    public function getContactEmail(): ?string
    {
        return $this->contactEmail;
    }

    public function setContactEmail(?string $contactEmail): self
    {
        $this->contactEmail = $contactEmail;
        return $this;
    }
}
