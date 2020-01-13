<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ ma_kh
 * @property string $ho_ten
 * @property string $gioi_tinh
 * @property int $so_dien_thoai
 * @property string $email
 * @property string $sinh_nhat
 * @property int $diem_tich_luy
 * @property int $so_ly_KM
 * @property string $trang_thai
 * @property string $tinh
 */
class khach_hang extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'khach_hang';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = ' ma_kh';

    /**
     * @var array
     */
    protected $fillable = ['ho_ten', 'gioi_tinh', 'so_dien_thoai', 'email', 'sinh_nhat', 'diem_tich_luy', 'so_ly_KM', 'trang_thai', 'tinh'];
    public $timestamps = false;
}
