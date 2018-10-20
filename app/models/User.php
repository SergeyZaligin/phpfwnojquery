<?php

namespace app\models;

use engine\App;

/**
 * Description of User
 *
 * @author Sergey
 */
class User extends AppModel
{
    /**
     * Attributes model user
     * 
     * @var array
     */
    public $attributes = [
        'login' => '',
        'password' => '',
        'email' => '',
        'role' => 'user'
        
    ];
    public $rules = [
        'required' => [
            'login',
            'password',
            'email'
        ],
        'email' => [
            'email'
        ],
        'lengthMin' => [
            [
             'password',
             6
            ]
        ]
    ];
    
    public function insert($login, $email, $password, $role) 
    {
        return $this->db->query(
        "INSERT INTO user (login, email, password, role) VALUES (:login, :email, :password, :role)", [
            'login' => $login,
            'email' => $email,
            'password' => $password,
            'role' => $role
        ]);
    }
    
    public function checkUnique() 
    {
        $user = $this->db->query("SELECT * FROM user WHERE login=:login OR email=:email", [
            'login' => $this->attributes['login'],
            'email' => $this->attributes['email']
        ], \PDO::FETCH_CLASS);

        if (!empty($user)) {
            
            if ($this->attributes['login'] === $user->login) {
                $this->errors['unique'][] = "Логин {$user->login} занят!";
            }
            
            if ($this->attributes['email'] === $user->email) {
                $this->errors['unique'][] = "Логин {$user->email} занят!";
            }
            
            return false;
        } else {
            return true;
        }
    }
    
    public function checkSql($login) 
    {
        $user = $this->db->query("SELECT * FROM user WHERE login=:login LIMIT 1", [
            'login' => $login
        ], \PDO::FETCH_CLASS);
        return $user[0]->password;
    }

    /**
     * Checked login user
     * 
     * @param string $login
     * @return bool
     */
    public function login(string $login): bool
    {
        $login = !empty(trim(App::$app->request->post['login'])) ? trim(App::$app->request->post['login']) : null;
        $password = !empty(trim(App::$app->request->post['password'])) ? trim(App::$app->request->post['password']) : null;

        if ($login && $password) {
            
            $query = $this->db->query("SELECT * FROM user WHERE login=:login LIMIT 1", [
            'login' => $login
        ],\PDO::FETCH_CLASS);

            $user = $query[0];
            
            if ($user) {
                if (password_verify($password, $user->password)) {
                    
                    foreach ($user as $key => $value) {
                        
                        if ($key !== 'password') {
                            $_SESSION['user'][$key] = $value;
                        }
                        
                    }
                    
                    return true;
                }
                
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
