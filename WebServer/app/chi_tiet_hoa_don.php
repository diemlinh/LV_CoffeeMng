<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ma_cthd
 * @property int $ma_hoa_don
 * @property int $ma_thuc_uong
 * @property int $so_luong
 * @property float $don_gia
 * @property float $thanh_tien
 * @property string $trang_thai
 */
class chi_tiet_hoa_don extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'chi_tiet_hoa_don';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ma_cthd';

    /**
     * @var array
     */
    protected $fillable = ['ma_hoa_don', 'ma_sp', 'so_luong', 'don_gia', 'thanh_tien', 'trang_thai', 'pha_che', 'ngay_lap', 'ngay_sua'];
    const CREATED_AT = 'ngay_lap';
    const UPDATED_AT = 'ngay_sua';
    public function san_pham(){
    	return $this->belongsTo('App\san_pham', 'ma_sp', 'ma_cthd');
    }
     public function hoa_don(){
    	return $this->belongsTo('App\hoa_don', 'ma_hoa_don', 'ma_cthd');
    }
}
