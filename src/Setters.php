<?php

namespace Mapper;

use \ArrayObject;

/**
 * Class Setters
 * @package Mapper
 */
class Setters extends ArrayObject {

    /**
     * @param Setter $setter
     * @return Setters
     */
    public function add(Setter $setter): Setters {
        parent::append($setter);

        return $this;
    }

    /**
     * @param string $field
     * @return bool
     */
    public function hasSetter(string $field): bool {
        /** @var Setter $setter */
        foreach ($this as $setter) {
            if ($setter->getField() === $field) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $field
     * @return Setter|null
     */
    public function getSetter(string $field): ?Setter {
        /** @var Setter $setter */
        foreach ($this as $setter) {
            if ($setter->getField() === $field) {
                return $setter;
            }
        }

        return null;
    }

}