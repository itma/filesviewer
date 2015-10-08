<?php

/**
 * The User class aims to manage all the operations regarding to the user
 * @author andrew@itma.pl
 **/
class User {

    public $i18n;

    /**
    * Sets the object up
    * @param $i18n array
    **/
    public function __construct(array $i18n) {
        $this->i18n = $i18n;
    }

    /**
    * Creates a new account
    * @param $data array
    * @param $i18n array
    * @return true if created otherwise array containing errors
    **/
    public function create(array $data) {
        // An array to storage the errors that may happen during the process
        $errors = array();
        // the local storage for users  credentials
        $dbFile = __DIR__ . '/../db/users.php';
        if (file_exists($dbFile)) {
            // open the users list
            $users = include($dbFile);

            // check if user exists
            if (isset($users[$data['email']])) {
                $errors[] = $this->i18n['registration_error_email_exists'];
            }

            // check the required fields are filled
            if (empty($data['email'])) {
                $errors[] = $this->i18n['registration_error_empty_email'];
            }
            if (empty($data['mobile'])) {
                $errors[] = $this->i18n['registration_error_empty_password'];
            }
            if (empty($data['name'])) {
                $errors[] = $this->i18n['registration_error_empty_name'];
            }
            if (empty($data['mobile'])) {
                $errors[] = $this->i18n['registration_error_empty_mobile'];
            }

            // add new user to the list
            $users[$data['email']] = array(
                'password' => md5($data['password']),
                'name' => $data['name'],
                'mobile' => $data['mobile'],
                'confirmed' => 0,
                'hash' => md5($data['email'] . $data['password'] . microtime())
            );

            $template = $this->prepareDbTemplate($users);

            if (count($errors) == 0) {
                $config = include_once(__DIR__ . '/../db/config.php');
                require_once('mailer.php');
                $mailer = new Mailer($config);
                $data['hash'] = $users[$data['email']]['hash'];
                $mailer->confirmAccountMessage($data);
                return file_put_contents($dbFile, $template);
            } else {
                return $errors;
            }
        }
    }

    /**
    * Prepares the list to write into the file
    * @param $users array
    * @return string
    **/
    public function prepareDbTemplate($users) {
        // 
        $template = "<?php
            // An array to storage the users credentials.
            // Updated " . date('Y/m/d H:i:s') . "
            return array(";
                foreach ($users as $email => $user) {
                    $template .= "'".$email."' => array(
                        'name' => '".$user['name']."',
                        'mobile' => '".$user['mobile']."',
                        'password' => '".$user['password']."',
                        'confirmed' => ".$user['confirmed'].",
                        'hash' => '".$user['hash']."'
                    ),";
                }
        $template .= ");?>";
        return $template;
    }

    /**
    * Checks if the user exists
    * @param $email string
    * @param $password string
    * @return array if exists, otherwise false
    **/
    public function auth($email, $password) {
        // the local storage for users  credentials
        $dbFile = __DIR__ . '/../db/users.php';
        if (file_exists($dbFile)) {
            $users = include($dbFile);
        }

        // check if user exists
        return (isset($users[$email]) && $users[$email]['password'] == md5($password) ? $users[$email] : false);
    }

    /**
    * Checks if the user exists, if yes, confirms it
    * @param $hash string
    * @return boolean
    **/
    public function confirm($hash) {
        // the local storage for users  credentials
        $dbFile = __DIR__ . '/../db/users.php';
        if (file_exists($dbFile)) {
            $users = include($dbFile);
            foreach ($users as $email => $user) {
                if ($user['confirmed'] == false && $user['hash'] == $hash) {
                    $users[$email]['confirmed'] = true;
                    break;
                }
            }
        }

        $template = $this->prepareDbTemplate($users);
        return file_put_contents($dbFile, $template);
    }

    /**
    * Checks if the user is logged into the app
    * @return boolean
    **/
    public function isLogged() {
        return isset($_COOKIE['user']['is_logged']) ? $_COOKIE['user']['is_logged'] : false;
    }

    /**
    * Sets the flash message to cookie
    * @return boolean
    **/
    public function setFlash($string) {
        $ttl = time()+3600;
        setcookie('user[flash]', $string, $ttl);
        return true;
    }

    /**
    * Returns the flash message
    * @return string
    **/
    public function getFlash() {
        $flash = isset($_COOKIE['user']['flash']) ? $_COOKIE['user']['flash'] : false;
        setcookie('user[flash]', false);
        return $flash;
    }

    /**
    * Destroy the cookie
    * @return boolean
    **/
    public function logout() {
        setcookie('user[is_logged]', false);
        setcookie('user[name]', false);
        setcookie('user[confirmed]', false);
        return true;
    }

    /**
    * Return the information about currently logged user
    * @return array or false if not found
    **/
    public function getData() {
        if ($this->isLogged()) {
            return $_COOKIE['user'];
        }
        return false;
    }

    /**
    * Login the user into the app
    * @param $params array
    * @return boolean
    **/
    public function login(array $user) {
        // if account is not confirmed don't go further
        if (!$user['confirmed']) return false;

        $ttl = time()+3600;
        setcookie('user[is_logged]', true, $ttl);
        setcookie('user[name]', $user['name'], $ttl);
        setcookie('user[confirmed]', $user['confirmed'], $ttl);
        return true;
    }

}

?>