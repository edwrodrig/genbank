<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: edwin
 * Date: 14-06-18
 * Time: 11:52
 */

namespace edwrodrig\genbank_reader;


class OriginReader
{
    /**
     * @var StreamReader
     */
    private $stream;

    /**
     * @var string
     */
    private $sequence = '';

    public function __construct(StreamReader $stream) {
        $this->stream = $stream;
        $this->parse();
    }

    public function getSequence() : string {
        return $this->sequence;
    }

    private function parse() {
        $this->stream->readLine();

        while ( ! $this->stream->atEnd() ) {
            $line = $this->stream->readLine();
            $this->sequence .= preg_replace('/[^a-zA-Z]/', '', $line);
        }
    }
}