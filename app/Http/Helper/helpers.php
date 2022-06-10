<?php

use Illuminate\Support\Str;

function canView(string $permission): bool
{
    $permissions = auth()->user()->getPermissionsViaRoles();
    $permissions = $permissions->filter(function ($p) use ($permission) {
        return Str::startsWith($p->name, $permission);
    });

    return boolval($permissions->count());
}

function can(string $permission): void
{
    $flag = auth()->user()->can($permission);
    if (!$flag) abort(403, 'Usted no tiene permisos para realizar esta acción.');
}


function format_date_month(string $date)
{
    if ($date) {
        setlocale(LC_ALL, "es_ES", 'Spanish_Spain', 'Spanish');
        return iconv('ISO-8859-2', 'UTF-8', strftime("%d de %b de %Y", strtotime($date)));
    } else {
        return '-';
    }
}

function format_datetime_pretty(string $date)
{

    if ($date) {
        setlocale(LC_ALL, "es_ES", 'Spanish_Spain', 'Spanish');
        return iconv('ISO-8859-2', 'UTF-8', strftime("%A, %d de %B de %Y a las %T", strtotime($date)));
    } else {
        return '-';
    }
}