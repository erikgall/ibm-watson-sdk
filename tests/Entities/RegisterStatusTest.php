<?php

use EGALL\Watson\Entities\RegisterStatus;
use PHPUnit\Framework\TestCase;

class RegisterStatusTest extends TestCase
{
    /**
     * The data used to create the entity.
     *
     * @var array
     */
    protected $data;

    /**
     * The RegisterStatus entity instance to test.
     *
     * @var \EGALL\Watson\Entities\RegisterStatus
     */
    protected $word;

    /**
     * Set up the testing environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->word = new RegisterStatus($this->data = $this->getRegisterStatusData());
    }

    /** @test */
    public function it_has_a_status_attribute(): void
    {
        $this->assertEquals($this->data['status'], $this->word->status);
    }

    /** @test */
    public function it_has_a_url_attribute(): void
    {
        $this->assertEquals($this->data['url'], $this->word->url);
    }

    /**
     * Get the word data that would be received from Watson API.
     *
     * @return array
     */
    protected function getRegisterStatusData()
    {
        return [
            'status' => 'already created',
            'url' => 'http://watson-transcription.com/job_results'
        ];
    }
}
