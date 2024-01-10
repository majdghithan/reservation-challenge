import preset from '../../../../vendor/filament/filament/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        "./vendor/statikbe/laravel-filament-chained-translation-manager/**/*.blade.php",
        "./node_modules/flowbite/**/*.js",
        "./resources/**/*.js",
        "./resources/**/*.css",
        "./resources/**/*.blade.php",
        "./resources/**/*.vue",
    ],
}
