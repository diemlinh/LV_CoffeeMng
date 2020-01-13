<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ma_gy
 * @property string $tieu_de
 * @property string $email_gy
 * @property string $noi_dung
 */
class gop_y extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'gop_y';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ma_gy';

    /**
     * @var array
     */
    protected $fillable = ['tieu_de', 'email_gy', 'noi_dung'];
    const CREATED_AT = 'ngay_tao';
    const UPDATED_AT = 'ngay_sua';
}
