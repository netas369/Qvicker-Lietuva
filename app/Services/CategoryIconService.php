<?php

namespace App\Services;

class CategoryIconService
{
    private static $icons = [
        'Namų priežiūra ir valymas' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 40" class="w-16 h-16 mx-auto" fill="currentColor">...</svg>',
        'Transporto paslaugos' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" class="w-16 h-16 mx-auto" fill="currentColor">...</svg>',
        // ... Add all other category icons here
    ];

    public static function getIcon(string $categoryName): string
    {
        return self::$icons[$categoryName] ?? self::getDefaultIcon();
    }

    private static function getDefaultIcon(): string
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"/></svg>';
    }

    public static function getAllIcons(): array
    {
        return self::$icons;
    }
}
