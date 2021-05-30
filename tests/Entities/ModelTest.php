<?php

namespace EGALL\Watson\Tests\Entities;

use PHPUnit\Framework\TestCase;
use EGALL\Watson\Entities\Model;

class ModelTest extends TestCase
{
    /** @test */
    public function it_fills_the_model_from_the_given_array(): void
    {
        $model = new Model($data = $this->getModelData());

        $this->assertEquals($data, $model->toArray());
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
