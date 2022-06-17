<?php

namespace Src\Common\Dto\Object;

class SelectObject extends AbstractObject {

    protected ?string $value = null;

    protected string $type = self::SELECT_TYPE;

    protected array $options = [];

    public function getAttributes()
    {
        return [
            'value' => $this->value ?? '',
        ];
    }

    public function getJson()
    {
        return [
            'type' => $this->type,
            'composite' => false,
            'description' => $this->getTitle(),
            'value' => $this->value,
            'errors' => $this->errors,
            'options' => $this->options,
        ];
    }

    public function loadAttributes(array $attrs)
    {
        $this->value = $attrs['value'];
    }

    public function getValue()
    {
        return $this->value;
    }

    public function appendOption($val, string $title)
    {
        $this->options[] = [
            'value' => $val,
            'title' => $title,
        ];
    }

    public function setValue($value): void
    {
        $this->value = $value;
    }

}