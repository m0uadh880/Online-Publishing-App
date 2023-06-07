<?php
require_once 'Repository.php';
class UserRepository extends Repository
{
    public function __construct()
    {
        parent::__construct('user');
    }

}