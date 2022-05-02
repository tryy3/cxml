<?php

namespace CXml\Models\Orders;

use CXml\Models\Requests\RequestInterface;

class OrderRequest implements RequestInterface
{
    /** @var string|null */
    private $orderDate;

    /** @var string|null */
    private $orderType;

    /** @var string|null */
    private $orderID;

    /** @var string|null */
    private $currency;

    /** @var Address|null */
    private $shipTo;

    /** @var Address|null */
    private $billTo;

    /** @var Contact|null */
    private $contact;

    /** @var ItemOut[]|null */
    private $itemOuts;

    /** @noinspection PhpUndefinedFieldInspection */
    public function parse(\SimpleXMLElement $requestNode): void
    {
        $attributes = $requestNode->xpath('OrderRequestHeader')[0]->attributes();
        $orderDate = $attributes->orderDate;
        $orderType = $attributes->type;
        $orderID = $attributes->orderID;
        $this->total = $requestNode->xpath('OrderRequestHeader/Total/Money')[0];
        $this->currency = $requestNode->xpath('OrderRequestHeader/Total/Money')[0]->attributes()->currency;
        $this->shipTo = (new Address())->parse($requestNode->xpath('OrderRequestHeader/ShipTo')[0]);
        $this->billTo = (new Address())->parse($requestNode->xpath('OrderRequestHeader/BillTo')[0]);
        $this->contact = (new Contact())->parse($requestNode->xpath('OrderRequestHeader/Contact')[0]);
        $this->itemOuts = [];
        foreach ($requestNode->xpath('ItemOut') as $item) {
            $this->itemOuts[] = (new ItemOut())->parse($item);
        }
    }

    public function getOrderDate(): ?string
    {
        return $this->orderDate;
    }

    public function setOrderDate(?string $orderDate): self
    {
        $this->orderDate = $orderDate;
        return $this;
    }

    public function getOrderType(): ?string
    {
        return $this->orderType;
    }

    public function setOrderType(?string $orderType): self
    {
        $this->orderType = $orderType;
        return $this;
    }

    public function getOrderID(): ?string
    {
        return $this->orderID;
    }

    public function setOrderID(?string $orderID): self
    {
        $this->orderID = $orderID;
        return $this;
    }

    public function getTotal(): ?string
    {
        return $this->total;
    }

    public function setTotal(?string $total): self
    {
        $this->total = $total;
        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(?string $currency): self
    {
        $this->currency = $currency;
        return $this;
    }

    public function getShipTo(): Address
    {
        return $this->shipTo;
    }

    public function setShipTo(Address $shipTo): self
    {
        $this->shipTo = $shipTo;
        return $this;
    }

    public function getBillTo(): Address
    {
        return $this->billTo;
    }

    public function setBillTo(Address $billTo): self
    {
        $this->billTo = $billTo;
        return $this;
    }

    public function getContact(): Contact
    {
        return $this->contact;
    }

    public function setContact(Contact $contact): self
    {
        $this->contact = $contact;
        return $this;
    }

    public function getItemOuts(): array
    {
        return $this->itemOuts;
    }

    public function setItemOuts(array $itemOuts): self
    {
        $this->itemOuts = $itemOuts;
        return $this;
    }
}
