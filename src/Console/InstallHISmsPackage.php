<?php

namespace Ibtdi\HiSms\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

/**
 * Class InstallHISmsPackage
 */
class InstallHISmsPackage extends Command
{
    /**
     * @var string
     */
    protected $signature = 'hisms:install';

    /**
     * @var string
     */
    protected $description = 'Install the HiSmsPackage';

    /**
     * handle method
     */
    public function handle(): void
    {
        $this->info('Installing HiSmsPackage...');

        $this->info('Publishing configuration...');

        if (!$this->configExists('hisms.php')) {
            $this->publishConfiguration();
            $this->info('Published configuration');
        } elseif ($this->shouldOverwriteConfig()) {
            $this->info('Overwriting configuration file...');
            $this->publishConfiguration($force = true);
        } else {
            $this->info('Existing configuration was not overwritten');
        }

        $this->info('Installed HiSmsPackage');
    }

    /**
     * @param $fileName
     * @return bool
     */
    private function configExists($fileName):bool
    {
        return File::exists(config_path($fileName));
    }

    /**
     * @return bool
     */
    private function shouldOverwriteConfig(): bool
    {
        return $this->confirm(
            'Config file already exists. Do you want to overwrite it?',
            false
        );
    }

    /**
     * @param  false  $forcePublish
     * @return void
     */
    private function publishConfiguration(bool $forcePublish = false): void
    {
        $params = [
            '--provider' => "Ibtdi\HiSms\HISmsServiceProvider",
            '--tag' => "config"
        ];

        if ($forcePublish === true) {
            $params['--force'] = true;
        }

        $this->call('vendor:publish', $params);
    }
}
