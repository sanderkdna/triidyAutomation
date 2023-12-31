<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlowMessages extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'flow_messages';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'userid',
                  'flowid',
                  'message',
                  'node_parent',
                  'node_answer',
                  'end_pointid'
              ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
    


    /**
     * Get updated_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getUpdatedAtAttribute($value)
    {
        return \DateTime::createFromFormat($this->getDateFormat(), $value)->format('j/n/Y g:i A');
    }

}
