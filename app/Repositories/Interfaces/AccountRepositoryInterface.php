<?php


namespace App\Repositories\Interfaces;
use Illuminate\Database\Eloquent\Model;


interface AccountRepositoryInterface extends RepositoryInterface
{
    public function deposit(Model $model, $newBalance);
}
