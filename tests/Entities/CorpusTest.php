<?php

use PHPUnit\Framework\TestCase;
use EGALL\Watson\Entities\Corpus;

class CorpusTest extends TestCase
{
    /**
     * The Corpus entity instance to test.
     *
     * @var \EGALL\Watson\Entities\Corpus
     */
    protected $corpus;

    /**
     * The data used to create the entity.
     *
     * @var array
     */
    protected $data;

    /**
     * Set up the testing environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->corpus = new Corpus($this->data = $this->getCorpusData());
    }

    /** @test */
    public function it_checks_if_processing_the_corpus_failed_due_to_an_error(): void
    {
        $this->corpus->status = Corpus::ANALYZED;
        $this->assertFalse($this->corpus->failed());

        $this->corpus->status = Corpus::UNDETERMINED;
        $this->assertTrue($this->corpus->failed());

        $this->corpus->status = Corpus::PROCESSING;
        $this->assertFalse($this->corpus->failed());
    }

    /** @test */
    public function it_checks_if_the_corpus_has_been_ingested_regardless_of_receiving_an_error(): void
    {
        $this->corpus->status = Corpus::ANALYZED;
        $this->assertTrue($this->corpus->isComplete());

        $this->corpus->status = Corpus::PROCESSING;
        $this->assertFalse($this->corpus->isComplete());

        $this->corpus->status = Corpus::UNDETERMINED;
        $this->assertTrue($this->corpus->isComplete());
    }

    /** @test */
    public function it_checks_if_the_corpus_has_been_processed_and_is_ready(): void
    {
        $this->corpus->status = Corpus::PROCESSING;
        $this->assertFalse($this->corpus->isReady());

        $this->corpus->status = Corpus::ANALYZED;
        $this->assertTrue($this->corpus->isReady());

        $this->corpus->status = Corpus::UNDETERMINED;
        $this->assertFalse($this->corpus->isReady());
    }

    /** @test */
    public function it_checks_if_the_corpus_is_currently_being_processed(): void
    {
        $this->corpus->status = Corpus::ANALYZED;
        $this->assertFalse($this->corpus->isProcessing());

        $this->corpus->status = Corpus::PROCESSING;
        $this->assertTrue($this->corpus->isProcessing());

        $this->corpus->status = Corpus::UNDETERMINED;
        $this->assertFalse($this->corpus->isProcessing());
    }

    /** @test */
    public function it_has_a_name_attribute(): void
    {
        $this->assertEquals($this->data['name'], $this->corpus->name);
    }

    /** @test */
    public function it_has_a_status_attribute(): void
    {
        $this->assertEquals($this->data['status'], $this->corpus->status);
    }

    /** @test */
    public function it_has_a_total_words_attribute(): void
    {
        $this->assertEquals($this->data['total_words'], $this->corpus->total_words);
    }

    /** @test */
    public function it_has_an_out_of_vocabulary_words_attribute(): void
    {
        $this->assertEquals(
            $this->data['out_of_vocabulary_words'],
            $this->corpus->out_of_vocabulary_words
        );
    }

    /**
     * Get the corpus' data that would be received from Watson API.
     *
     * @return array
     */
    protected function getCorpusData()
    {
        return [
            'name'                    => 'corpus1',
            'out_of_vocabulary_words' => 191,
            'total_words'             => 5037,
            'status'                  => 'analyzed',
        ];
    }
}
