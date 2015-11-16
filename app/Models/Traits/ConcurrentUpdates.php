<?php


namespace App\Models\Traits;


use App\Exceptions\ConcurrentModificationException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

trait ConcurrentUpdates
{
    /**
     * Perform a model update operation.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  array $options
     * @return bool
     * @throws ConcurrentModificationException
     */
    protected function performUpdate(Builder $query, array $options = [])
    {
        $dirty = $this->getDirty();

        if (count($dirty) > 0) {
            // If the updating event returns false, we will cancel the update operation so
            // developers can hook Validation systems into their models and cancel this
            // operation if the model does not pass validation. Otherwise, we update.
            if ($this->fireModelEvent('updating') === false) {
                return false;
            }

            // First we need to create a fresh query instance and touch the creation and
            // update timestamp on the model which are maintained by us for developer
            // convenience. Then we will just continue saving the model instances.
            if ($this->timestamps && Arr::get($options, 'timestamps', true)) {
                $this->updateTimestamps();
            }

            // Once we have run the update operation, we will fire the "updated" event for
            // this model instance. This will allow developers to hook into these after
            // models are updated, giving them a chance to do any special processing.
            $dirty = $this->getDirty();

            if (count($dirty) > 0) {
                $dirty['version'] = $this->getUpdatedVersion();

                $numRows = $this->setKeysForSaveQuery($query)->update($dirty);

                if($numRows == 0)
                    throw new ConcurrentModificationException();

                $this->fireModelEvent('updated', false);
            }
        }

        return true;
    }

    private function getUpdatedVersion() {
        return $this->getOriginal('version') + 1;
    }

    /**
     * Perform the actual delete query on this model instance.
     *
     * @throws ConcurrentModificationException
     */
    protected function performDeleteOnModel()
    {
        $numRows = $this->setKeysForSaveQuery($this->newQueryWithoutScopes())->delete();

        if($numRows == 0)
            throw new ConcurrentModificationException();
    }

    /**
     * Set the keys for a save update query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function setKeysForSaveQuery(Builder $query)
    {
        $query->where($this->getKeyName(), '=', $this->getKeyForSaveQuery());
        $query->where('version', '=', $this->version); // Make this read the old version, not our updated one

        return $query;
    }
}