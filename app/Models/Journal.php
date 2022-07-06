<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_journal',
        'keterangan',
        'no_akun',
        'tgl_journal',
        'debet',
        'kredit',
    ];
}
