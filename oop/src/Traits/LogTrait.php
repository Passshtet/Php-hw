<?php

trait LogTrait
{
    private array $log = [];

    public function addLog(string $message): void
    {
        $this->log[] = date('H:i:s') . ' ' . $message;
    }

    public function getLog(): array
    {
        return $this->log;
    }

    public function resetLog(): void
    {
        $this->log = [];
    }
}
