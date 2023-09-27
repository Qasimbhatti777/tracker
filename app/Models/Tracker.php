<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes; // Add this line

class Tracker extends Model
{
    use HasFactory;
    use SoftDeletes; // Add this line
}
