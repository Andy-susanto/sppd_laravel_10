<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataPerdin extends Model
{
    use HasFactory, Sluggable, SoftDeletes;

    protected $guarded = ['id'];
    protected $with = ['author', 'tanda_tangan', 'alat_angkut', 'jenis_perdin', 'kedudukan', 'tujuan', 'pegawai_diperintah', 'pegawai_mengikuti'];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function tanda_tangan(): BelongsTo
    {
        return $this->belongsTo(TandaTangan::class, 'tanda_tangan_id');
    }

    public function alat_angkut(): BelongsTo
    {
        return $this->belongsTo(AlatAngkut::class, 'alat_angkut_id');
    }

    public function jenis_perdin(): BelongsTo
    {
        return $this->belongsTo(JenisPerdin::class, 'jenis_perdin_id');
    }

    public function kedudukan(): BelongsTo
    {
        return $this->belongsTo(KotaKabupaten::class, 'kedudukan_id');
    }

    public function tujuan(): BelongsTo
    {
        return $this->belongsTo(KotaKabupaten::class, 'tujuan_id');
    }

    public function pegawai_diperintah(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_diperintah_id');
    }

    public function pegawai_mengikuti(): BelongsToMany
    {
        return $this->belongsToMany(Pegawai::class, 'perdin_pegawai', 'data_perdin_id', 'pegawai_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'perihal'
            ]
        ];
    }
}
