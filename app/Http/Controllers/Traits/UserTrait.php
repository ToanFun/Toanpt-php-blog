<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Support\Facades\DB;
use App\Models\User;

trait UserTrait
{
  public function create(array $data): bool
  {
    $user = User::create($data);
    return true;
  }
}
