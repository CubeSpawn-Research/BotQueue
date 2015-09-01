<?php
/*
	This file is part of BotQueue.

	BotQueue is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	BotQueue is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with BotQueue.  If not, see <http://www.gnu.org/licenses/>.
  */


namespace App\Providers;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Hashing\Hasher;

class LegacyUserProvider implements UserProvider
{
	public function __construct(Hasher $hasher, $model)
	{
		$this->hasher = $hasher;
		$this->model = $model;
	}

	/**
	 * Retrieve a user by their unique identifier.
	 *
	 * @param  mixed $identifier
	 * @return \Illuminate\Contracts\Auth\Authenticatable|null
	 */
	public function retrieveById($identifier)
	{
		return $this->createModel()->newQuery()->find($identifier);
	}

	/**
	 * Retrieve a user by by their unique identifier and "remember me" token.
	 *
	 * @param  mixed $identifier
	 * @param  string $token
	 * @return \Illuminate\Contracts\Auth\Authenticatable|null
	 */
	public function retrieveByToken($identifier, $token)
	{
		$model = $this->createModel();

		return $model->newQuery()
			->where($model->getKeyName(), $identifier)
			->where($model->getRememberTokenName(), $token)
			->first();
	}

	/**
	 * Update the "remember me" token for the given user in storage.
	 *
	 * @param  \Illuminate\Contracts\Auth\Authenticatable $user
	 * @param  string $token
	 * @return void
	 */
	public function updateRememberToken(Authenticatable $user, $token)
	{
		$user->setRememberToken($token);

		$user->save();
	}

	/**
	 * Retrieve a user by the given credentials.
	 *
	 * @param  array $credentials
	 * @return \Illuminate\Contracts\Auth\Authenticatable|null
	 */
	public function retrieveByCredentials(array $credentials)
	{
		$query = $this->createModel()->newQuery();

		foreach ($credentials as $key => $value) {
			if(!str_contains($key, 'password')) $query->where($key, $value);
		}

		return $query->first();

	}

	/**
	 * Validate a user against the given credentials.
	 *
	 * @param  \Illuminate\Contracts\Auth\Authenticatable $user
	 * @param  array $credentials
	 * @return bool
	 */
	public function validateCredentials(Authenticatable $user, array $credentials)
	{
		$plain = $credentials['password'];

		if($this->isLegacyPassword($user, $plain)) {
			// Update the old password to the new one
			$this->updateLegacyPassword($user, $plain);
			return true;
		}
		else
		{
			return $this->hasher->check($plain, $user->getAuthPassword());
		}
	}

	/**
	 * @return \App\Models\User
	 */
	private function createModel()
	{
		$class = '\\'.ltrim($this->model, '\\');

		return new $class;
	}

	private function isLegacyPassword(Authenticatable $user, $plain)
	{
		return sha1($plain) === $user->getAuthPassword();
	}

	private function updateLegacyPassword($user, $plain)
	{
		$user->password = $this->hasher->make($plain);
		$user->save();
	}
}