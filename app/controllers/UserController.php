<?php

namespace app\controllers;

use engine\App;
use app\models\User;
use engine\base\View;
use engine\libs\Cookie;

/**
 * Description of UserController
 *
 * @author Sergey
 */
class UserController extends AppController 
{

    public function signupAction() 
    {
        View::setMeta("Регистрация", "Регистрация", "Регистрация");
        
            $userModel = new User();
            $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
            if ($contentType === "application/json") {
                
                //Receive the RAW post data.
                $content = trim(file_get_contents("php://input"));

                $decoded = json_decode($content, true);
                $userModel->load($decoded);
                
                if (!$userModel->validate($decoded) || !$userModel->checkUnique()){
                    $status = "=====Error validation=====";
                    $this->loadView('ajaxSignup', $status);
                }else{
                    $status = "=====Success validation=====";
                    $userModel->attributes['password'] = password_hash($userModel->attributes['password'], PASSWORD_DEFAULT);
            
                    if ($userModel->attributes['role'] === 'admin') {
                        $userModel->attributes['role'] = 'register';
                    }

                    if ($userModel->insert($userModel->attributes['login'], $userModel->attributes['email'], $userModel->attributes['password'], $userModel->attributes['role'] )) {
                        $this->loadView('ajaxSignup', $status);
                    } else {
                        $_SESSION['validate_errors'] = 'Ошибка при регистрации! ';
                    }
                }
                    
              }
            
            
            
    }
        
    public function loginAction() 
    {
        View::setMeta('Индекс пейдж', "Это описание индекс пейдж", "Это кейвордс");
        if (!empty(App::$app->request->post) && isset(App::$app->request->post)) {
            
            $userModel = new User();
            
            if ($userModel->login(App::$app->request->post['login'])) {
                App::$app->request->session['validate_success'] = 'Вы вошли на сайт!';
                Cookie::set('name', App::$app->request->post['login']);
            } else {
                App::$app->request->session['validate_errors'] = 'Логин или пароль введены не верно!';
            }
            redirect('/');
         }
    }
        
    public function logoutAction() 
    {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
        
        if (isset($_COOKIE['name'])) {
            Cookie::delete('name');
        }
        
        redirect('/user/login');
    } 
    
    
}
