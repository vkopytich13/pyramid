<?php

namespace App\DB\Builder;

class Builder
{
    /**
     * @var array
     */
    private array $collections = [];

    /**
     * @param string $className
     * @return CollectionInterface
     */
    public function make(string $className): CollectionInterface
    {
        $found = null;
        foreach ($this->collections as $collection) {
            if ($collection instanceof CollectionInterface) {
                $found = $collection;
                break;
            }
        }

        if (!$found instanceof CollectionInterface) {
            $found = new $className();
            $this->collections[] = $found;
        }

        return $found;
    }

    /**
     * @return FieldCollection
     */
    public function fields(): FieldCollection
    {
        return $this->make(FieldCollection::class);
    }

    /**
     * @return WhereCollection
     */
    public function where(): WhereCollection
    {
        echo "<pre>";
        var_dump($this->make(WhereCollection::class));
        echo "</pre>";
    }
}
