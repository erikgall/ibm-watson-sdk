<?php

namespace EGALL\Watson\Tests\Entities;

use Illuminate\Support\Carbon;
use PHPUnit\Framework\TestCase;
use Carbon\Carbon as BaseCarbon;
use EGALL\Watson\Entities\AcousticModel;

class AcousticModelTest extends TestCase
{
    /**
     * The data used to create the model.
     *
     * @var array
     */
    protected $data;

    /**
     * The AcousticModel entity instance to test.
     *
     * @var \EGALL\Watson\Entities\AcousticModel
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

        $this->model = new AcousticModel($this->data = $this->getModelData());
    }

    /** @test */
    public function it_casts_the_created_attribute_to_an_array(): void
    {
        $this->assertInstanceOf(BaseCarbon::class, $this->model->created);
    }

    /** @test */
    public function it_casts_the_updated_attribute_to_an_array(): void
    {
        $this->assertInstanceOf(BaseCarbon::class, $this->model->updated);
    }

    /** @test */
    public function it_checks_if_the_model_is_available_without_any_issues(): void
    {
        $this->model->status = AcousticModel::FAILED;
        $this->assertFalse($this->model->isAvailable());

        $this->model->status = AcousticModel::AVAILABLE;
        $this->assertTrue($this->model->isAvailable());
    }

    /** @test */
    public function it_checks_if_the_model_is_currently_being_trained(): void
    {
        $this->model->status = AcousticModel::FAILED;
        $this->assertFalse($this->model->isTraining());

        $this->model->status = AcousticModel::TRAINING;
        $this->assertTrue($this->model->isTraining());
    }

    /** @test */
    public function it_checks_if_the_model_is_currently_being_upgraded(): void
    {
        $this->model->status = AcousticModel::FAILED;
        $this->assertFalse($this->model->isUpgrading());

        $this->model->status = AcousticModel::UPGRADING;
        $this->assertTrue($this->model->isUpgrading());
    }

    /** @test */
    public function it_checks_if_the_model_is_pending(): void
    {
        $this->model->status = AcousticModel::FAILED;
        $this->assertFalse($this->model->isPending());

        $this->model->status = AcousticModel::PENDING;
        $this->assertTrue($this->model->isPending());
    }

    /** @test */
    public function it_checks_if_the_model_is_ready_to_be_used(): void
    {
        $this->model->status = AcousticModel::FAILED;
        $this->assertFalse($this->model->isReady());

        $this->model->status = AcousticModel::READY;
        $this->assertTrue($this->model->isReady());
    }

    /** @test */
    public function it_checks_if_the_model_training_has_failed(): void
    {
        $this->model->status = AcousticModel::UPGRADING;
        $this->assertFalse($this->model->failed());

        $this->model->status = AcousticModel::FAILED;
        $this->assertTrue($this->model->failed());
    }

    /** @test */
    public function it_defaults_the_versions_attribute_to_an_array(): void
    {
        $this->assertEquals([], (new AcousticModel())->versions);
    }

    /** @test */
    public function it_defaults_the_versions_attribute_to_an_empty_array(): void
    {
        $this->assertEquals([], (new AcousticModel())->versions);
    }

    /** @test */
    public function it_fills_the_model_from_the_given_array(): void
    {
        $this->data['created'] = Carbon::parse($this->data['created'])->toJSON();
        $this->data['updated'] = Carbon::parse($this->data['updated'])->toJSON();

        $this->assertEquals($this->data, $this->model->toArray());
    }

    /** @test */
    public function it_has_a_base_model_name_attribute(): void
    {
        $this->assertEquals($this->data['base_model_name'], $this->model->base_model_name);
    }

    /** @test */
    public function it_has_a_created_timestamp_attribute(): void
    {
        $this->assertEquals(
            (string) Carbon::parse($this->data['created']),
            (string) $this->model->created
        );
    }

    /** @test */
    public function it_has_a_customization_id_attribute(): void
    {
        $this->assertEquals($this->data['customization_id'], $this->model->customization_id);
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
    public function it_has_a_progress_attribute(): void
    {
        $this->assertEquals($this->data['progress'], $this->model->progress);
    }

    /** @test */
    public function it_has_a_status_attribute(): void
    {
        $this->assertEquals($this->data['status'], $this->model->status);
    }

    /** @test */
    public function it_has_a_versions_attribute(): void
    {
        $this->assertEquals($this->data['versions'], $this->model->versions);
    }

    /** @test */
    public function it_has_an_owner_attribute(): void
    {
        $this->assertEquals($this->data['owner'], $this->model->owner);
    }

    /** @test */
    public function it_has_an_updated_timestamp_attribute(): void
    {
        $this->assertEquals(
            Carbon::parse($this->data['updated'])->format('Y-m-d H:i:s'),
            $this->model->updated->format('Y-m-d H:i:s'),
        );
    }

    /**
     * Get a custom acoustic model's data that would be received from Watson API.
     *
     * @return array
     */
    protected function getModelData()
    {
        return [
            'owner'            => '297cfd08-330a-22ba-93ce-1a73f454dd98',
            'base_model_name'  => 'en-US_BroadbandModel',
            'customization_id' => '74f4807e-b5ff-4866-824e-6bba1a84fe96',
            'versions'         => [
                'en-US_BroadbandModel.v07-06082016.06202016',
                'en-US_BroadbandModel.v2017-11-15',
            ],
            'created'     => '2016-06-01T18:42:25.324Z',
            'updated'     => '2016-06-01T18:42:25.324Z',
            'name'        => 'First example acoustic model',
            'description' => 'First example custom acoustic model',
            'progress'    => 0,
            'language'    => 'en-US',
            'status'      => 'pending',
        ];
    }
}
