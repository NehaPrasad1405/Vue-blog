<?php

namespace App;
use App\Traits\Search;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use Search;
    protected $fillable =['name','description'];
}
