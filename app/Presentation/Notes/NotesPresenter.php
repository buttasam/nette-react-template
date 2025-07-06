<?php

declare(strict_types=1);

namespace App\Presentation\Notes;

use Nette;
use Nette\Application\Attributes\Requires;
use Nette\Http\Request;
use Nette\Http\Response;
use App\Repository\NoteRepository;

final class NotesPresenter extends Nette\Application\UI\Presenter
{
    public function __construct(
        private NoteRepository $notes,
        private Request $httpRequest,
        private Response $httpResponse,
    ) {
    }

    #[Requires(methods: ['GET', 'POST', 'DELETE'])]
    public function actionDefault(?int $id): void
    {
        $method = $this->httpRequest->getMethod();

        match ($method) {
            'GET' => $this->getNotes(),
            'POST' => $this->postNote(),
            'DELETE' => $this->deleteNote($id),
            default => $this->sendMethodNotAllowed(),
        };
    }

    private function getNotes(): void
    {
        $data = [];
        foreach ($this->notes->findAll() as $row) {
            $data[] = $row->toArray();
        }
        $this->sendJson($data);
    }

    private function postNote(): void
    {
        $data = Nette\Utils\Json::decode($this->httpRequest->getRawBody(), forceArrays: true);
        $result = $this->notes->insert([
            'content' => $data['content'] ?? '',
        ]);

        $this->httpResponse->setCode(Response::S201_Created);
        $this->sendJson($result->toArray());
    }

    private function deleteNote(?int $id): void
    {
        if ($id === null || !$this->notes->delete($id)) {
            $this->httpResponse->setCode(Response::S404_NotFound);
            $this->sendJson(['error' => 'Note not found.']);
        } else {
            $this->sendJson(['status' => 'deleted']);
        }
    }

    private function sendMethodNotAllowed(): void
    {
        $this->httpResponse->setCode(Response::S405_MethodNotAllowed);
        $this->sendJson(['error' => 'Method not allowed.']);
    }
}
