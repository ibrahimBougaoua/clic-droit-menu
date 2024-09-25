<?php

namespace IbrahimBougaoua\ClicDroitMenu\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuickActionSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'header_label',
        'header_back_color',
        'header_btn_color',
        'header_url',
        'header_icon',
        'header_status',
        'search_status',
        'footer_label',
        'footer_icon',
        'footer_btn_color',
        'footer_status',
        'max_items',
        'max_sub_items',
        'is_collapsed',
        'is_global',
        'status',
    ];
}
