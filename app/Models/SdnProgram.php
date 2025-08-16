<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SdnProgram extends Model
{
    use HasFactory;
    protected $fillable = ['sdn_entry_id','program_code'];
    public function sdnEntry() { return $this->belongsTo(SdnEntry::class); }
}
