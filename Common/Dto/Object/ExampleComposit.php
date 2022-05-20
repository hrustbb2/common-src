<?php

namespace Src\Common\Dto\Object;

class ExampleComposit extends AbstractComposite {

    const EXAMPLE_COMPOSIT = 'example-composit';

    public function init()
    {
        $this->type = self::EXAMPLE_COMPOSIT;
        $this->description = 'Example';

        $file = $this->fieldsFactory->createObjectField(AbstractComposite::FILE_TYPE);
        $file->setDescriptionStr('File');
        $this->fields['file'] = $file;

        /** @var ImageObject */
        $image = $this->fieldsFactory->createObjectField(AbstractComposite::IMAGE_TYPE);
        $image->setDescriptionStr('Image');
        $image->setPath('/uploads');
        $this->fields['image'] = $image;

        $color = $this->fieldsFactory->createObjectField(AbstractComposite::COLOR_TYPE);
        $color->setDescriptionStr('Color');
        $this->fields['color'] = $color;

        $name = $this->fieldsFactory->createObjectField(AbstractComposite::STRING_TYPE);
        $name->setDescriptionStr('name');
        $this->fields['name'] = $name;

        $text = $this->fieldsFactory->createObjectField(AbstractComposite::TEXT_TYPE);
        $text->setDescriptionStr('Text');
        $this->fields['text'] = $text;

        $object = $this->fieldsFactory->createObjectField(NestedComposite::NESTED_COMPOSIT);
        $object->setDescriptionStr('Object');
        $this->fields['obj'] = $object;

        /** @var ObjectsArray $array */
        $array = $this->fieldsFactory->createObjectField(AbstractComposite::ARRAY_TYPE);
        $array->setDescriptionStr('Array');
        $array->setItemDescription('Item str');
        $array->appendItemsType(AbstractComposite::STRING_TYPE, 'String');
        $this->fields['array'] = $array;

        /** @var ObjectsArray $arrayObj */
        $arrayObj = $this->fieldsFactory->createObjectField(AbstractComposite::ARRAY_TYPE);
        $arrayObj->setDescriptionStr('Array obj');
        $arrayObj->setItemDescription('Obj');
        $arrayObj->appendItemsType(NestedComposite::NESTED_COMPOSIT, 'Nested', 'name');
        $this->fields['array_obj'] = $arrayObj;
    }

    public function validate():bool
    {
        // Пример валидации
        // $this->fields['name']->appendErrorMessage('Error!!!');
        // return false;
        return true;
    }

}