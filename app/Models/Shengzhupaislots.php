<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shengzhupaislots extends Model
{
    protected $table = 'shengzhupaislots';

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
        
    ];
}
