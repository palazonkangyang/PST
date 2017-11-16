<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shengzhupai extends Model
{
    protected $table = 'shengzhupai';

    protected $primaryKey = "id";

    protected $fillable = [
        'name',
        'type',
        'entermastertype',
         'done',
        'total',
        'association_dd',
        'total_gst',
        'total_aftergst',
        'total_afterdiscount',
        'created_at',
        'updated_at',
        'focusdevotee_id',
         'slot_id',
         'otheroption_text'
    ];
}
