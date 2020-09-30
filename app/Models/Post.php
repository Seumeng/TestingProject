<?php

namespace App\Models;




use App\Traits\Likeability;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Post extends Model
{
    use HasFactory;

    use Likeability;
}
