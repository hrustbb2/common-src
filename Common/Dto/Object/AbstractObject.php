<?php

namespace Src\Common\Dto\Object;

abstract class AbstractObject {

    const STRING_TYPE = 'string';
    
    const TEXT_TYPE = 'text';

    const COLOR_TYPE = 'color';

    const BOOL_TYPE = 'bool';

    const SELECT_TYPE = 'select';

    const FILE_TYPE = 'file';

    const IMAGE_TYPE = 'image';

    const ARRAY_TYPE = 'array';

    const COMPOSITE_TYPE = 'composite';

    protected string $type;

    protected ?string $description = null;

    protected array $errors = [];

    public function setDescriptionStr(string $description)
    {
        $this->description = $description;
    }
    
    public function getTitle()
    {
        return $this->description;
    }

    protected function getType()
    {
        return $this->type;
    }

    public function appendErrorMessage(string $message)
    {
        $this->errors[] = $message;
    }

    abstract public function getAttributes();

    abstract public function getJson();

    abstract public function loadAttributes(array $attrs);

}