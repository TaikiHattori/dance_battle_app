<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    use HasFactory;

    protected $fillable = ['text', 'extraction_id'];

  public function extraction()
  {
    return $this->belongsTo(Extraction::class);
  }
}
