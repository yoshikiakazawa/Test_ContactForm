<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
        // 'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail',
    ];
    public function getGenderAttribute($value)
    {
        if ($value == 1) {
            return '男性';
        } elseif ($value == 2) {
            return '女性';
        } elseif ($value == 3) {
            return 'その他';
        } else {
            return null;
        }
    }
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
