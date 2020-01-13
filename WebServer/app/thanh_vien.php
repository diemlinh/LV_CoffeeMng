<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property int $ma_tv
 * @property string $ten_dang_nhap
 * @property string $mat_khau
 * @property string $ho_ten
 * @property string $email
 * @property string $gioi_tinh
 * @property string $sinh_nhat
 * @property string $dia_chi
 * @property string $quyen
 * @property int $so_dt
 * @property string $trang_thai
 * @property string $tinh
 * @property string $ngay_tao
 * @property string $ngay_sua
 */
class thanh_vien extends Authenticatable
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'thanh_vien';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ma_tv';

    /**
     * @var array
     */
    protected $fillable = ['ten_dang_nhap', 'mat_khau', 'ho_ten', 'email', 'gioi_tinh', 'sinh_nhat', 'dia_chi', 'quyen', 'so_dt', 'trang_thai', 'tinh', 'ngay_tao', 'ngay_sua','remember_token'];
    
    /**
     * get Password
     */
    public function getAuthPassword(){
        return $this->mat_khau;
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'mat_khau', 'remember_token',
    ];
    // /**
    //  * Set giá trị timetamp false để loại bỏ updated_at, created_at
    //  */
    // public $timestamps = false;
    const CREATED_AT = 'ngay_tao';
    const UPDATED_AT = 'ngay_sua';

    public function hasDefinePrivilege($quyen){
        if (!$quyen) {
            return false;
        }
        return $this->quyen ==  $quyen;
    }
}
