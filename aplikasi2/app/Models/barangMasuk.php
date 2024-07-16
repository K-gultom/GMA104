<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class barangMasuk extends Model
{
    use HasFactory;

    /**
     * Get the getStok that owns the barangMasuk
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getStok(): BelongsTo
    {
        return $this->belongsTo(stok::class, 'nama_barang_id', 'id');
    }

    /**
     * Get the getSuplier that owns the barangMasuk
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getSuplier(): BelongsTo
    {
        return $this->belongsTo(suplier::class, 'suplier_id', 'id');
    }

    /**
     * Get the getAdmin that owns the barangMasuk
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getAdmin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id', 'id');
    }
}
