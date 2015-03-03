<?php  namespace App\APP;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model {
    public function fillWhitelist(array $attributes, array $fillable)
    {
        return parent::fill(array_intersect_key($attributes, array_flip($fillable)));
    }

    public function fillBlacklist(array $attributes, array $guarded)
    {
        return parent::fill(array_diff_key($attributes, $guarded));
    }
}