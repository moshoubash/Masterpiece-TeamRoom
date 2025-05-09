<?php

namespace App\Services;

use App\Models\Activity;

class CreateNewActivity
{
    private $userId;
    private $type;
    private $name;
    private $description;

    public function __construct(
        int $userId,
        string $type,
        string $name,
        string $description
    ) {
        $this->userId = $userId;
        $this->type = $type;
        $this->name = $name;
        $this->description = $description;
    }

    public function execute()
    {
        return Activity::create([
            'user_id' => $this->userId,
            'type' => $this->type,
            'name' => $this->name,
            'description' => $this->description
        ]);
    }
}
