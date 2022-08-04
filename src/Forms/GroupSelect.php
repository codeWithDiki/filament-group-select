<?php

namespace Codewithdiki\FilamentGroupSelect\Forms;

use Illuminate\Support\Collection;


class GroupSelect extends \Filament\Forms\Components\Field
{
    use \Filament\Forms\Components\Concerns\HasOptions;

    protected string $view = "filament-group-select::forms.group-select";

    public static function setAttribute(string $name, array|\Closure|Collection $groups)
    {
        $static = self::make($name);

        $static->options($groups);

        return $static;
    }

    public function getGroups() : array|Collection
    {
        $groups = $this->evaluate(self::$groups);
        
        return $groups;
    }
}