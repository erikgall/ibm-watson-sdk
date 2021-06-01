<?php

namespace EGALL\Watson\Tests\Entities;

use PHPUnit\Framework\TestCase;
use EGALL\Watson\Entities\Model;

class ModelTest extends TestCase
{
    /**
     * The data used to create the model.
     *
     * @var array
     */
    protected $data;

    /**
     * The Model entity instance to test.
     *
     * @var \EGALL\Watson\Entities\Model
     */
    protected $model;

    /**
     * Set up the testing environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new Model($this->data = $this->getModelData());
    }

    /** @test */
    public function it_checks_if_the_model_has_speaker_labels_feature_available(): void
    {
        $this->assertTrue($this->model->speakerLabels());

        $this->model->supported_features = ['low_latency' => false];

        $this->assertFalse($this->model->speakerLabels());
    }

    /** @test */
    public function it_checks_if_the_model_has_the_low_latency_feature_available(): void
    {
        $this->assertTrue($this->model->lowLatency());

        $this->model->supported_features = ['low_latency' => false];

        $this->assertFalse($this->model->lowLatency());
    }

    /** @test */
    public function it_checks_if_the_model_supports_customization(): void
    {
        $this->assertFalse($this->model->customizable());

        $this->model->supported_features = ['custom_language_model' => true];

        $this->assertTrue($this->model->customizable());
    }

    /** @test */
    public function it_defaults_the_supported_features_to_an_array(): void
    {
        $this->assertEquals([], (new Model())->supported_features);
    }

    /** @test */
    public function it_determines_if_the_model_is_a_next_gen_model(): void
    {
        $this->assertTrue($this->model->isNextGen());

        $this->model->name = 'en-US_NarrowbandModel';

        $this->assertFalse($this->model->isNextGen());
    }

    /** @test */
    public function it_fills_the_model_from_the_given_array(): void
    {
        $this->assertEquals($this->data, $this->model->toArray());
    }

    /** @test */
    public function it_has_a_description_attribute(): void
    {
        $this->assertEquals($this->data['description'], $this->model->description);
    }

    /** @test */
    public function it_has_a_language_attribute(): void
    {
        $this->assertEquals($this->data['language'], $this->model->language);
    }

    /** @test */
    public function it_has_a_name_attribute(): void
    {
        $this->assertEquals($this->data['name'], $this->model->name);
    }

    /** @test */
    public function it_has_a_sampling_rate_attribute(): void
    {
        $this->assertEquals($this->data['rate'], $this->model->rate);
    }

    /** @test */
    public function it_has_a_supported_featured_attribute(): void
    {
        $this->assertEquals($this->data['supported_features'], $this->model->supported_features);
    }

    /** @test */
    public function it_has_an_url_attribute(): void
    {
        $this->assertEquals($this->data['url'], $this->model->url);
    }

    /**
     * Get a model's data that would be received from Watson API.
     *
     * @return array
     */
    protected function getModelData()
    {
        return [
            'name'               => 'en-US_Telephony',
            'rate'               => 8000,
            'language'           => 'en-US',
            'description'        => 'US English telephony model for narrowband audio (8kHz)',
            'supported_features' => [
                'custom_language_model' => false,
                'low_latency'           => true,
                'speaker_labels'        => true,
            ],
            'url' => 'https://api.us-south.speech-to-text.watson.cloud.ibm.com/instances/ba6e1d1f-381f-4a29-8ed7-47a45f222f15/v1/models/en-US_Telephony',
        ];
    }
}
