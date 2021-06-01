<?php

use PHPUnit\Framework\TestCase;
use EGALL\Watson\Entities\AudioResource;

class AudioResourceTest extends TestCase
{
    /**
     * The data used to create the entity.
     *
     * @var array
     */
    protected $data;

    /**
     * The AudioResource entity instance to test.
     *
     * @var \EGALL\Watson\Entities\AudioResource
     */
    protected $resource;

    /**
     * Set up the testing environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->resource = new AudioResource($this->data = $this->getAudioResourceData());
    }

    /** @test */
    public function it_allows_the_codec_detail_to_be_retrieved_as_an_attribute(): void
    {
        $this->assertEquals($this->data['details']['codec'], $this->resource->codec);
    }

    /** @test */
    public function it_allows_the_compression_detail_to_be_retrieved_as_an_attribute(): void
    {
        $this->resource->details = ['compression' => AudioResource::ZIP_COMPRESSION];

        $this->assertEquals(AudioResource::ZIP_COMPRESSION, $this->resource->compression);
    }

    /** @test */
    public function it_allows_the_frequency_detail_to_be_retrieved_as_an_attribute(): void
    {
        $this->assertEquals($this->data['details']['frequency'], $this->resource->frequency);
    }

    /** @test */
    public function it_allows_the_type_detail_to_be_retrieved_as_an_attribute(): void
    {
        $this->assertEquals($this->data['details']['type'], $this->resource->type);
    }

    /** @test */
    public function it_checks_if_the_audio_resource_archive_uses_gzip_compression(): void
    {
        $this->assertFalse($this->resource->isGzipArchive());

        $this->resource->details = ['compression' => AudioResource::GZIP_COMPRESSION];

        $this->assertTrue($this->resource->isGzipArchive());
    }

    /** @test */
    public function it_checks_if_the_audio_resource_archive_uses_zip_compression(): void
    {
        $this->assertFalse($this->resource->isZipArchive());

        $this->resource->details = ['compression' => AudioResource::ZIP_COMPRESSION];

        $this->assertTrue($this->resource->isZipArchive());
    }

    /** @test */
    public function it_checks_if_the_audio_resource_is_an_archive_of_audio_files(): void
    {
        $this->assertFalse($this->resource->isArchive());

        $this->resource->details = ['type' => AudioResource::ARCHIVE];

        $this->assertTrue($this->resource->isArchive());
    }

    /** @test */
    public function it_checks_if_the_audio_resource_is_an_individual_audio_file(): void
    {
        $this->resource->details = ['type' => AudioResource::ARCHIVE];

        $this->assertFalse($this->resource->isSingleAudioFile());

        $this->resource->details = ['type' => AudioResource::AUDIO_FILE];

        $this->assertTrue($this->resource->isSingleAudioFile());
    }

    /** @test */
    public function it_checks_if_the_audio_resource_is_an_undetermined_type(): void
    {
        $this->assertFalse($this->resource->isUndeterminedType());

        $this->resource->details = ['type' => AudioResource::UNDETERMINED];

        $this->assertTrue($this->resource->isUndeterminedType());
    }

    /** @test */
    public function it_checks_if_the_audio_resource_is_being_processed_is_invalid(): void
    {
        $this->resource->status = AudioResource::OK;
        $this->assertFalse($this->resource->isProcessing());

        $this->resource->status = AudioResource::PROCESSING;
        $this->assertTrue($this->resource->isProcessing());
    }

    /** @test */
    public function it_checks_if_the_audio_resource_is_invalid(): void
    {
        $this->resource->status = AudioResource::OK;
        $this->assertFalse($this->resource->isInvalid());

        $this->resource->status = AudioResource::INVALID;
        $this->assertTrue($this->resource->isInvalid());
    }

    /** @test */
    public function it_checks_if_the_audio_resource_status_is_ok(): void
    {
        $this->resource->status = AudioResource::INVALID;
        $this->assertFalse($this->resource->isOk());

        $this->resource->status = AudioResource::OK;
        $this->assertTrue($this->resource->isOk());
    }

    /** @test */
    public function it_defaults_the_details_attribute_to_an_array(): void
    {
        $this->assertIsArray((new AudioResource())->details);
    }

    /** @test */
    public function it_has_a_details_attribute(): void
    {
        $this->assertEquals($this->data['details'], $this->resource->details);
    }

    /** @test */
    public function it_has_a_duration_attribute(): void
    {
        $this->assertEquals($this->data['duration'], $this->resource->duration);
    }

    /** @test */
    public function it_has_a_name_attribute(): void
    {
        $this->assertEquals($this->data['name'], $this->resource->name);
    }

    /** @test */
    public function it_has_a_status_attribute(): void
    {
        $this->assertEquals($this->data['status'], $this->resource->status);
    }

    /**
     * Get the resource data that would be received from Watson API.
     *
     * @return array
     */
    protected function getAudioResourceData()
    {
        return [
            'duration' => 112,
            'name'     => 'audio-file3.wav',
            'details'  => [
                'codec'     => 'pcm_s16le',
                'type'      => 'audio',
                'frequency' => 16000,
            ],
            'status' => 'ok',
        ];
    }
}
