<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SdnEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'uid_xml', 'list_type', 'name', 'entity_type', 'remarks',
        'program_summary', 'source_date', 'version_ns', 'active',
    ];

    public function akas()        { return $this->hasMany(SdnAka::class); }
    public function addresses()   { return $this->hasMany(SdnAddress::class); }
    public function ids()         { return $this->hasMany(SdnId::class); }
    public function citizenships(){ return $this->hasMany(SdnCitizenship::class); }
    public function programs()    { return $this->hasMany(SdnProgram::class); }
}
