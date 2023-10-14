<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;
use Hyperf\Scout\Searchable;

class Title extends Model
{
    use Searchable;

    protected ?string $table = 'titles';

    protected array $fillable = [
        'id',
        'tconst',
        'type_id',
        'primary',
        'original',
        'is_adult',
        'start_year',
        'end_year',
        'runtime_minutes',
        'img',
        'genresJson',
        'actorsJson',
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'title_genres');
    }

    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'actor_titles');
    }

    public function titleRatings()
    {
        return $this->hasOne(TitleRatings::class, 'title_id');
    }

        public function toSearchableArray(): array
    {
        return [
            'tconst' => $this?->tconst,
            'primary' => $this?->primary,
            // 'original' => $this?->original,
            'start_year' => $this?->start_year,
            'end_year' => $this?->end_year,
            'runtime_minutes' => $this?->runtime_minutes,
            'img' => $this?->img,
            'genres' => $this?->genresJson,
            'actors' => $this?->actorsJson,
            'ranting' => $this?->titleRatings?->average_rating,
            'votes' => $this?->titleRatings?->num_votes,
        ];
    }
}
