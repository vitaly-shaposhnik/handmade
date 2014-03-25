<?php

namespace Acme\HandmadeBundle\Traits;


trait Transfer {
    public function transferObjectToDto($object, $dto) {
        $fetcher = function($object) {
            $getter = function(){
                return get_object_vars($this);
            };

            return $getter->bindTo($object, $object);
        };

        $putter = function($fetcher, $dto) {
            foreach ($fetcher() as $variable => $value) {
                if (property_exists($dto, $variable)) {
                    $dto->$variable = $value;
                }
            }

            return $dto;
        };

        return $putter($fetcher($object), $dto);
    }
}