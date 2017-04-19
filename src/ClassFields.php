<?php

namespace Mapper;

use \ArrayObject;

/**
 * Class ClassFields
 * @package Mapper
 */
class ClassFields extends ArrayObject {

    /**
     * @param ClassField $classField
     * @return ClassFields
     */
    public function add(ClassField $classField): ClassFields {
        $this->append($classField);

        return $this;
    }

    /**
     * @param string $field
     * @return bool
     */
    public function hasClassField(string $field): bool {
        /** @var ClassField $classField */
        foreach ($this as $classField) {
            if ($classField->getName() === $field) {
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
        /** @var ClassField $classField */
        foreach ($this as $classField) {
            if ($classField->getName() === $field) {
                return $classField;
            }
        }

        return null;
    }

}