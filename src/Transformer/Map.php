<?php

namespace Camillebaronnet\ETL\Transformer;

class Map implements TransformInterface
{
    public $fields = [];

    public $keepUnmapped = false;

    public function __invoke(array $data): array
    {
        foreach ($data as $key => $value) {
            $newName = $this->fields[$key] ?? null;

            if(!$newName && in_array($key, $this->fields, true)){
                $newName = $key;
            }

            if ($newName) {
                if ($newName !== $key) {
                    $data[$newName] = $value;
                    unset($data[$key]);
                }
            } elseif (!$this->keepUnmapped) {
                unset($data[$key]);
            }
        }

        return $data;
    }
}
