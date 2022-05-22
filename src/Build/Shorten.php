<?php

namespace ToneflixCode\Cuttly\Build;
use ToneflixCode\Cuttly\Cuttly;

trait Shorten
{
    public $params;

    /**
     * Build the params to shorten the link
     *
     * @param string|null $url     URL you want to shorten. Required
     * @param string|null $name    Your desired short link - alias- if not already taken
     * @param boolean $noTitle     Faster API response time
     *                             This parameter disables getting the page title from the source page meta tag which results in faster API response time
     *                             Available for Team Enterprise plan
     * @param boolean $public      Settings public click stats for shortened link via API (Available from Single plan)
     *
     * @return ToneflixCode\Cuttly\Cuttly|Shorten
     */
    public function shortenParams(string $url = null, string $name = null, bool $noTitle = false, bool $public = false): Cuttly|Shorten
    {
        if (empty($url)) {
            throw new CuttlyException("You have not provided the URL you want to shorten.", 500);
        }

        $this->params['key'] = $this->key;

        if ($url) {
            $this->params['short'] = $url;
        }

        if ($name) {
            $this->params['name'] = $name;
        }

        if ($noTitle) {
            $this->params['noTitle'] = $noTitle;
        }

        if ($public) {
            $this->params['public'] = $public;
        }

        return $this;
    }
}