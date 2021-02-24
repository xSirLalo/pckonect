<?php

namespace App\Policies;

use App\Models\CyberControl;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CyberControlPolicy
{
	use HandlesAuthorization;

	/**
	 * Create a new policy instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
	}

	public function owner(User $user, CyberControl $cyberControl)
	{
		if ($cyberControl->status == 1) {
			return true;
		} else {
			return false;
		}

		return true;
	}

	public function used(User $user, CyberControl $cyberControl)
	{
		if ($cyberControl->user_id) {
			return true;
		} else {
			return true;
		}
	}
}
