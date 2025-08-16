<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SdnAddress extends Model
{
    use HasFactory;
    protected $fillable = ['sdn_entry_id','address1','address2','city','state','postal','country'];
    public function sdnEntry() { return $this->belongsTo(SdnEntry::class); }
}
