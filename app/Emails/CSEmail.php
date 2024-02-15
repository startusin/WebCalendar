<?php

namespace App\Emails;

use Illuminate\Mail\Mailable;

class CSEmail extends Mailable
{
    protected string $subj;
    protected string $htmlContent;
    protected string $fromAddress;
    protected string $fromName;

    public function __construct(string $subj, string $htmlContent, string $fromAddress, string $fromName)
    {
        $this->subj = $subj;
        $this->htmlContent = $htmlContent;
        $this->fromAddress = $fromAddress;
        $this->fromName = $fromName;
    }

    public function build()
    {
        return $this->from($this->fromAddress, $this->fromName)
            ->html($this->htmlContent)
            ->subject($this->subj);
    }
}
