<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ma_nguyen_lieu
 * @property string $ten_nguyen_lieu
 * @property int $so_luong
 * @property float $don_gia
 * @property string $dvt
 */
class nguyen_lieu extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'nguyen_lieu';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ma_nguyen_lieu';

    /**
     * @var array
     */
    protected $fillable = ['ten_nguyen_lieu', 'so_luong', 'don_gia', 'dvt'];
     public $timestamps = false;
}
