<?php

namespace CXml\Models\Orders;

use CXml\Models\Requests\RequestInterface;

class Address
{
    /** @var string|null */
    private $name;

    /** @var string|null */
    private $deliverTo;

    /** @var string|null */
    private $street;

    /** @var string|null */
    private $city;

    /** @var string|null */
    private $postalCode;

    /** @var string|null */
    private $country;

    /** @var string|null */
    private $countryCode;

    /** @var string|null */
    private $email;

    /** @var string|null */
    private $phone;

    /** @var string|null */
    private $phoneCountry;

    /** @noinspection PhpUndefinedFieldInspection */
    public function parse(\SimpleXMLElement $requestNode): Address
    {
        if ($requestNode->xpath('Address/Name')) $this->name = $requestNode->xpath('Address/Name')[0];
        if ($requestNode->xpath('Address/PostalAddress/DeliverTo')) $this->deliverTo = $requestNode->xpath('Address/PostalAddress/DeliverTo')[0];
        if ($requestNode->xpath('Address/PostalAddress/Street')) $this->street = $requestNode->xpath('Address/PostalAddress/Street')[0];
        if ($requestNode->xpath('Address/PostalAddress/City')) $this->city = $requestNode->xpath('Address/PostalAddress/City')[0];
        if ($requestNode->xpath('Address/PostalAddress/PostalCode')) $this->postalCode = $requestNode->xpath('Address/PostalAddress/PostalCode')[0];
        if ($requestNode->xpath('Address/PostalAddress/Country')) $this->country = $requestNode->xpath('Address/PostalAddress/Country')[0];
        if ($requestNode->xpath('Address/PostalAddress/Country')) $this->countryCode = $requestNode->xpath('Address/PostalAddress/Country')[0]->attributes()->isoCountryCode;
        if ($requestNode->xpath('Address/Email')) $this->email = $requestNode->xpath('Address/Email')[0];
        if ($requestNode->xpath('Address/Phone/TelephoneNumber/Number')) $this->phone = $requestNode->xpath('Address/Phone/TelephoneNumber/Number')[0];
        if ($requestNode->xpath('Address/Phone/TelephoneNumber/CountryCode')) $this->phoneCountry = $requestNode->xpath('Address/Phone/TelephoneNumber/CountryCode')[0]->attributes()->isoCountryCode;
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

    public function getDeliverTo(): ?string
    {
        return $this->deliverTo;
    }

    public function setDeliverTo(?string $deliverTo): self
    {
        $this->deliverTo = $deliverTo;
        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): self
    {
        $this->street = $street;
        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;
        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(?string $postalCode): self
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;
        return $this;
    }

    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    public function setCountryCode(?string $countryCode): self
    {
        $this->countryCode = $countryCode;
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
