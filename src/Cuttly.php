<?php

namespace ToneflixCode\Cuttly;
use ToneflixCode\Cuttly\Build\Shorten;
use ToneflixCode\Cuttly\Build\Edit;
use Illuminate\Support\Facades\Http;
use ToneflixCode\Cuttly\Build\Status;
use ToneflixCode\Cuttly\Exceptions\CuttlyException;

class Cuttly
{
    use Shorten, Edit;

    protected $base_url = 'https://cutt.ly/api/api.php';
    protected $key;
    public $response = [];

    public function __construct()
    {
        $this->key = config('cuttly.key');

        $this->checkStatus = new Status;

        if (empty($this->key)) {
            throw new CuttlyException("A valid API key has not been provided.", 1);
        }
    }

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
     * @return array
     */
    public function shorten(string $url = null, string $name = null, bool $noTitle = false, bool $public = false): array
    {
        $this->params = $this->shortenParams($url, $name, $noTitle, $public)->params;
        $this->response = Http::get($this->base_url, $this->params);
        $this->checkStatus->response = $this->response;
        $this->checkStatus->shorten();
        return $this->response->json('url');
    }

    /**
     * Change the name of a link
     *
     * @param string|null $link    Your shortened link to be edited. Required
     * @param boolean $name         New alias / name, if not already taken.
     *
     * @return array
     */
    public function changeName( string $link = null, string $name = null ): array
    {
        if (empty($name)) {
            throw new CuttlyException("You have not provided a new name for the link.", 500);
        }
        $this->params = $this->editParams($link, null, $name)->params;
        $this->response = Http::get($this->base_url, $this->params);
        $this->checkStatus->response = $this->response;
        $this->checkStatus->edit();
        return $this->response->json();
    }

    /**
     * Add a tag to a link
     *
     * @param string|null $link    Your shortened link to be edited. Required
     * @param boolean $tag         The TAG you want to add for shortened link.
     *
     * @return array
     */
    public function addTag( string $link = null, string $tag = null ): array
    {
        if (empty($tag)) {
            throw new CuttlyException("You have not provided a tag to add to the link.", 500);
        }
        $this->params = $this->editParams($link, $tag)->params;
        $this->response = Http::get($this->base_url, $this->params);
        $this->checkStatus->response = $this->response;
        $this->checkStatus->edit();
        return $this->response->json();
        return [];
    }

    /**
     * It will change the source url of shortened link.
     * You can change source URL depending at your subscription plan.
     *
     * @param string|null $link    Your shortened link to be edited. Required
     * @param boolean $source      The new source url.
     *
     * @return array
     */
    public function changeUrl( string $link = null, string $source = null ): array
    {
        if (empty($source)) {
            throw new CuttlyException("You have not provided the new source url.", 500);
        }
        $this->params = $this->editParams($link, null, null, $source)->params;
        $this->response = Http::get($this->base_url, $this->params);
        $this->checkStatus->response = $this->response;
        $this->checkStatus->edit();
        return $this->response->json();
        return [];
    }

    /**
     * It will change the title of the shortened link.
     * You can change the short link title depending at your subscription plan.
     *
     * @param string|null $link    Your shortened link to be edited. Required
     * @param boolean $title      The new title.
     *
     * @return array
     */
    public function changeTitle( string $link = null, string $title = null ): array
    {
        if (empty($title)) {
            throw new CuttlyException("You have not provided the new source url.", 500);
        }
        $this->params = $this->editParams($link, null, null, null, $title)->params;
        $this->response = Http::get($this->base_url, $this->params);
        $this->checkStatus->response = $this->response;
        $this->checkStatus->edit();
        return $this->response->json();
        return [];
    }

    /**
     * Sets a unique stat count for a short link.
     * unique=0 | It removes counting unique clicks.
     * unique=1 | for Single subscription plan. The time of uniqueness is 15 minutes.
     * unique=15-1440 | for Team subscription plans. Time to count unique clicks ranging from 15 minutes to 1440 minutes (24h).
     *
     * @param string|null $link    Your shortened link to be edited. Required
     * @param boolean $title      The unique stat count.
     *
     * @return array
     */
    public function unique( string $link = null, string $unique = null ): array
    {
        if ($unique === null) {
            throw new CuttlyException("You have not provided unique stat count for the short link.", 500);
        }
        $this->params = $this->editParams($link, null, null, null, null, $unique)->params;
        $this->response = Http::get($this->base_url, $this->params);
        $this->checkStatus->response = $this->response;
        $this->checkStatus->edit();
        return $this->response->json();
        return [];
    }

    /**
     * Delete a shortened link.
     *
     * @param string|null $link    Your shortened link to be edited. Required
     * @param boolean $title      The new title.
     *
     * @return array
     */
    public function delete( string $link = null ): array
    {
        $this->params = $this->editParams($link, null, null, null, null,  null, true)->params;
        $this->response = Http::get($this->base_url, $this->params);
        $this->checkStatus->response = $this->response;
        $this->checkStatus->edit();
        return $this->response->json();
        return [];
    }

    public function __toString()
    {
        json_encode($this->response);
    }
}
