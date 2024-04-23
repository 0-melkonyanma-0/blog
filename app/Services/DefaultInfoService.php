<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Collection;
use Spatie\Permission\Models\Permission;

class DefaultInfoService
{

    /**
     * @return array<string|Collection<int|string>>
     */
    public function getData(): array
    {
        return [
            'permissions' => $this->getPermissions()
        ];
    }

    /**
     * @return Collection<string|string>
     */
    protected function getPermissions(): Collection
    {
        return Permission::all()->pluck('name');
    }
}
