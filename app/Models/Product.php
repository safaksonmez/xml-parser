<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'id',
        'name',
        'description',
        'price',
        'quantity',
        'photo_url',
    ];

    public static function fromXml($productXml)
    {
        return self::updateOrCreate(
            ['id' => (int) $productXml->id],
            [
                'name' => (string) $productXml->name,
                'description' => (string) $productXml->description,
                'price' => (float) $productXml->price,
                'quantity' => (int) $productXml->quantity,
                'photo_url' => (string) $productXml->photo_url,
            ]
        );
    }
}
