<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

class TypeTitle extends Model
{   
    protected ?string $table = 'type_titles';

    protected array $fillable = [
        'id', 
        'name',
    ];

    public function title()
    {
        return $this->hasMany(Title::class);
    }
}
