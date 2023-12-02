<?php

namespace App\Repositories\Eloquents;

use App\Models\Student;
use App\Repositories\Contracts\StudentInterface;

class StudentRepository extends BaseRepository implements StudentInterface
{
    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return 'App\Models\Student';
    }
}
