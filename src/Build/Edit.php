<?php

namespace ToneflixCode\Cuttly\Build;
use ToneflixCode\Cuttly\Cuttly;
use ToneflixCode\Cuttly\Exceptions\CuttlyException;

trait Edit
{
    public $params;

    /**
     * Build the params to edit the link
     *
     * @param string|null $link    Your shortened link to be edited. Required
     * @param string|null $tag     The TAG you want to add for shortened link.
     * @param boolean $name        New alias / name, if not already taken.
     * @param boolean $source      It will change the source url of shortened link. You can change source URL depending at your subscription plan
     * @param boolean $title       It will change the title of url of shortened link. You can change the short link title depending at your subscription plan.
     * @param boolean $unique      Sets a unique stat count for a short link.
     * @param boolean $delete      It will delete your shortened link.
     *
     * @return ToneflixCode\Cuttly\Cuttly|Shorten
     */
    public function editParams(
        string $link = null,
        string $tag = null,
        string $name = null,
        string $source = null,
        string $title = null,
        int $unique = null,
        bool $delete = false
    ): Cuttly|Shorten
    {
        if (empty($link)) {
            throw new CuttlyException("You have not provided a shortened link to edit.", 500);
        }

        $this->params['key'] = $this->key;

        if ($link) {
            $this->params['edit'] = $link;
        }

        if ($tag) {
            $this->params['tag'] = $tag;
        }

        if ($name) {
            $this->params['name'] = $name;
        }

        if ($source) {
            $this->params['source'] = $source;
        }

        if ($title) {
            $this->params['title'] = $title;
        }

        if ($delete) {
            $this->params['delete'] = $delete;
        }

        if (is_numeric($unique)) {
            $this->params['unique'] = $unique;
        }

        return $this;
    }
}
