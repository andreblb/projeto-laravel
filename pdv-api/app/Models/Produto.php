<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    // Opcional: defina a tabela se o nome no banco for diferente de 'produtos'
    protected $table = 'produtos';

    // Opcional: caso você não utilize as colunas created_at e updated_at
    public $timestamps = false;
}
