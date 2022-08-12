<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;
use App\Models\ArticleUser;

class ArticleController extends Controller
{
    /**
     * Список статей с авторами
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(){
        $articles = array();
        foreach (
            Article::with(['users'])
                ->lazyById(200)
            as $article) {
            $row = $article->toArray();
            $articles[] = $row;
        }
        return view('articles', compact('articles'));
    }


    /**
     * Удаление статьи и редирект на общий список
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id){
        $article = Article::find($id);
        $article->delete();
        ArticleUser::where('article_id', $id)->delete();
        return redirect()->route('article.index')->with('success','Статья успешно удалена');
    }


    /**
     * Является ли пользователь автором хоть одной статьи
     * @param User $user
     *
     * @return bool|null
     */
    public static function isAuthor(User $user): ?bool
    {
        $activeArticles = $user->articles;
        if (count($activeArticles)>0){
            $retValue = true;
        }else{
            $retValue = false;
            $delArticles = Article::onlyTrashed()->with('users')->get();
            foreach ($delArticles as $article){
                foreach ($article->users as $author){
                    //dd($author);
                    //exit();
                    // $author почему то не равен $user. Нужно использовать либо $author->is($user) либо руками сравнивать $author->id == $user->id
                    //if ($author->id == $user->id){
                    if ($author->is($user)){
                        $retValue = null;
                        break(2);
                    }
                }
            }
        }
        return $retValue;
    }

}
