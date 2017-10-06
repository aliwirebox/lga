<?php

namespace App\Models;

trait QueryRelationships
{
    public function scopeWhereHasRelationIds($query, $relationName, array $relationIdList)
    {
        $query->whereHas($relationName, function ($query) use ($relationIdList) {
            $query->whereIn('id', $relationIdList)
                ->havingRaw('COUNT(id) = ?', [count($relationIdList)]);
        });
    }

    public function scopeWhereAnyRelationIds($query, $relationName, array $relationIdList)
    {
        $query->whereHas($relationName, function ($query) use ($relationIdList) {
            $query->whereIn('id', $relationIdList);
        });
    }

    public function scopeWhereNoRelationIds($query, $relationName, array $relationIdList)
    {
        $query->whereDoesntHave($relationName, function ($query) use ($relationIdList) {
            $query->whereIn('id', $relationIdList);
        });
    }
}
