<?php

namespace App\Repositories\Eloquents;

use App\Models\Partner;
use App\Repositories\Contracts\PartnerInterface;

class PartnerRepository extends BaseRepository implements PartnerInterface
{
    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return 'App\Models\Partner';
    }
}
