<?php

namespace ToneflixCode\Cuttly\Build;
use ToneflixCode\Cuttly\Exceptions\CuttlyException;

class Status
{
    const SHORTEN = [
        '1' => 'The shortened link comes from the domain that shortens the link, i.e. the link has already been shortened.',
        '2' => 'The entered link is not a link.',
        '3' => 'The preferred link name / alias is already taken.',
        '4' => 'Invalid API key.',
        '5' => 'The link has not passed the validation. Includes invalid characters.',
        '6' => 'The link provided is from a blocked domain.',
        '7' => 'OK - the link has been shortened.',
    ];

    const EDIT = [
        '1' => 'OK.',
        '2' => 'Could not save in database.',
        '3' => 'The url does not exist or you do not own it.',
        '4' => 'URL didn\'t pass the validation.',
    ];

    /**
     * Check the status of the shorten request
     *
     * @throws CuttlyException
     * @return string
     */
    public function shorten(): string
    {
        if (isset($this->response) && $this->response instanceof \Illuminate\Http\Client\Response) {
            if ($this->response->status() !== 200 || is_string($this->response->json())) {
                throw new CuttlyException($this->response->json(), $this->response->status());
            }
            $this->response = $this->response->json('url');
        }

        if (isset($this->response['status']))
        {
            if ($this->response['status'] != '7')
            {
                throw new CuttlyException(Status::SHORTEN[$this->response['status']], CuttlyException::setCode('shorten', $this->response['status']));
            }
        }

        return Status::SHORTEN[$this->response['status']];
    }

    /**
     * Check the status of the edit request
     *
     * @throws CuttlyException
     * @return string
     */
    public function edit(): string
    {
        if (isset($this->response) && $this->response instanceof \Illuminate\Http\Client\Response) {
            if ($this->response->status() !== 200 || is_string($this->response->json())) {
                throw new CuttlyException($this->response->json(), $this->response->status());
            }
            $this->response = $this->response->json();
        }

        if (isset($this->response['status']))
        {
            if ($this->response['status'] != '1')
            {
                throw new CuttlyException(Status::EDIT[$this->response['status']], CuttlyException::setCode('edit', $this->response['status']));
            }
        }

        return Status::EDIT[$this->response['status']];
    }
}
