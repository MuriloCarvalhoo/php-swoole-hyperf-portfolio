<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

class Profession extends Model
{   
    protected ?string $table = 'professions';

    protected array $fillable = [
        'id', 
        'name',
    ];
}
