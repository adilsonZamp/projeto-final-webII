<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

#[Fillable(['name', 'email', 'password', 'id_perfil', 'id_responsavel'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements AuditableContract
{
    use Auditable;
    use AuditableTrait;
    protected $auditExclude = ['password', 'remember_token'];
    protected $auditThreshold = 50;

    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function homeRoute()
    {
        return match($this->id_perfil) {
            0 => 'admin/dashboard',
            1 => 'dono/home',
            2 => 'gerente/home',
            3 => 'funcionario/home',
        };
    }

    public function responsavel() {
        return $this->belongsTo(User::class, 'id_responsavel');
    }

    public function perfil() {
        return $this->belongsTo(Perfil::class, 'id_perfil');
    }

    // public function empresa() {
    //     return $this->hasMany(Empresa::class);
    // }

    public function lojas() {
        return $this->belongsToMany(Loja::class);
    }
}
