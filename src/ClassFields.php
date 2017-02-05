<?php

namespace Mapper;

use \ArrayObject;

/**
 * Class ClassFields
 * @package Mapper
 */
class ClassFields extends ArrayObject {

    /**
     * @param ClassField $setter
     * @return ClassFields
     */
    public function add(ClassField $setter): ClassFields {
        parent::append($setter);

        return $this;
    }

    /**
     * @param string $field
     * @return bool
     */
    public function hasClassField(string $field): bool {
        /** @var ClassField $setter */
        foreach ($this as $setter) {
            if ($setter->getField() === $field) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $field
     * @return ClassField|null
     */
    public function getClassField(string $field): ?ClassField {
        /** @var ClassField $setter */
        foreach ($this as $setter) {
            if ($setter->getField() === $field) {
                return $setter;
            }
        }

        return null;
    }

}