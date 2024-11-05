<?php

namespace IbrahimBougaoua\ClicDroitMenu\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuickAction extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'url',
        'icon',
        'badge_text',
        'badge_color',
        'status',
        'parent_id',
    ];

    public function scopeRoot($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeChild($query)
    {
        return $query->whereNotNull('parent_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function parent()
    {
        return $this->belongsTo(QuickAction::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(QuickAction::class, 'parent_id');
    }
}
