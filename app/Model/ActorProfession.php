<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

class ActorProfession extends Model
{   
    protected ?string $table = 'actor_professions';

    protected array $fillable = [
        'actor_id',
        'profession_id',
    ];
}
