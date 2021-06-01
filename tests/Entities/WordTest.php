<?php

use EGALL\Watson\Entities\Word;
use PHPUnit\Framework\TestCase;

class WordTest extends TestCase
{
    /**
     * The data used to create the model.
     *
     * @var array
     */
    protected $data;

    /**
     * The Word entity instance to test.
     *
     * @var \EGALL\Watson\Entities\Word
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

        $this->word = new Word($this->data = $this->getWordData());
    }

    /** @test */
    public function it_defaults_the_sounds_like_attribute_to_an_array(): void
    {
        $this->assertIsArray((new Word())->sounds_like);
    }

    /** @test */
    public function it_defaults_the_source_attribute_to_an_array(): void
    {
        $this->assertIsArray((new Word())->source);
    }

    /** @test */
    public function it_has_a_count_attribute(): void
    {
        $this->assertEquals($this->data['count'], $this->word->count);
    }

    /** @test */
    public function it_has_a_display_as_attribute(): void
    {
        $this->assertEquals($this->data['display_as'], $this->word->display_as);
    }

    /** @test */
    public function it_has_a_sounds_like_attribute(): void
    {
        $this->assertEquals($this->data['sounds_like'], $this->word->sounds_like);
    }

    /** @test */
    public function it_has_a_source_attribute(): void
    {
        $this->assertEquals($this->data['source'], $this->word->source);
    }

    /** @test */
    public function it_has_a_word_attribute(): void
    {
        $this->assertEquals($this->data['word'], $this->word->word);
    }

    /**
     * Get the word' data that would be received from Watson API.
     *
     * @return array
     */
    protected function getWordData()
    {
        return [
            'word'        => 'NCAA',
            'sounds_like' => [
                'N. C. A. A.',
                'N. C. double A.',
            ],
            'display_as' => 'NCAA',
            'count'      => 3,
            'source'     => [
                'word3',
                'user',
            ],
        ];
    }
}
