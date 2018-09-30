<?php

namespace App;

use Carbon\Carbon;

class Post extends Model
{
  // specificaties posts
  public function comments()
  {
    return $this->hasMany(Comment::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  // een comment toe kunnen voegen
  public function addComment($body)
  {
    $this->comments()->create([
      'user_id' => auth()->id(),
      'body' => $body,
    ]);

  }

  // filter posts op maand en jaar
  public function scopeFilter($query, $filters)
  {
    if (isset($filters['month']))
    {
      if ($month = $filters['month']) {
        $query->whereMonth('created_at', Carbon::parse($month)->month);
      }

      if ($year = $filters['year']) {
        $query->whereYear('created_at', $year);
      }
    }
  }

  // kopje archives dat sorteer werk doet
  public static function archives()
  {
    return static::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')
    ->groupBy('year', 'month')
    ->orderByRaw('min(created_at) desc')
    ->get()
    ->toArray();
  }

  // de tags
  public function tags()
  {
    return $this->belongsToMany(Tag::class);
  }
}
