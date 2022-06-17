<?php

namespace Src\Common\Dto\Object;

class BoolObject extends AbstractObject {

    protected ?bool $value = false;

    protected string $type = self::BOOL_TYPE;

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
        ];
    }

    protected function is_true($val, $return_null=false){
        $boolval = ( is_string($val) ? filter_var($val, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) : (bool) $val );
        return ( $boolval===null && !$return_null ? false : $boolval );
    }

    public function loadAttributes(array $attrs)
    {
        $this->value = $this->is_true($attrs['value']);
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