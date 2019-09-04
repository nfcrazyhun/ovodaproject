<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $student_id
 * @property string $street_name
 * @property string $street_number
 * @property int $zip
 * @property string $created_at
 * @property string $updated_at
 * @property Student $student
 */
class Address extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'address';

    /**
     * @var array
     */
    //protected $guarded = [];
    protected $fillable = ['student_id','street_name','street_number','zip','city','siblings_num'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student()
    {
        return $this->belongsTo('App\Student');
    }
}
