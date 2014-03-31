<?php

namespace Acme\HandmadeBundle\Model;


interface CategoryHandlerInterface
{
    public function get($id);

    public function getList();

    public function getBySlug($slug);

    /**
     * Перелаживатель
     * @param $data object|array
     */
    public function transfer($data);

}