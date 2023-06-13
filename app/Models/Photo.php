<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Laravel\Sanctum\HasApiTokens;


class Photo extends Model
{
    use HasFactory;

    protected $fillable=['name','path','created_at','updated_at'];


}