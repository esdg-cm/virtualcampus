<?php
/**
 * dFramework
 *
 * The simplest PHP framework for beginners
 * Copyright (c) 2019, Dimtrov Sarl
 * This content is released under the Mozilla Public License 2 (MPL-2.0)
 *
 * @package	    dFramework
 * @author	    Dimitri Sitchet Tomkeu <dev.dimitrisitchet@gmail.com>
 * @copyright	Copyright (c) 2019, Dimtrov Sarl. (https://dimtrov.hebfree.org)
 * @copyright	Copyright (c) 2019, Dimitri Sitchet Tomkeu. (https://www.facebook.com/dimtrovich)
 * @license	    https://opensource.org/licenses/MPL-2.0 MPL-2.0 License
 * @link	    https://dimtrov.hebfree.org/works/dframework
 * @version     3.0
 */


namespace dFramework\core\cli;

use Ahc\Cli\Input\Command;
use Ahc\Cli\IO\Interactor;
use Ahc\Cli\Output\Color;
use Ahc\Cli\Output\Writer;
use lessc;

/**
 * Less
 *
 *
 * @package		dFramework
 * @subpackage	Core
 * @category    Cli
 * @author		Dimitri Sitchet Tomkeu <dev.dimitrisitchet@gmail.com>
 * @since       3.0
 * @file        /system/core/cli/Less.php
 */
class Less extends Command
{
    public function __construct()
    {
        parent::__construct('less', 'Gestionnaire de fichier LESS');

        $this
            ->option('-c --compile', 'Compile un fichier LESS en fichier CSS')
            ->option('-u --uglify', 'Transforme un fichier CSS valide en fichier LESS')
            // Usage examples:
            ->usage(
                '<bold>  dbot less -c style</end> <comment> => Compile le fichier "/public/less/style.less" en fichier "/public/css/style.css"</end><eol/>' .
                '<bold>  dbot less -u template</end> <comment> => Transforme le fichier "/public/css/template.css" en fichier "/public/less/template.less"</end><eol/>' 
            );
    }

    // This method is auto called before `self::execute()` and receives `Interactor $io` instance
    public function interact(Interactor $io)
    {
        $color = new Color;

        if(!$this->compile AND !$this->uglify)
        {
            echo $color->warn('Veuillez choisir le type de processus a lancer.');
            $this->showHelp();
        }
        // Collect missing opts/args
        if ($this->app) {
            $this->set('app', $io->prompt('Entrer le dossier des classes a mapper'));
        }
    }
    public function execute()
    {
        try{
            if($this->compile) {
                $less = new lessc();
            } 
            

        }
        catch(\Exception $e) { }
        
        return true;
    }
}