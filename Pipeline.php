<?php

/*
 * Wolf CMS - Content Management Simplified. <http://www.wolfcms.org>
 * Copyright (C) 2013 Martijn van der Kleijn <martijn.niji@gmail.com>
 *
 * This file is part of Wolf CMS. Wolf CMS is licensed under the GNU GPLv3 license.
 * Please see license.txt for the full license text.
 */

/**
 * String processing Pipeline.
 * 
 * Construct a Pipeline for running multiple Filters.  A Pipeline is created once
 * with one to many filters, and it then can be applied many times over the course
 * of its lifetime with input.
 * 
 * filters        - Array of Filter objects. Each must respond to apply($text,
 *                  $context) and return a filtered text as string. Filters are
 *                  performed in the order provided.
 *                  Default: empty array.
 * defaultContext - The default context hash. Values specified here will be merged
 *                  with values from each individual Filter that's run.
 *                  Default: empty array.
 * 
 * @package Helpers
 *
 * @author     Martijn van der Kleijn <martijn.niji@gmail.com>
 * @copyright  Martijn van der Kleijn, 2013
 * @license    GPLv3 License <http://www.gnu.org/copyleft/gpl.txt>
 */
class Pipeline {

    private $filters = array();
    private $context = array();

    /**
     * Construct a new Pipeline.
     * 
     * @param type $filters
     * @param type $context
     * @throws Exception
     */
    public function __construct($filters = array(), $defaultContext = array()) {

        $this->filters = $filters;
        $this->context = $defaultContext;
    }

    /**
     * Apply all filters in the pipeline to the given HTML.
     *
     * in      - A String containing HTML or some other string.
     * context - The context hash passed to each filter. This is merged with the
     *           Pipeline's default context.
     * 
     * @param type $in
     * @param type $context
     * @return $result
     */
    public function apply($in, $context = array()) {
        $this->context = array_merge($this->context, $context);
        $result = $in;

        foreach ($this->filters as $filter) {
            $result = $filter->apply($result, $this->context);
        }

        return $result;
    }

    /**
     * Returns all Filters that make up this Pipeline.
     * 
     * @return type
     */
    public function getFilters() {
        return $this->filters;
    }

    /**
     * Allows you to add a Filter to the Pipeline.
     * 
     * @param type $filter
     */
    public function addFilter($filter) {
        $this->filters[] = $filter;
    }

}