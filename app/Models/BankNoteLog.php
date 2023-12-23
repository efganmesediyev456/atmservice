<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankNoteLog extends Model
{
    use HasFactory;

    public $guarded=[];

    public const STATUS_SUCCESS = 1;
    public const STATUS_FAILED = 0;
}
