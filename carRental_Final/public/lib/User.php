<?php

class User {
	private $_db, $_data, $_session_name, $_cookie_name, $_is_logged_in;

	public function __construct($user = null) {
		$this->_db = DB::getInstance();
		$this->_session_name = Config::get('session/session_name');
		$this->_cookie_name = Config::get('remember/cookie_name');

		if ( ! $user) {
			if (Session::exists($this->_session_name)) {
				$user = Session::get($this->_session_name);

				if ($this->find($user))
					$this->_is_logged_in = true;
				else
					$this->logout();
			}
		} else {
			$this->find($user);
		}
	}

	public function create($fields = array()) {
		if ( ! $this->_db->insert('users', $fields))
			throw new Exception('There was a problem creating an account.');
	}

	public function update($fields = array(), $id = null) {
		if ( ! $id && $this->isLoggedIn())
			$id = $this->data()->user_id;

		if ( ! $this->_db->update('users', $id, $fields))
			throw new Exception('There was a problem updating.');
	}

	public function find($user = null) {
		if ($user) {
			$field = (is_numeric($user)) ? 'user_id' : 'username';
			$data = $this->_db->get('users', array($field, '=', $user));

			if ($data->count()) {
				$this->_data = $data->first();
				return true;
			}
		}

		return false;
	}

	public function login($username = null, $password = null) {
		if ( ! $username && ! $password && $this->exists()) {
			Session::put($this->_session_name, $this->data()->user_id);
		} else {
			$user = $this->find($username);

			if ($user) {
				// if ($this->data()->password == Hash::make($password)) {
				if ($this->data()->role === 'admin' && $this->data()->status === 'active') {
					if ($this->data()->password == $password) {
						Session::put($this->_session_name, $this->data()->user_id);

						return 'true';
					}
				} else {
					return 'not valid';
				}
			}
		}

		return 'false';
	}

	public function logout() {
		$this->_db->delete('users_session', array('user_id', '=', $this->data()->user_id));

		Session::delete($this->_session_name);
		// Cookie::delete($this->_cookie_name);
	}

	public function lock() {
		$this->logout();
	}

	public function unlock($username = null, $password = null) {
		return $this->login($username, $password);
	}

	public function data() {
		return $this->_data;
	}

	public function isLoggedIn() {
		return $this->_is_logged_in;
	}

	public function exists() {
		return ( ! empty($this->_data)) ? true : false;
	}

	public function isRole($key) {
		$user = $this->_db->get('users', array('user_id', '=', $this->data()->user_id));

		if ($user->count()) {
			$role = $user->first()->role;

			if ($role == $key)
				return true;
		}

		return false;
	}
}
