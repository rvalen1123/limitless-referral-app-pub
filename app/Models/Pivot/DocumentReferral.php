<?php

namespace App\Models\Pivot;

use Illuminate\Database\Eloquent\Relations\Pivot;

class DocumentReferral extends Pivot
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pivot_documents_referrals';
}
