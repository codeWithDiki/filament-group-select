<?php

namespace Codewithdiki\FilamentGroupSelect\Forms;

use Illuminate\Support\Collection;


class GroupSelect extends \Filament\Forms\Components\Field
{
    protected string $view = "filament-group-select::forms.group-select";

    protected static array|\Closure|Collection $groups;

    public static function setAttribute(string $name, array|\Closure|Collection $groups)
    {
        $static = app(static::class, [
            'name' => $name
        ]);
        $static->configure();

        self::$groups = $groups;

        return $static;
    }

    public function getGroups() : array|Collection
    {
        $groups = $this->evaluate(self::$groups);
        
        return $groups;
    }
}