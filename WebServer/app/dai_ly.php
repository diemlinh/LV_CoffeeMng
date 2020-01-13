<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ma_dai_ly
 * @property string $ten_dai_ly
 * @property int $so_dien_thoai
 * @property string $dia_chi
 * @property string $tinh
 */
class dai_ly extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'dai_ly';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ma_dai_ly';

    /**
     * @var array
     */
    protected $fillable = ['ten_dai_ly', 'so_dien_thoai', 'dia_chi', 'tinh'];
    public $timestamps = false;
}
