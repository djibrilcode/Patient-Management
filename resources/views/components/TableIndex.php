<?php 
namespace App\View\Components;

use Illuminate\View\Component;

class TableIndex extends Component
{
    public string $title;
    public string $icon;
    public string $routePrefix;
    public string $addLabel;
    public array $headers;
    public array $columns;
    public $rows;

    public function __construct($title, $icon, $routePrefix, $addLabel, $headers, $columns, $rows)
    {
        $this->title = $title;
        $this->icon = $icon;
        $this->routePrefix = $routePrefix;
        $this->addLabel = $addLabel;
        $this->headers = $headers;
        $this->columns = $columns;
        $this->rows = $rows;
    }

    public function render()
    {
        return view('components.table-index');
    }
}
 
