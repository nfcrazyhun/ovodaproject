<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $sign
 * @property string $group
 * @property int $age
 * @property string $created_at
 * @property string $updated_at
 * @property Address[] $addresses
 */
class Student extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'student';

    /**
     * @var array
     */
    //protected $guarded = [];
    protected $fillable = ['first_name','last_name','sign','group','age'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function address()
    {
        return $this->hasMany('App\Address');
    }
}
