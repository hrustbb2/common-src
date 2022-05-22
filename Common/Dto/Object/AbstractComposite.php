<?php

namespace Src\Common\Dto\Object;

use Src\Common\Interfaces\Dto\Object\IFactory as IFieldsFactory;

abstract class AbstractComposite extends AbstractObject {
    
    /**
     * @var AbstractObject[]
     */
    protected array $fields = [];

    protected IFieldsFactory $fieldsFactory;

    public function setFieldsFactory(IFieldsFactory $factory)
    {
        $this->fieldsFactory = $factory;
    }
    
    public function getAttributes()
    {
        $attrs = [];
        foreach($this->fields as $key=>$field){
            /** @var AbstractObject $field */
            $attrs[$key] = $field->getAttributes();
        }
        $attrs['type'] = $this->type;
        return $attrs;
    }

    public function getJson()
    {
        $fields = array_map(function(AbstractObject $field){
            return $field->getJson();
        }, $this->fields);
        return [
            'type' => $this->type,
            'composite' => true,
            'description' => $this->description,
            'fields' => $fields,
            'errors' => $this->errors,
        ];
    }

    public function loadAttributes(array $attrs)
    {
        foreach($attrs as $key=>$attr){
            /** @var AbstractObject $field */
            $field = $this->fields[$key] ?? null;
            if(!$field){
                continue;
            }
            $field->loadAttributes($attr);
        }
    }

    public function validate():bool
    {
        return true;
    }

    abstract public function init();

    public function onSave(): void
    {
        
    }

}