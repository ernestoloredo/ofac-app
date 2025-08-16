<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportLog extends Model
{
    protected $fillable = [
        'list_type','file_path','sha256','total','inserted','updated','deactivated','status'
    ];
}
