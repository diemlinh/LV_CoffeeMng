<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ma_sp
 * @property string $ten_sp
 * @property int $ma_loai
 * @property float $don_gia
 * @property string $status
 * @property string $hinh_anh
 */
class san_pham extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'san_pham';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ma_sp';

    /**
     * @var array
     */
    protected $fillable = ['ten_sp', 'ma_loai', 'don_gia', 'trang_thai', 'hinh_anh'];
    public $timestamps = false;
    public function chi_tiet_hoa_don(){
    	return $this->hasMany('App\Cchi_tiet_hoa_don', 'ma_sp', 'ma_sp'); 
    }
}
