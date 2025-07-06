<?php

declare(strict_types=1);

namespace App\Presentation\Home;

use Nette;
use Nette\Database\Explorer;

final class HomePresenter extends Nette\Application\UI\Presenter
{
    public function __construct(
        private readonly Explorer $database
    ) {
    }

    public function renderDefault(): void
    {
        $this->template->notes = $this->database->table('notes');
    }
}
