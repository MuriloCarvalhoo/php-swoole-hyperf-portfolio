<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

class TitleGenre extends Model
{   
    protected ?string $table = 'title_genres';

    protected array $fillable = [
        'title_id',
        'genre_id',
    ];
}
