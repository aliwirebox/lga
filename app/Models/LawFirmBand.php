<?php

namespace App\Models;

use App\Scopes\LawFirmOptionScope;
use DB;
use Illuminate\Database\Eloquent\Model;

class LawFirmBand extends Model
{
    use QueryRelationships;

    protected $fillable = [
        'name',
        'order',
        'rank',
        'parent_id',
        'is_option',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new LawFirmOptionScope);
    }

    /*** Scopes ***/

    public static function withOptions()
    {
        return with(new static)->newQueryWithoutScope(new LawFirmOptionScope);
    }

    public static function scopeGetParents($query)
    {
        $query->where('parent_id', null)->orderBy('order', 'ASC');
    }

    public static function scopeChildless($query)
    {
        $query->whereNotExists(function ($query) {
            $query->select(DB::raw(1))
                ->from('law_firm_bands as child_bands')
                ->whereRaw('child_bands.parent_id = law_firm_bands.id');
        })->orderBy('order', 'ASC');
    }

    /*** Relationships ***/

    public function children()
    {
        return $this->hasMany(LawFirmBand::class, 'parent_id')->orderBy('order', 'ASC');
    }

    public function lawFirm()
    {
        return $this->belongsToMany(LawFirm::class);
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class);
    }

    public function parent()
    {
        return $this->belongsTo(LawFirmBand::class, 'parent_id');
    }
}
