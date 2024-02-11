<?php

namespace App\Emails;

use Illuminate\Mail\Mailable;

class PurchaseEmail extends Mailable
{
    public function __construct(protected string $subj, protected string $htmlContent)
    {}

    public function build() {
        return $this->html($this->htmlContent)->subject($this->subj);
    }
}
