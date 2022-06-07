<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *   schema="Announce",
 *   title="Announce",
 *   description="Announce",
 *   @OA\Property(
 *     property="id",
 *     type="integer",
 *   ),
 *   @OA\Property(
 *     property="title",
 *     type="string",
 *   ),
 *   @OA\Property(
 *     property="content",
 *     type="string",
 *   ),
 *   @OA\Property(
 *     property="created_at",
 *     type="string",
 *     format="date-time",
 *   ),
 *   @OA\Property(
 *     property="updated_at",
 *     type="string",
 *     format="date-time",
 *   ),
 * )
 */

class Announce extends Model
{


    use HasFactory;

    protected $fillable = ['title', 'content'];
}
