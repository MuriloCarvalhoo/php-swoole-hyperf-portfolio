<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

class Actor extends Model
{   
    protected ?string $table = 'actors';

    protected array $fillable = [
        'id', 
        'nconst',
        'name',
        'birth_year',
        'death_year',
        'primary_profession',
        'known_for_titles',
    ];

    public function professions()
    {
        return $this->belongsToMany(Profession::class, 'actor_professions');
    }

    public function titles()
    {
        return $this->belongsToMany(Title::class, 'actor_titles');
    }

}
