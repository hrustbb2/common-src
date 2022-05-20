<?php

namespace Src\Common\Dto\Object;

class NestedComposite extends AbstractComposite {

    const NESTED_COMPOSIT = 'nested-composit';

    public function init()
    {
        $this->type = self::NESTED_COMPOSIT;
        $this->description = 'Example';

        $name = $this->fieldsFactory->createObjectField(AbstractComposite::STRING_TYPE);
        $name->setDescriptionStr('name');
        $this->fields['name'] = $name;

        $text = $this->fieldsFactory->createObjectField(AbstractComposite::TEXT_TYPE);
        $text->setDescriptionStr('Text');
        $this->fields['text'] = $text;
    }

}