<?php

namespace Src\Common\Dto\Object;

use Src\Common\Interfaces\Dto\Object\IFactory as IFieldsFactory;

class ObjectsArray extends AbstractObject {
    
    protected string $type = self::ARRAY_TYPE;

    protected array $itemsSettings = [];

    /**
     * @var AbstractObject[]
     */
    protected array $items = [];

    protected ?string $itemDescription;

    protected IFieldsFactory $fieldsFactory;

    public function setItemDescription(string $description)
    {
        $this->itemDescription = $description;
    }
    
    public function setFieldsFactory(IFieldsFactory $factory)
    {
        $this->fieldsFactory = $factory;
    }

    public function appendItemsType(string $type, string $description, string $labelField = '')
    {
        $this->itemsSettings[] = [
            'type' => $type,
            'description' => $description,
            'label' => $labelField,
        ];
    }

    public function getAttributes()
    {
        $items = array_map(function(AbstractObject $item){
            $attrs = $item->getAttributes();
            $attrs['type'] = $item->getType();
            return $attrs;
        }, $this->items);
        return [
            'items' => $items,
        ];
    }

    public function getJson()
    {
        $items = array_map(function(AbstractObject $item){
            $json = $item->getJson();
            $descriptionStr = (key_exists('value', $json)) ? $json['value'] : $this->itemDescription;
            $item->setDescriptionStr($descriptionStr);
            return $item->getJson();
        }, $this->items);
        $protoTypesJson = [];
        foreach($this->itemsSettings as $itemSetting){
            $protoType = $this->fieldsFactory->createObjectField($itemSetting['type']);
            $protoType->setDescriptionStr($this->itemDescription);
            $protoTypesJson[$itemSetting['type']] = [
                'proto' => $protoType->getJson(),
                'description' => $itemSetting['description'],
                'label_field' => $itemSetting['label'],
            ];
        }
        return [
            'type' => $this->type,
            'composite' => false,
            'item_proto' => $protoTypesJson,
            'description' => $this->description,
            'items' => $items,
            'errors' => $this->errors,
        ];
    }

    public function loadAttributes(array $attrs)
    {
        $this->items = [];
        foreach($attrs['items'] as $itemAttrs){
            $item = $this->fieldsFactory->createObjectField($itemAttrs['type']);
            $item->loadAttributes($itemAttrs);
            $this->items[] = $item;
        }
    }

    public function getItems()
    {
        return $this->items;
    }

}