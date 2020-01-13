<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ma_cttu
 * @property int $ma_nguyen_lieu
 * @property int $ma_thuc_uong
 * @property int $so_luong
 * @property string $dvt
 */
class cong_thuc extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'cong_thuc';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ma_ct';

    /**
     * @var array
     */
    protected $fillable = ['ma_nguyen_lieu', 'ma_sp', 'so_luong', 'dvt'];
    public $timestamps = false;

}
