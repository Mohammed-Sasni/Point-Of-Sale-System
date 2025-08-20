<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use Image; 
use Carbon\Carbon;

class Customer extends Model
{
    use HasFactory;
    protected $guarded = [];
}
