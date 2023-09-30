<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

class TitleRatings extends Model
{   
    protected ?string $table = 'title_ratings';

    protected array $fillable = [
        'title_id',
        'tconst',
        'average_rating',
        'num_votes',
    ];

    public function title()
    {
        return $this->belongsTo(Title::class);
    }
}
