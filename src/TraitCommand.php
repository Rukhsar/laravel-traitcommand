<?php

namespace Rukhsar\TraitCommand;

use Illuminate\Console\Command;

class TraitCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:trait
                           {TraitName : the name of the trait}
                           {TraitFolder? : the location of the trait}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A laravel artisan command to generate trait quickly.';


    public $inputs = [];

    public $folderPath;

    public $newFilePath;

    public $newFileName;


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->setInputsFromArtisan();

        if ( $this->makeTraitDirectory()->makeTraitFile() )
        {

                $this->sendSuccessMessage();

            return;
       }

        $this->error('Oops, something went wrong during creating command!');
    }

    private function makeTraitDirectory()
    {
        if ( !file_exists(base_path($this->folderPath)))
        {
            mkdir(base_path($this->folderPath));
        }
        return $this;
    }

    private function makeTraitFile()
    {
        $txt = $this->traitStub();

        $handle = fopen($this->newFilePath, "w");

        fwrite($handle, $txt);

        fclose($handle);

        return $this;

    }

    private function setInputsFromArtisan()
    {
        // sets inputs from the artisan command line arguments
        $this->inputs = $this->argument();

        $this->folderPath = 'app/' . $this->inputs['TraitFolder'];

        $this->newFileName = $this->inputs['TraitName'] . '.php';

        $this-> newFilePath = base_path($this->folderPath) . '/' . $this->inputs['TraitName'] . '.php';

    }

    private function traitStub()
    {
        $phpOpenTag = "<?php\n\n";

        $comment = "// Trait created using make:trait command \n\n";

        $nameSpace = "namespace App\\" . $this->inputs['TraitFolder'] . ';' . "\n\n";

        $traitDeclaration = "trait " . $this->inputs['TraitName'] . "\n" . "{\n\n}";

        return $phpOpenTag . $comment .$nameSpace . $traitDeclaration;

    }

    private function sendSuccessMessage()
    {
        $this->info($this->newFileName . ' successfully created');
    }

}
