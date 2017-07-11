<?php

use App\Models\Permission;
use App\Models\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class InitialData extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Log::info('Running Data Seeder');

		$administrator = new Role();
		$administrator->name = 'administrator';
		$administrator->display_name = 'System Administrator';
		$administrator->description = 'Administrator';
		$administrator->save();

		$user = new Role();
		$user->name = 'user';
		$user->display_name = 'System User';
		$user->description = 'User';
		$user->save();

		$administratorPermission = new Permission();
		$administratorPermission->name = 'all';
		$administratorPermission->display_name = 'System Administrator Permission';
		$administratorPermission->description = 'Grant Full Access';
		$administratorPermission->save();

		$userPermission = new Permission();
		$userPermission->name = 'restricted';
		$userPermission->display_name = 'User Permission';
		$userPermission->description = 'Restricted Access';
		$userPermission->save();

		$administrator->attachPermission($administratorPermission);
		$user->attachPermission($userPermission);

		$adminAccount = User::create([
			'name' => 'System Administrator',
			'email' => 'admin@test.com',
			'password' => bcrypt('123456'),
		]);

		$userAccount = User::create([
			'name' => 'User',
			'email' => 'user@test.com',
			'password' => bcrypt('123456'),
		]);

		$adminAccount->attachRole($administrator);
		$userAccount->attachRole($user);

		Log::info('Seeding data to database finished :)');
	}
}
