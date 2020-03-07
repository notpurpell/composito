<?php

namespace Composito\Test;

use Composito\Traits\HasCompositePrimaryKey;
use Illuminate\Database\Eloquent\Model;

class Foo extends Model
{
    use HasCompositePrimaryKey;

    /**
     * Indicates if the IDs are auto-incrementing.
     * @var bool
     */
    public $incrementing = false;

    /**
     * The primary keys of the model.
     * @var array
     */
    protected $primaryKey = [ "primary_one", "primary_two" ];

    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = "foos";

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        "primary_one",
        "primary_two",
        "text"
    ];
}