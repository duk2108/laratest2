<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function users(){
        return $this->belongsToMany(User::class);
    }

    /**
     * ¬озвращает список статей с автором в виде массива
     * @return array
     */
    public static function articleList() : array {
        $articles = array();
        foreach (
            self::with(['users'])
                ->lazyById(200)
            as $article) {
            $row = $article->toArray();
            $articles[] = $row;
        }
        return $articles;
    }
}
