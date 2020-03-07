<?php

namespace Composito\Traits;

use Composito\Exceptions\MissingPrimaryKeysException;
use Illuminate\Database\Eloquent\Builder;

trait HasCompositePrimaryKey
{
    /**
     * Determine whether the model has primary keys or not.
     * @return bool
     */
    protected function hasMultiplePrimaryKeys(): bool
    {
        return $this->primaryKey
            && is_array($this->primaryKey)
            && count($this->primaryKey);
    }

    /**
     * Get the primary keys of the model.
     * @return array
     * @throws MissingPrimaryKeysException
     */
    protected function getPrimaryKeys(): array
    {
        if (!$this->hasMultiplePrimaryKeys())
            throw new MissingPrimaryKeysException();

        return $this->primaryKey;
    }

    /**
     * Set the keys for a save update query.
     * @param Builder $query
     * @return Builder
     * @throws MissingPrimaryKeysException
     */
    protected function setKeysForSaveQuery(Builder $query)
    {
        $keys = $this->getPrimaryKeys();

        foreach ($keys as $key)
            $query->where($key, '=', $this->getKeyForSaveQuery($key));

        return $query;
    }

    /**
     * Get the primary key value for a save query.
     * @param mixed $keyName
     * @return mixed
     */
    protected function getKeyForSaveQuery($keyName = null)
    {
        if (is_null($keyName))
            $keyName = $this->getKeyName();

        if (isset($this->original[$keyName]))
            return $this->original[$keyName];

        return $this->getAttribute($keyName);
    }
}