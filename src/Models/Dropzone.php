<?php

namespace RazaqulTegar\Dropzone\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Dropzone model for handling temporary uploaded files.
 */
class Dropzone extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'dropzones';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Scope a query to only include records the current user has permission to access.
     * This is usually based on the authenticated user's ID.
     */
    public function scopePermission(Builder $query): Builder
    {
        if (config('dropzone.check_permission', true) && auth()->check()) {
            return $query->where('user_id', auth()->id());
        }

        return $query;
    }
}
