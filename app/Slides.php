<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slides extends Model
{
  protected $table = 'slides';
  protected $primaryKey = 'id';
  protected $guarded = ['id'];
}
