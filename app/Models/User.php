<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'password',
        'ktp',
        'phone_number',
        'is_admin',
        'provinsi_id',
        'kabupaten_id',
        'kecamatan_id',
        'kelurahan_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function pusat()
    {
        return $this->belongsTo(Pusat::class);
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'provinsi_id');
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'kabupaten_id');
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'kelurahan_id');
    }

    const ROLE_REGULAR = 0;
    const ROLE_PUSAT_ADMIN = 1;
    const ROLE_ADMIN_PROVINSI = 2;
    const ROLE_ADMIN_KABUPATEN = 3;
    const ROLE_ADMIN_KECAMATAN = 4;
    const ROLE_ADMIN_KELURAHAN = 5;

    public function isPusatAdmin()
    {
        return $this->is_admin === self::ROLE_PUSAT_ADMIN;
    }

    public function isAdminProvinsi()
    {
        return $this->is_admin === self::ROLE_ADMIN_PROVINSI;
    }

    public function isAdminKabupaten()
    {
        return $this->is_admin === self::ROLE_ADMIN_KABUPATEN;
    }

    public function isAdminKecamatan()
    {
        return $this->is_admin === self::ROLE_ADMIN_KECAMATAN;
    }

    public function isAdminKelurahan()
    {
        return $this->is_admin === self::ROLE_ADMIN_KELURAHAN;
    }

}
