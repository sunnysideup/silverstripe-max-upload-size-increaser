<?php

namespace Sunnysideup\MaxUploadSizeIncreaser;
use SilverStripe\Assets\File;
use SilverStripe\Dev\BuildTask;
use SilverStripe\AssetAdmin\Controller\AssetAdmin;
use SilverStripe\Core\Config\Config;

class MaxUploadSizeTester extends BuildTask
{
    protected $title = 'Check Max File Upload Size';

    protected $description = 'Test all the settings required for large uploads.';

    public function run($request)
    {
        echo '<h1>INI File</h1>';
        echo php_ini_loaded_file();

        echo '<h1>upload_max_filesize (set in INI file)</h1>';
        echo $this->phpFileSizeFormatted(ini_get('upload_max_filesize'));

        echo '<h1>post_max_size (set in INI file)</h1>';
        echo $this->phpFileSizeFormatted(ini_get('post_max_size'));

        echo '<h1>Assets Settings ('.AssetAdmin::class.'::max_upload_size)</h1>';
        echo $this->phpFileSizeFormatted(Config::inst()->get(AssetAdmin::class, 'max_upload_size'));

        echo '<h1>Also see .htaccess file in this module</h1>';
    }

    protected function phpFileSizeFormatted($mixed) : string
    {
        return File::format_size(File::ini2bytes($mixed));
    }
}
