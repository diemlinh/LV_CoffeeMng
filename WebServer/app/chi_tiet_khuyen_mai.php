<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ma_ctkm
 * @property int $ma_khuyen_mai
 * @property int $ma_thuc_uong
 * @property string $kieu_khuyen_mai
 * @property float $gia_tri_KM
 * @property float $gia_khuyen_mai
 * @property string $ngay_bat_dau
 * @property string $ngay_ket_thuc
 */
class chi_tiet_khuyen_mai extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'chi_tiet_khuyen_mai';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ma_ctkm';

    /**
     * @var array
     */
    protected $fillable = ['ma_khuyen_mai', 'ma_sp', 'kieu_khuyen_mai', 'gia_tri_KM', 'gia_khuyen_mai', 'ngay_bat_dau', 'ngay_ket_thuc'];
    public $timestamps = false;
}
