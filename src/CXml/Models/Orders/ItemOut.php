<?php

namespace CXml\Models\Orders;

use CXml\Models\Requests\RequestInterface;

class ItemOut
{
    /** @var int */
    private $quantity;

    /** @var string Product SKU */
    private $supplierPartId;

    /**
     * @var string Id to enable order / cart restore
     */
    private $supplierPartAuxiliaryID;

    /** @var float */
    private $unitPrice;

    /** @var string */
    private $currency;

    /** @var string Product name */
    private $description;

    /** @var string */
    private $unitOfMeasure;

    /** @var string */
    private $classificationDomain;

    /** @var string */
    private $classification;

    /** @var string */
    private $manufacturerPartId;

    /** @var string */
    private $manufacturerName;

    /** @var int|null */
    private $leadTime;

    /** @noinspection PhpUndefinedFieldInspection */
    public function parse(\SimpleXMLElement $requestNode): ItemOut
    {
        $this->quantity = intval($requestNode->attributes()->quantity);
        if ($requestNode->xpath('ItemID/SupplierPartID')) $this->supplierPartID = $requestNode->xpath('ItemID/SupplierPartID')[0];
        if ($requestNode->xpath('ItemID/SupplierPartAuxiliaryID')) $this->supplierPartAuxiliaryID = $requestNode->xpath('ItemID/SupplierPartAuxiliaryID')[0];
        if ($requestNode->xpath('ItemDetail/UnitPrice/Money')) $this->unitPrice = floatval($requestNode->xpath('ItemDetail/UnitPrice/Money')[0]);
        if ($requestNode->xpath('ItemDetail/UnitPrice/Money')) $this->currency = $requestNode->xpath('ItemDetail/UnitPrice/Money')[0]->attributes()->currency;
        if ($requestNode->xpath('ItemDetail/Description')) $this->description = $requestNode->xpath('ItemDetail/Description')[0];
        if ($requestNode->xpath('ItemDetail/UnitOfMeasure')) $this->unitOfMeasure = $requestNode->xpath('ItemDetail/UnitOfMeasure')[0];
        if ($requestNode->xpath('ItemDetail/Classification')) $this->classificationDomain = $requestNode->xpath('ItemDetail/Classification')[0]->attributes()->domain;
        if ($requestNode->xpath('ItemDetail/Classification')) $this->classification = $requestNode->xpath('ItemDetail/Classification')[0];
        if ($requestNode->xpath('ItemDetail/ManufacturerPartID')) $this->manufacturerPartId = $requestNode->xpath('ItemDetail/ManufacturerPartID')[0];
        if ($requestNode->xpath('ItemDetail/ManufacturerName')) $this->manufacturerName = $requestNode->xpath('ItemDetail/ManufacturerName')[0];
        if ($requestNode->xpath('ItemDetail/LeadTime')) $this->leadTime = $requestNode->xpath('ItemDetail/LeadTime')[0];
        return $this;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getSupplierPartID(): string
    {
        return $this->supplierPartID;
    }

    public function setSupplierPartID(string $supplierPartID): self
    {
        $this->supplierPartID = $supplierPartID;
        return $this;
    }

    /**
     * @return string
     */
    public function getSupplierPartAuxiliaryID(): ?string
    {
        return $this->supplierPartAuxiliaryID;
    }

    /**
     * @param string $supplierPartAuxiliaryID
     *
     * @return ItemIn
     */
    public function setSupplierPartAuxiliaryID(string $supplierPartAuxiliaryID): self
    {
        $this->supplierPartAuxiliaryID = $supplierPartAuxiliaryID;
        return $this;
    }

    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    public function setUnitPrice(float $unitPrice): self
    {
        $this->unitPrice = $unitPrice;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getUnitOfMeasure(): string
    {
        return $this->unitOfMeasure;
    }

    public function setUnitOfMeasure(string $unitOfMeasure): self
    {
        $this->unitOfMeasure = $unitOfMeasure;
        return $this;
    }

    public function getClassificationDomain(): string
    {
        return $this->classificationDomain;
    }

    public function setClassificationDomain(string $classificationDomain): self
    {
        $this->classificationDomain = $classificationDomain;
        return $this;
    }

    public function getClassification(): string
    {
        return $this->classification;
    }

    public function setClassification(string $classification): self
    {
        $this->classification = $classification;
        return $this;
    }

    public function getManufacturerPartId(): string
    {
        return $this->manufacturerPartId;
    }

    public function setManufacturerPartId(string $manufacturerPartId): self
    {
        $this->manufacturerPartId = $manufacturerPartId;
        return $this;
    }

    public function getManufacturerName(): string
    {
        return $this->manufacturerName;
    }

    public function setManufacturerName(string $manufacturerName): self
    {
        $this->manufacturerName = $manufacturerName;
        return $this;
    }

    public function render(\SimpleXMLElement $parentNode, string $currency, string $locale): void
    {
        $node = $parentNode->addChild('ItemIn');
        $node->addAttribute('quantity', $this->quantity);

        // ItemID
        $itemIdNode = $node->addChild('ItemID');
        $itemIdNode->addChild('SupplierPartID', $this->supplierPartId);

        if ($this->supplierPartAuxiliaryID) {
            $itemIdNode->addChild('SupplierPartAuxiliaryID', htmlspecialchars($this->supplierPartAuxiliaryID, ENT_XML1 | ENT_COMPAT, 'UTF-8'));
        }

        // ItemDetails
        $itemDetailsNode = $node->addChild('ItemDetail');

        // UnitPrice
        $itemDetailsNode->addChild('UnitPrice')->addChild('Money', $this->formatPrice($this->unitPrice))
            ->addAttribute('currency', $currency);

        // Description
        $itemDetailsNode->addChild('Description', $this->description)
            ->addAttribute('xml:xml:lang', $locale);

        // UnitOfMeasure
        $itemDetailsNode->addChild('UnitOfMeasure', $this->unitOfMeasure);

        // Classification
        $itemDetailsNode->addChild('Classification', $this->classification)
            ->addAttribute('domain', $this->classificationDomain);

        // Manufacturer
        $itemDetailsNode->addChild('ManufacturerPartID', $this->manufacturerPartId);
        $itemDetailsNode->addChild('ManufacturerName', $this->manufacturerName);

        // LeadTime
        if ($this->leadTime !== null) {
            $itemDetailsNode->addChild('LeadTime', $this->leadTime);
        }
    }

    private function formatPrice(float $price)
    {
        return number_format($price, 2, '.', '');
    }

    public function getLeadTime(): ?int
    {
        return $this->leadTime;
    }

    public function setLeadTime(?int $leadTime): self
    {
        $this->leadTime = $leadTime;
        return $this;
    }
}
