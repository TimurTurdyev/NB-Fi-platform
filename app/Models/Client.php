<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Client extends Model
{
    use HasFactory, AsSource, Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'patronymic',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'id',
        'firstname',
        'lastname',
        'patronymic',
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'firstname',
        'lastname',
        'patronymic',
        'updated_at',
        'created_at',
    ];

    public function getFullAttribute(): string
    {
        $full =  array_filter([
            $this->attributes['firstname'],
            $this->attributes['lastname'],
            $this->attributes['patronymic'],
        ]);

        return join(' ', $full);
    }

    public function places(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Place::class);
    }
}
