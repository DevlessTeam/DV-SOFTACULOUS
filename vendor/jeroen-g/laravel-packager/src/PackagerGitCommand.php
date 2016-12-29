<?php

namespace JeroenG\Packager;

use Illuminate\Console\Command;
use JeroenG\Packager\PackagerHelper;

/**
 * Get an existing package from a remote Github repository with its git repository.
 *
 * @package Packager
 * @author JeroenG
 * 
 **/
class PackagerGitCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'packager:git
                            {url : The url of the Github repository}
                            {vendor? : The vendor part of the namespace}
                            {name? : The name of package for the namespace}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieve an existing package from Github with git.';

    /**
     * Packager helper class.
     * @var object
     */
    protected $helper;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(PackagerHelper $helper)
    {
        parent::__construct();
        $this->helper = $helper;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Start the progress bar
        $bar = $this->helper->barSetup($this->output->createProgressBar(5));
        $bar->start();

        // Common variables
        $source = $this->argument('url');
        $origin = rtrim(strtolower($source), '/');
        $pieces = explode('/', $origin);
        if (is_null($this->argument('vendor')) or is_null($this->argument('name'))) {
            $vendor = $pieces[3];
            $name = $pieces[4];
        } else {
            $vendor = $this->argument('vendor');
            $name = $this->argument('name');
        }
        $path = getcwd().'/packages/';
        $fullPath = $path.$vendor.'/'.$name;
        $requirement = '"psr-4": {
            "'.$vendor.'\\\\'.$name.'\\\\": "packages/'.$vendor.'/'.$name.'/src",';
        $appConfigLine = 'App\Providers\RouteServiceProvider::class,

        '.$vendor.'\\'.$name.'\\'.$name.'ServiceProvider::class,';

        // Start creating the package
        $this->info('Creating package '.$vendor.'\\'.$name.'...');
            $this->helper->checkExistingPackage($path, $vendor, $name);
        $bar->advance();

        // Create the package directory
        $this->info('Creating packages directory...');
            $this->helper->makeDir($path);
        $bar->advance();

        // Create the vendor and package directory
        $this->info('Creating vendor...');
            $this->helper->makeDir($fullPath);
        $bar->advance();

        // Clone the repository
        $this->info('Cloning repository...');
            exec("git clone $source $fullPath");
        $bar->advance();

        // Add it to composer.json
        $this->info('Adding package to composer and app...');
            $this->helper->replaceAndSave(getcwd().'/composer.json', '"psr-4": {', $requirement);
            // And add it to the providers array in config/app.php
            $this->helper->replaceAndSave(getcwd().'/config/app.php', 'App\Providers\RouteServiceProvider::class,', $appConfigLine);
        $bar->advance();

        // Finished creating the package, end of the progress bar
        $bar->finish();
        $this->info('Package created successfully!');
        $this->output->newLine(2);
        $bar = null;
    }
}
