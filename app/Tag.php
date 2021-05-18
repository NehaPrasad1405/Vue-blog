<?php

namespace App;
use App\Traits\Search;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use Search;
    protected $fillable =['name'];
    
}
