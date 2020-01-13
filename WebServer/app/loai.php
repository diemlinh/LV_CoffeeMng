<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ma_loai
 * @property string $ten_loai
 */
class loai extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'loai';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ma_loai';

    /**
     * @var array
     */
    protected $fillable = ['ten_loai'];
    public $timestamps = false;

}
