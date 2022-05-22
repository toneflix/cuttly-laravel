<?php

namespace ToneflixCode\Cuttly\Build;
use ToneflixCode\Cuttly\Exceptions\Cuttly_Exception;

class Shorten
{
    const STATUS = [
        '1' => 'The shortened link comes from the domain that shortens the link, i.e. the link has already been shortened.',
        '2' => 'The entered link is not a link.',
        '3' => 'The preferred link name / alias is already taken.',
        '4' => 'Invalid API key.',
        '5' => 'The link has not passed the validation. Includes invalid characters.',
        '6' => 'The link provided is from a blocked domain.',
        '7' => 'OK - the link has been shortened.',
    ];


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
     * @return ToneflixCode\Cuttly\Build\Shorten
     */
    public function params(string $url = null, string $name = null, $noTitle = false, $public = false): Shorten
    {
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

    /**
     * Check the status of this request
     *
     * @throws Cuttly_Exception
     * @return Shorten
     */
    public function status(): Shorten
    {
        if (isset($this->response->url->status)) 
        {
            $this->status = self::STATUS[$this->response->url->status];

            if ($this->response->url->status != '7') 
            {
                throw new Cuttly_Exception(self::STATUS[$this->response->url->status], Cuttly_Exception::getCode('shorten', $this->response->url->status));
            }
        }

        return $this;
    }
}