import preset from './vendor/filament/support/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './resources/views/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './vendor/thethunderturner/filament-latex/{resources,src}/{views,}/**/*.{blade.php,php}',
    ],
}
