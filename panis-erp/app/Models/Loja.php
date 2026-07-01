<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

#[Fillable(['nome', 'id_dono'])]
class Loja extends Model implements AuditableContract
{
    use Auditable;
    use AuditableTrait;

    protected $table = 'loja';

    // public function empresa() {
    //     return $this->belongsTo(User::class, 'id_dono');
    // }
    public function dono() {
        return $this->belongsTo(User::class, 'id_dono');
    }

    public function empregados() {
        return $this->belongsTo(User::class);
    }

    public function vendas()
    {
        return $this->hasMany(Venda::class);
    }
}
