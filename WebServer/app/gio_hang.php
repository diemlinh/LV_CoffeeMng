<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class gio_hang extends Model
{
     /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'gio_hang';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ma_gh';

    /**
     * @var array
     */
    protected $fillable = ['ma_ban', 'ma_sp', 'ten_sp', 'so_luong', 'don_gia', 'thanh_tien', 'ghi_chu'];
    public $timestamps = false;
}
