<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ma_phieu
 * @property int $ma_dai_ly
 * @property int $ma_nguyen_lieu
 * @property int $so_luong_nhap
 * @property float $gia_nhap
 * @property string $ngay_nhap
 * @property string $dvt
 */
class phieu_nhap extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'phieu_nhap';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ma_phieu';

    /**
     * @var array
     */
    protected $fillable = ['ma_dai_ly', 'ma_nguyen_lieu', 'so_luong_nhap', 'gia_nhap', 'ngay_nhap', 'dvt'];
    const CREATED_AT = 'ngay_nhap';
    const UPDATED_AT = null;

}
