<?php

namespace Src\Common\Dto\Object;

use Src\Common\Interfaces\Dto\Object\IFactory;

class Factory implements IFactory {

    public function init(array $conf = []): void
    {
        
    }
    
    public function createObjectField(string $type):?AbstractObject
    {
        if($type == AbstractComposite::ARRAY_TYPE){
            $array = new ObjectsArray();
            $array->setFieldsFactory($this);
            return $array;
        }
        if($type == AbstractComposite::STRING_TYPE){
            return new StringObject();
        }
        if($type == AbstractComposite::TEXT_TYPE){
            return new TextObject();
        }
        if($type == AbstractComposite::BOOL_TYPE){
            return new BoolObject();
        }
        if($type == AbstractComposite::COLOR_TYPE){
            return new ColorObject();
        }
        if($type == AbstractComposite::SELECT_TYPE){
            return new SelectObject();
        }
        if($type == AbstractComposite::FILE_TYPE){
            return new FileObject();
        }
        if($type == AbstractComposite::IMAGE_TYPE){
            return new ImageObject();
        }
        if($type == ExampleComposit::EXAMPLE_COMPOSIT){
            $object = new ExampleComposit();
            $object->setFieldsFactory($this);
            $object->init();
            return $object;
        }
        if($type == NestedComposite::NESTED_COMPOSIT){
            $object = new NestedComposite();
            $object->setFieldsFactory($this);
            $object->init();
            return $object;
        }
        return null;
    }

}