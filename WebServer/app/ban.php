<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ma_ban
 * @property string $trang_thai
 */
class ban extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'ban';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ma_ban';

    /**
     * @var array
     */
    protected $fillable = ['trang_thai'];
    public $timestamps = false;
}
