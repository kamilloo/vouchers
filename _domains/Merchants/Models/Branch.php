<?php
declare(strict_types=1);

namespace Domain\Merchants\Models;

use App\Models\Branch as CoreBranch;

class Branch extends CoreBranch
{
    public function scopeByName($query, string $name)
    {
        $trimmed_name = mb_strtolower(trim($name));
        $query->where('name', $trimmed_name);
    }
}
