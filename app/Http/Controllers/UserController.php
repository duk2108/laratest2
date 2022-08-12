<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    /**
     * Показывает форму для создания пользователя
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showForm()
    {
        $added = array(
            'nickname'=>'',
            'name'=>'',
            'surname'=>'',
            'sex'=>'0',
            'showphone'=>0,
            'phone'=>'',
            );
        return view('main', compact('added'))->with('mode', 'beforeAdd');
    }

    /**
     * Создает пользователя и показывает созданное
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showUser(Request $request)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg',
        ]);

        $added = $request->all();
        $added['password'] = '';
        //$added['avatar'] = 'NULL';
        $added['showphone'] = $request->showphone == 'on' ? 1 : 0;

        if ($image = $request->file('avatar')) {
            $path = $image->getRealPath();
            $added['avatar'] = file_get_contents($path);
        }

        $id = User::create($added)->id;
        $added['id'] = $id;
        //$request = array($request);

        return view('main', compact('added'))->with('mode', 'aterAdd');
    }

    /**
     * тестовый метод. Извлекает модель,  печатает поле, потом ждет, потом снова печатает.
     * В это время другой метод  меняет опыт на случайное число каждые несколько секунд 
     * очевидно, что без refresh ничего не изменится
     */
    public static function showExp()
    {
        $user = User::find(1);
        echo 'first exp is ' . $user->experience . ' ('. date("H:i:s") .')<br>';
        sleep(10);
        echo 'second exp is ' . $user->experience . ' ('. date("H:i:s") .')<br>';
    }

    /**
     * Меняет experience на случайное число
     */
    public static function changeExp()
    {
        $user = User::find(1);
        $user->experience = rand(1,9999);
        $user->save();
    }

    /**
     * По айди пользователя показывает картинку (аватар) на странице
     * @param $id
     */
    public function showAvatar($id)
    {
        $avatar = User::find($id)->avatar;
        header("Content-type: image/jpeg");
        echo $avatar;
    }

    /**
     * Создает по айди пользователя и печатает, является ли он автором какой то статьи
     * @param $id
     */
    public function authorTest($id){
        $user = User::find($id);
        $retVal = ArticleController::isAuthor($user);
        if ($retVal === true) {
            echo 'true';
        }else{
            if ($retVal === false) {
                echo 'false';
            }else{
                if ($retVal === null){
                    echo 'null';
                }else{
                    echo '??? ' . $retVal;
                }
            }
        }
    }

}
