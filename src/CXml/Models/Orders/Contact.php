<?php

namespace CXml\Models\Orders;

use CXml\Models\Requests\RequestInterface;

class Contact
{
    /** @var string|null */
    private $name;

    /** @var string|null */
    private $email;

    /** @var string|null */
    private $phone;

    /** @var string|null */
    private $phoneCountry;

    /** @noinspection PhpUndefinedFieldInspection */
    public function parse(\SimpleXMLElement $requestNode): Contact
    {
        if ($requestNode->xpath('Name')) $this->name = $requestNode->xpath('Name')[0];
        if ($requestNode->xpath('Email')) $this->email = $requestNode->xpath('Email')[0];
        if ($requestNode->xpath('Phone/TelephoneNumber/Number')) $this->phone = $requestNode->xpath('Phone/TelephoneNumber/Number')[0];
        if ($requestNode->xpath('Phone/TelephoneNumber/CountryCode')) $this->phoneCountry = $requestNode->xpath('Phone/TelephoneNumber/CountryCode')[0]->attributes()->isoCountryCode;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    public function getPhoneCountry(): ?string
    {
        return $this->phoneCountry;
    }

    public function setPhoneCountry(?string $phoneCountry): self
    {
        $this->phoneCountry = $phoneCountry;
        return $this;
    }
}
