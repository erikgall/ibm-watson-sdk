<?php

namespace EGALL\Watson\Tests\Entities;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use PHPUnit\Framework\TestCase;
use Carbon\Carbon as BaseCarbon;
use EGALL\Watson\Entities\RecognitionJob;

class RecognitionJobTest extends TestCase
{
    /**
     * The data used to create the job.
     *
     * @var array
     */
    protected $data;

    /**
     * The RecognitionJob entity instance to test.
     *
     * @var \EGALL\Watson\Entities\RecognitionJob
     */
    protected $job;

    /**
     * Set up the testing environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->job = new RecognitionJob($this->data = $this->getJobData());
    }

    /** @test */
    public function it_casts_the_created_attribute_to_an_array(): void
    {
        $this->assertInstanceOf(BaseCarbon::class, $this->job->created);
    }

    /** @test */
    public function it_casts_the_updated_attribute_to_an_array(): void
    {
        $this->assertInstanceOf(BaseCarbon::class, $this->job->updated);
    }

    /** @test */
    public function it_checks_if_the_job_is_completed(): void
    {
        $this->job->status = RecognitionJob::FAILED;
        $this->assertFalse($this->job->isComplete());

        $this->job->status = RecognitionJob::COMPLETED;
        $this->assertTrue($this->job->isComplete());
    }

    /** @test */
    public function it_checks_if_the_job_is_currently_processing(): void
    {
        $this->job->status = RecognitionJob::FAILED;
        $this->assertFalse($this->job->isProcessing());

        $this->job->status = RecognitionJob::PROCESSING;
        $this->assertTrue($this->job->isProcessing());
    }

    /** @test */
    public function it_checks_if_the_job_is_pending(): void
    {
        $this->job->status = RecognitionJob::FAILED;
        $this->assertFalse($this->job->isWaiting());

        $this->job->status = RecognitionJob::WAITING;
        $this->assertTrue($this->job->isWaiting());
    }

    /** @test */
    public function it_checks_if_the_job_training_has_failed(): void
    {
        $this->job->status = RecognitionJob::COMPLETED;
        $this->assertFalse($this->job->failed());

        $this->job->status = RecognitionJob::FAILED;
        $this->assertTrue($this->job->failed());
    }

    /** @test */
    public function it_defaults_the_results_attribute_to_an_empty_array(): void
    {
        $this->assertEquals([], (new RecognitionJob())->results);
    }

    /** @test */
    public function it_fills_the_job_from_the_given_array(): void
    {
        $this->data['created'] = Carbon::parse($this->data['created'])->toJSON();
        $this->data['updated'] = Carbon::parse($this->data['updated'])->toJSON();

        $this->assertEquals($this->data, $this->job->toArray());
    }

    /** @test */
    public function it_has_a_created_timestamp_attribute(): void
    {
        $this->assertEquals(
            (string) Carbon::parse($this->data['created']),
            (string) $this->job->created
        );
    }

    /** @test */
    public function it_has_a_results_attribute(): void
    {
        $this->assertEquals($this->data['results'], $this->job->results);
    }

    /** @test */
    public function it_has_a_status_attribute(): void
    {
        $this->assertEquals($this->data['status'], $this->job->status);
    }

    /** @test */
    public function it_has_a_url_attribute(): void
    {
        $this->job->url = 'watson.ibm.com/api/v1/recognition';

        $this->assertEquals('watson.ibm.com/api/v1/recognition', $this->job->url);
    }

    /** @test */
    public function it_has_a_user_token_attribute(): void
    {
        $token = Str::random();

        $this->job->user_token = $token;

        $this->assertEquals($token, $this->job->user_token);
    }

    /** @test */
    public function it_has_an_id_attribute(): void
    {
        $this->assertEquals($this->data['id'], $this->job->id);
    }

    /** @test */
    public function it_has_an_updated_timestamp_attribute(): void
    {
        $this->assertEquals(
            Carbon::parse($this->data['updated'])->format('Y-m-d H:i:s'),
            $this->job->updated->format('Y-m-d H:i:s'),
        );
    }

    /**
     * Get a custom language job's data that would be received from Watson API.
     *
     * @return array
     */
    protected function getJobData()
    {
        return [
            'created' => '2016-08-17T19:11:04.298Z',
            'id'      => '4bd734c0-e575-21f3-de03-f932aa0468a0',
            'updated' => '2016-08-17T19:11:16.003Z',
            'results' => [
                [
                    'result_index' => 0,
                    'results'      => [
                        [
                            'final'        => true,
                            'alternatives' => [
                                [
                                    'transcript' => 'several tornadoes touch down as a line of severe thunderstorms swept through Colorado on Sunday ',
                                    'timestamps' => [
                                        [
                                            'several',
                                            1,
                                            1.52,
                                        ],
                                        [
                                            'tornadoes',
                                            1.52,
                                            2.15,
                                        ],
                                        [
                                            'touch',
                                            2.15,
                                            2.49,
                                        ],
                                        [
                                            'down',
                                            2.49,
                                            2.82,
                                        ],
                                        [
                                            'as',
                                            2.82,
                                            2.92,
                                        ],
                                        [
                                            'a',
                                            2.92,
                                            3.01,
                                        ],
                                        [
                                            'line',
                                            3.01,
                                            3.3,
                                        ],
                                        [
                                            'of',
                                            3.3,
                                            3.39,
                                        ],
                                        [
                                            'severe',
                                            3.39,
                                            3.77,
                                        ],
                                        [
                                            'thunderstorms',
                                            3.77,
                                            4.51,
                                        ],
                                        [
                                            'swept',
                                            4.51,
                                            4.79,
                                        ],
                                        [
                                            'through',
                                            4.79,
                                            4.95,
                                        ],
                                        [
                                            'Colorado',
                                            4.95,
                                            5.59,
                                        ],
                                        [
                                            'on',
                                            5.59,
                                            5.73,
                                        ],
                                        [
                                            'Sunday',
                                            5.73,
                                            6.35,
                                        ],
                                    ],
                                    'confidence' => 0.96,
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'status' => 'completed',
        ];
    }
}
