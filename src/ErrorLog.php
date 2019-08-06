<?php

namespace Axstarzy\LaravelLibrary;

use Illuminate\Database\Eloquent\Model;

class ErrorLog extends Model
{
	protected $table = 'error_log';

    protected $guarded = [];
}
