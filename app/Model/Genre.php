<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

class Genre extends Model
{   
    public bool $timestamps = false;
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'genres';

    protected array $fillable = [
        'id', 
        'name',
    ];
}
