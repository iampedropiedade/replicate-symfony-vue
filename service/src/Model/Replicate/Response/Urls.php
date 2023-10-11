<?php

declare(strict_types=1);

namespace App\Model\Replicate\Response;

class Urls
{
    protected string $cancel;
    protected string $get;

    public function getCancel(): string
    {
        return $this->cancel;
    }

    public function setCancel(string $cancel): Urls
    {
        $this->cancel = $cancel;
        return $this;
    }

    public function getGet(): string
    {
        return $this->get;
    }

    public function setGet(string $get): Urls
    {
        $this->get = $get;
        return $this;
    }


}
