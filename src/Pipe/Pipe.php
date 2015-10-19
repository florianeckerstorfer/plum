<?php

/**
 * This file is part of plumphp/plum.
 *
 * (c) Florian Eckerstorfer <florian@eckerstorfer.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plum\Plum\Pipe;

use Plum\Plum\Converter\ConverterInterface;
use Plum\Plum\Filter\FilterInterface;
use Plum\Plum\Workflow;
use Plum\Plum\Writer\WriterInterface;

/**
 * Pipe
 *
 * @package   Plum\Plum\Pipe
 * @author    Florian Eckerstorfer
 * @copyright 2014-2015 Florian Eckerstorfer
 */
abstract class Pipe
{
    const PIPELINE_TYPE_FILTER          = 1;
    const PIPELINE_TYPE_CONVERTER       = 2;
    const PIPELINE_TYPE_WRITER          = 3;
    const PIPELINE_TYPE_VALUE_FILTER    = 4;
    const PIPELINE_TYPE_VALUE_CONVERTER = 5;

    /**
     * @var int
     */
    protected $type;

    /**
     * @var int
     */
    protected $position = Workflow::APPEND;

    /**
     * @var FilterInterface
     */
    protected $filter;

    /**
     * @var ConverterInterface
     */
    protected $converter;

    /**
     * @var WriterInterface
     */
    protected $writer;

    /**
     * @var string|int|array
     */
    protected $field;

    /**
     * @var string|int|array
     */
    protected $filterField;

    public function __construct($element)
    {
        if (is_array($element) && isset($element['position'])) {
            $this->setPosition($element['position']);
        }
    }

    /**
     * @return FilterInterface
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * @return ConverterInterface
     */
    public function getConverter()
    {
        return $this->converter;
    }

    /**
     * @return WriterInterface
     */
    public function getWriter()
    {
        return $this->writer;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @return array|int|string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @return array|int|string
     */
    public function getFilterField()
    {
        return $this->filterField;
    }

    /**
     * @param int $position
     *
     * @return Pipe
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type
     *
     * @return Pipe
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param FilterInterface $filter
     *
     * @return Pipe
     */
    public function setFilter(FilterInterface $filter)
    {
        $this->filter = $filter;

        return $this;
    }

    /**
     * @param array|int|string $filterField
     *
     * @return $this
     */
    public function setFilterField($filterField)
    {
        $this->filterField = $filterField;

        return $this;
    }

    /**
     * @param array|int|string $field
     *
     * @return $this
     */
    public function setField($field)
    {
        $this->field = $field;

        return $this;
    }
}