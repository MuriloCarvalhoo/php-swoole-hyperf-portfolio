<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

class ActorTitle extends Model
{   
    protected ?string $table = 'actor_titles';

    protected array $fillable = [
        'actor_id',
        'title_id',
    ];
}
