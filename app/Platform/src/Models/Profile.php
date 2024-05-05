<?php

namespace App\Platform\Models;

use App\Admin\Models\User;
use Database\Factories\MemberProfileFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): Factory
    {
        return MemberProfileFactory::new();
    }
}
