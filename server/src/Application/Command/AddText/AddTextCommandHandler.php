<?php

declare(strict_types=1);

namespace Cfi\Application\Command\AddText;

use Cfi\Domain\Exception\NotFoundException;
use Cfi\Domain\Model\Word;
use Cfi\Domain\Repository\WordRepository;
use Cfi\Domain\UuidGenerator;
use Cfi\Domain\ValueObject\UserId;
use Cfi\Domain\ValueObject\WordId;

class AddTextCommandHandler
{
    private WordRepository $wordRepository;
    private UuidGenerator $uuidGenerator;

    public function __construct(WordRepository $wordRepository, UuidGenerator $uuidGenerator)
    {
        $this->wordRepository = $wordRepository;
        $this->uuidGenerator = $uuidGenerator;
    }

    public function __invoke(AddTextCommand $command): void
    {
        $userId = UserId::createFromString($command->getUserId());

        $bagOfWords = str_word_count($command->getText(), 1);
        $filteredWords = array_filter($bagOfWords, static function (string $word) {
            return mb_strlen($word) > 2;
        });
        $groupedSameWords = [];
        foreach ($filteredWords as $word) {
            $lowercaseWord = mb_strtolower($word);
            $groupedSameWords[$lowercaseWord] = ($groupedSameWords[$lowercaseWord] ?? 0) + 1;
        }

        foreach ($groupedSameWords as $groupedSameWord => $count) {
            try {
                $word = $this->wordRepository->getByWordAndUser($groupedSameWord, $userId);
                $word->increaseCount($count);
            } catch (NotFoundException $notFoundException) {
                $word = new Word(WordId::generate($this->uuidGenerator), $userId, $groupedSameWord, $count);
                $this->wordRepository->add($word);
            }
        }
    }
}
