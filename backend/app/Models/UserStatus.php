<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class UserStatus extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'status_id',
        'profile_photo_path',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'status_id');
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(UserStatus::class, 'status_id');
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'teacher_students',
            'teacher_id',
            'student_id'
        )->withTimestamps();
    }

    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'teacher_students',
            'student_id',
            'teacher_id'
        )->withTimestamps();
    }

    public function hasRole(string $role): bool
    {
        return $this->role?->name === $role;
    }
}
