<?php

declare(strict_types=1);

namespace App\Entity\Traits;

use Doctrine\Common\Collections\Collection;

trait CollectionDisplay
{
    public function getCollectionAsString(Collection $collection, ?string $collectionName = null, int $maxItems = 3, string $separator = ', '): ?string
    {
        $collectionAsString = '';
        $count = count($collection);
        if ($count) {
            $collectionAsString = $collectionName ? $collectionName . ': ' : '';
            $slicedCollection = array_slice($collection->toArray(), 0, $maxItems);
            $collectionAsString .= implode($separator, $slicedCollection);
            if ($count > count($slicedCollection)) {
                $collectionAsString .= sprintf(' and %s more', $count - count($slicedCollection));
            }
        }
        return $collectionAsString;
    }

    public function getCollectionCountAsString(Collection $collection, string $collectionName): ?string
    {
        $count = count($collection);
        return $collectionName . ': ' . count($collection) . ' ' . ($count === 1 ? 'item' : 'items');
    }
}
