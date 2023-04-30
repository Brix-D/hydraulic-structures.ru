<?php

namespace App\Http\Objects;

class PumpState {
    private const WORKING = 'working';
    private const DISABLED = 'disabled';
    private const BROKEN = 'broken';

    private const WORKING_TEXT = 'В работе';
    private const DISABLED_TEXT = 'Отключен';
    private const BROKEN_TEXT = 'Неисправен';

    private const STATES = [
        self::WORKING => self::WORKING_TEXT,
        self::DISABLED => self::DISABLED_TEXT,
        self::BROKEN => self::BROKEN_TEXT,
    ];


    public static function values()
    {
        return [self::WORKING, self::DISABLED, self::BROKEN];
    }

    public static function all()
    {
        return self::STATES;
    }

    public static function getStateText(string $alias)
    {
        return self::STATES[$alias];
    }

    public static function working()
    {
        return self::WORKING;
    }

    public static function disabled()
    {
        return self::DISABLED;
    }

    public static function broken()
    {
        return self::BROKEN;
    }
}