<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ma_bv
 * @property string $ten_bv
 * @property string $noi_dung
 * @property string $hinh_bv
 * @property string $email
 */
class bai_viet extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'bai_viet';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ma_bv';

    /**
     * @var array
     */
    protected $fillable = ['ten_bv', 'noi_dung', 'hinh_bv', 'email'];
    const CREATED_AT = 'ngay_tao';
    const UPDATED_AT = 'ngay_sua';
}