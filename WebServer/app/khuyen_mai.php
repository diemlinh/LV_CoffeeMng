<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ma_khuyen_mai
 * @property string $ten_khuyen_mai
 */
class khuyen_mai extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'khuyen_mai';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ma_khuyen_mai';

    /**
     * @var array
     */
    protected $fillable = ['ten_khuyen_mai'];
    const CREATED_AT = 'ngay_tao';
    const UPDATED_AT = 'ngay_sua';
}
