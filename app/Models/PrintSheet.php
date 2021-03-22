<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintSheet extends Model
{
    use HasFactory;

    public $table = 'print_sheet';

    protected $primaryKey = 'ps_id';

    protected $fillable = [
        'type',
        'sheet_url'
    ];

    public function print_sheet_items()
    {
        return $this->hasMany(PrintSheetItems::class, 'ps_id');
    }

    public function format()
    {
        return [
            'id' => $this->ps_id,
            'type' => $this->type,
            'print_sheet_items' => $this->print_sheet_items
        ];
    }
}
