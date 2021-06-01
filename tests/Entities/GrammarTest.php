<?php

use PHPUnit\Framework\TestCase;
use EGALL\Watson\Entities\Grammar;

class GrammarTest extends TestCase
{
    /**
     * The data used to create the entity.
     *
     * @var array
     */
    protected $data;

    /**
     * The Grammar entity instance to test.
     *
     * @var \EGALL\Watson\Entities\Grammar
     */
    protected $grammar;

    /**
     * Set up the testing environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->grammar = new Grammar(
            $this->data = $this->getGrammarData()
        );
    }

    /** @test */
    public function it_checks_if_processing_the_grammar_failed_due_to_an_error(): void
    {
        $this->grammar->status = Grammar::ANALYZED;
        $this->assertFalse($this->grammar->failed());

        $this->grammar->status = Grammar::UNDETERMINED;
        $this->assertTrue($this->grammar->failed());

        $this->grammar->status = Grammar::PROCESSING;
        $this->assertFalse($this->grammar->failed());
    }

    /** @test */
    public function it_checks_if_the_grammar_has_been_ingested_regardless_of_receiving_an_error(): void
    {
        $this->grammar->status = Grammar::ANALYZED;
        $this->assertTrue($this->grammar->isComplete());

        $this->grammar->status = Grammar::PROCESSING;
        $this->assertFalse($this->grammar->isComplete());

        $this->grammar->status = Grammar::UNDETERMINED;
        $this->assertTrue($this->grammar->isComplete());
    }

    /** @test */
    public function it_checks_if_the_grammar_has_been_processed_and_is_ready(): void
    {
        $this->grammar->status = Grammar::PROCESSING;
        $this->assertFalse($this->grammar->isReady());

        $this->grammar->status = Grammar::ANALYZED;
        $this->assertTrue($this->grammar->isReady());

        $this->grammar->status = Grammar::UNDETERMINED;
        $this->assertFalse($this->grammar->isReady());
    }

    /** @test */
    public function it_checks_if_the_grammar_is_currently_being_processed(): void
    {
        $this->grammar->status = Grammar::ANALYZED;
        $this->assertFalse($this->grammar->isProcessing());

        $this->grammar->status = Grammar::PROCESSING;
        $this->assertTrue($this->grammar->isProcessing());

        $this->grammar->status = Grammar::UNDETERMINED;
        $this->assertFalse($this->grammar->isProcessing());
    }

    /** @test */
    public function it_has_a_name_attribute(): void
    {
        $this->assertEquals($this->data['name'], $this->grammar->name);
    }

    /** @test */
    public function it_has_a_status_attribute(): void
    {
        $this->assertEquals($this->data['status'], $this->grammar->status);
    }

    /** @test */
    public function it_has_an_out_of_vocabulary_words_attribute(): void
    {
        $this->assertEquals(
            $this->data['out_of_vocabulary_words'],
            $this->grammar->out_of_vocabulary_words
        );
    }

    /**
     * Get the grammar's data that would be received from Watson API.
     *
     * @return array
     */
    protected function getGrammarData()
    {
        return [
            'name'                    => 'confirm-xml',
            'out_of_vocabulary_words' => 8,
            'status'                  => 'analyzed',
        ];
    }
}
