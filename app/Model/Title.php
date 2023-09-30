<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

class Title extends Model
{   
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

}
