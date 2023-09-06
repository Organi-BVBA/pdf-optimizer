<?php

namespace App\Models;

use App\Constants\Status;
use Laravel\Scout\Searchable;
use Organi\Helpers\Formatters\Bytes;
use Illuminate\Database\Eloquent\Model;
use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $user_id
 */
class Webhook extends Model
{
    use HasFactory;
    use GeneratesUuid;
    use Searchable;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'uuid' => EfficientUuid::class,
        'wait' => 'bool',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'user_id',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url', 'webhook', 'wait',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getOptimizedUrlAttribute(): string
    {
        return asset($this->optimized_filename);
    }

    public function getOptimizedFilenameAttribute(): string
    {
        return 'optimized/' . $this->filename;
    }

    public function getUploadFilenameAttribute(): string
    {
        return 'upload/' . $this->filename;
    }

    public function getFilenameAttribute(): string
    {
        $uuid = $this->uuid ?? '';

        if ($this->format) {
            return implode('.', [$uuid, $this->format]);
        }

        return implode('.', [$uuid, $this->ext]);
    }

    public function getResponseColorAttribute(): string
    {
        if ($this->response >= 200 && $this->response < 300) {
            return 'green';
        }

        if ($this->response >= 300) {
            return 'red';
        }

        return 'yellow';
    }

    public function getGammaAttribute(int $value): float
    {
        return round($value / 100, 2);
    }

    public function getStatusDescriptionAttribute(): string
    {
        return Status::description($this->status);
    }

    public function getStatusColorAttribute(): string
    {
        return Status::color($this->status);
    }

    public function getSavedAttribute(): int
    {
        return $this->original_size - $this->optimized_size;
    }

    public function getOriginalSizeReadableAttribute(): string
    {
        return Bytes::formatBinary($this->original_size ?? 0);
    }

    public function getOptimizedSizeReadableAttribute(): string
    {
        return Bytes::formatBinary($this->optimized_size ?? 0);
    }

    public function getSavedReadableAttribute(): string
    {
        return Bytes::formatBinary($this->saved ?? 0);
    }

    public function getSavedPercentageAttribute(): int
    {
        if (! $this->original_size > 0) {
            return 0;
        }

        return (int) ($this->saved / $this->original_size * 100);
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

        $array['id']      = $this->id;
        $array['user_id'] = $this->user_id;

        return $array;
    }
}
