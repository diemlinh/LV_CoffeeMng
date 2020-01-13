<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ma_hoa_don
 * @property int $ma_ban
 * @property string $ten_dang_nhap
 * @property string $ngay_gio_lap
 * @property string $trang_thai
 * @property int $so_luong
 * @property int $ma_kh
 * @property float $tong_tien
 */
class hoa_don extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'hoa_don';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ma_hoa_don';

    /**
     * @var array
     */
    protected $fillable = ['ma_ban', 'ten_dang_nhap', 'ngay_lap', 'trang_thai', 'tong_tien', 'ngay_sua'];
    const CREATED_AT = 'ngay_lap';
    const UPDATED_AT = 'ngay_sua';
    public function chi_tiet_hoa_don(){
    	return $this->hasMany('App\chi_tiet_hoa_don', 'ma_hoa_don', 'ma_hoa_don'); 
    }
}
