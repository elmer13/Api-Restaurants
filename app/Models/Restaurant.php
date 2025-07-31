<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Restaurant",
 *     type="object",
 *     title="Restaurant",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Restaurant 1"),
 *     @OA\Property(property="address", type="string", example="C/Sant Pere d'abanto, 13, 08014 (Barcelona)"),
 *     @OA\Property(property="phone", type="string", example="+34601436955")
 * )
*/
class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'address', 'phone'
    ];
}

