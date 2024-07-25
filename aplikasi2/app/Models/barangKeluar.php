<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class barangKeluar extends Model
{
    use HasFactory;
    
    /**
     * Get the getUser that owns the barangKeluar
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the getPelanggan that owns the barangKeluar
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getPelanggan(): BelongsTo
    {
        return $this->belongsTo(pelanggan::class, 'pelanggan_id', 'id');
    }

    /**
     * Get the getStok that owns the barangKeluar
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getStok(): BelongsTo
    {
        return $this->belongsTo(stok::class, 'barang_id', 'id');
    }


}
