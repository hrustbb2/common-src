<?php

namespace Src\Common\Dto\Object;

class ImageObject extends AbstractObject {

    protected ?string $value = null;

    protected string $type = self::IMAGE_TYPE;

    protected string $path = '/img';

    protected float $ar = 0;

    public function setPath(string $path)
    {
        $this->path = $path;
    }

    public function setAR(float $ar)
    {
        $this->ar = $ar;
    }

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
            'path' => $this->path,
            'ar' => $this->ar,
            'errors' => $this->errors,
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

    public function setValue($value): void
    {
        $this->value = $value;
    }

}