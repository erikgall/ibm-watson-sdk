<?php

namespace EGALL\Watson\Entities;

use Illuminate\Support\Arr;

/**
 * Audio resource entity.
 *
 * @author Erik Galloway <egalloway@claruscare.com>
 */
class AudioResource extends Entity
{
    /**
     * Constant representing an archive (zip or gzip) that contains audio files.
     */
    public const ARCHIVE = 'archive';

    /**
     * Constant representing an individual audio file type.
     */
    public const AUDIO_FILE = 'audio';

    /**
     * Constant representing GZIP compression type.
     */
    public const GZIP_COMPRESSION = 'gzip';

    /**
     * Constant representing an invalid audio resource status.
     */
    public const INVALID = 'invalid';

    /**
     * Constant representing an OK audio resource status.
     */
    public const OK = 'ok';

    /**
     * Constant representing a being processed audio resource status.
     */
    public const PROCESSING = 'being_processed';

    /**
     * Constant representing an undetermined audio file type (error).
     */
    public const UNDETERMINED = 'undetermined';

    /**
     * Constant representing ZIP compression type.
     */
    public const ZIP_COMPRESSION = 'zip';

    /**
     * The entity's attributes.
     *
     * @var array
     */
    protected $attributes = [
        'details' => [],
    ];

    /**
     * The attributes that should be filled during hydration.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'duration', 'details', 'status',
    ];

    /**
     * Get the codec attribute from the details array.
     *
     * @return string|null
     */
    public function getCodecAttribute()
    {
        return Arr::get($this->details, 'codec');
    }

    /**
     * Get the compression attribute from the details array.
     *
     * @return string|null
     */
    public function getCompressionAttribute()
    {
        return Arr::get($this->details, 'compression');
    }

    /**
     * Get the frequency attribute from the details array.
     *
     * @return string|null
     */
    public function getFrequencyAttribute()
    {
        return Arr::get($this->details, 'frequency');
    }

    /**
     * Get the type attribute from the details array.
     *
     * @return string|null
     */
    public function getTypeAttribute()
    {
        return Arr::get($this->details, 'type');
    }

    /**
     * Determine if the audio resource is an archive of audio files.
     *
     * @return bool
     */
    public function isArchive(): bool
    {
        return $this->type === static::ARCHIVE;
    }

    /**
     * Determine if the audio resource archive uses Gzip compression.
     *
     * @return bool
     */
    public function isGzipArchive(): bool
    {
        return $this->compression === static::GZIP_COMPRESSION;
    }

    /**
     * Determine if the audio resource is invalid.
     *
     * @return bool
     */
    public function isInvalid(): bool
    {
        return $this->status === static::INVALID;
    }

    /**
     * Determine if the audio resource status is "ok".
     *
     * @return bool
     */
    public function isOk(): bool
    {
        return $this->status === static::OK;
    }

    /**
     * Determine if the audio resource is still processing.
     *
     * @return bool
     */
    public function isProcessing(): bool
    {
        return $this->status === static::PROCESSING;
    }

    /**
     * Determine if the audio resource is a single audio file type.
     *
     * @return bool
     */
    public function isSingleAudioFile(): bool
    {
        return $this->type === static::AUDIO_FILE;
    }

    /**
     * Determine if the audio resource is an undetermined type.
     *
     * @return bool
     */
    public function isUndeterminedType(): bool
    {
        return $this->type === static::UNDETERMINED;
    }

    /**
     * Determine if the audio resource archive uses ZIP compression.
     *
     * @return bool
     */
    public function isZipArchive(): bool
    {
        return $this->compression === static::ZIP_COMPRESSION;
    }
}
