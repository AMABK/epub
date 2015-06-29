<?php

namespace Epubli\Epub;

use Iterator;

/**
 * EPUB TOC structure
 *
 * @author Simon Schrape <simon@epubli.com>
 */
class EpubToc
{
    /** @var string */
    private $docTitle;
    /** @var string */
    private $docAuthor;
    /** @var EpubNavPointList */
    private $navMap;

    public function __construct($title, $author)
    {
        $this->docTitle = $title;
        $this->docAuthor = $author;
        $this->navMap = new EpubNavPointList();
    }

    /**
     * @return string
     */
    public function getDocTitle()
    {
        return $this->docTitle;
    }

    /**
     * @return string
     */
    public function getDocAuthor()
    {
        return $this->docAuthor;
    }

    /**
     * @return EpubNavPointList
     */
    public function getNavMap()
    {
        return $this->navMap;
    }
}

class EpubNavPointList implements Iterator
{
    /** @var array */
    private $navPoints = [];

    public function __construct()
    {
    }

    public function addNavPoint(EpubNavPoint $navPoint)
    {
        $this->navPoints[] = $navPoint;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return EpubNavPoint
     */
    public function current()
    {
        return current($this->navPoints);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    public function next()
    {
        next($this->navPoints);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     */
    public function key()
    {
        return key($this->navPoints);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     */
    public function valid()
    {
        return (bool)current($this->navPoints);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    public function rewind()
    {
        reset($this->navPoints);
    }

    /**
     * @return EpubNavPoint
     */
    public function first()
    {
        return reset($this->navPoints);
    }

    /**
     * @return EpubNavPoint
     */
    public function last()
    {
        return end($this->navPoints);
    }

    public function count()
    {
        return count($this->navPoints);
    }
}

class EpubNavPoint
{
    /** @var string */
    private $id;
    /** @var string */
    private $class;
    /** @var int */
    private $playOrder;
    /** @var string */
    private $navLabel;
    /** @var string */
    private $contentSource;
    /** @var EpubNavPointList */
    private $children;

    /**
     * @param string $id
     * @param string $class
     * @param int $playOrder
     * @param string $label
     * @param string $contentSource
     */
    public function __construct($id, $class, $playOrder, $label, $contentSource)
    {
        $this->id = $id;
        $this->class = $class;
        $this->playOrder = $playOrder;
        $this->navLabel = $label;
        $this->contentSource = $contentSource;
        $this->children = new EpubNavPointList();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @return int
     */
    public function getPlayOrder()
    {
        return $this->playOrder;
    }

    /**
     * @return string
     */
    public function getNavLabel()
    {
        return $this->navLabel;
    }

    /**
     * @return string
     */
    public function getContentSource()
    {
        return $this->contentSource;
    }

    /**
     * @return EpubNavPointList
     */
    public function getChildren()
    {
        return $this->children;
    }
}