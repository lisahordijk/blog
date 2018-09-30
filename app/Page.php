<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Laracasts\Presenter\PresentableTrait;

// We gebruiken custom packages voor het weergeven van pagina en het bepalen waar een pagina in de menubalk komt te staan.

class Page extends Model
{
    // specificaties pages
    protected $fillable = [
        'title',
        'url',
        'content'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
