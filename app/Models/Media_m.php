<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;


use Illuminate\Database\Eloquent\Model;

 
class Media_m extends Model
{
      protected $table = 'media';
      public function getmediacategory(){
      		return DB::table('media')
      				->distinct('module')
                     ->orderByRaw('module')
                     //->groupBy('module')
                     ->get();
    }
}
