<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SdnId extends Model
{
    use HasFactory;
    protected $fillable = ['sdn_entry_id','type','number','country'];
    public function sdnEntry() { return $this->belongsTo(SdnEntry::class); }
}
