<?php

namespace App\Emails;

use Illuminate\Mail\Mailable;

class InvitedEmail extends Mailable
{
    public function __construct(protected string $subj, protected string $htmlContent, protected string $fromAddress, protected string $fromName)
    {}

    public function build() {
        return $this->from($this->fromAddress, $this->fromName)
            ->html($this->htmlContent)->subject($this->subj);
    }
}
