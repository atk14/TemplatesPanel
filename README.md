TemplatesPanel
==============

A panel for Tracy Debugger in an ATK14 application. Displays nested list of all rendered templates.

Basic usage
-----------

    $bar = Tracy\Debugger::getBar();
    $bar->addPanel(new TemplatesPanel());

Usage in an ATK14 application (built upon Atk14Skelet)
------------------------------------------------------

Use the Composer to install the panel.

    cd path/to/your/atk14/project/
    composer require atk14/templates-panel

Load autoloader from the Composer and enable the Tracy Debugger.

    // file: lib/load.php
    require(__DIR__."/../vendor/autoload.php");

    if(
      !TEST &&
      !$HTTP_REQUEST->xhr() &&
      php_sapi_name()!="cli" // we do not want Tracy in cli
    ){
      Tracy\Debugger::enable(PRODUCTION, __DIR__ . '/../log/');
    }

Add the TemplatesPanel to the Tracy in \_application_after_filter().

    // file: app/controllers/application_base.php
    function _application_after_filter(){
      if(DEVELOPMENT){
        $bar = Tracy\Debugger::getBar();
        $bar->addPanel(new TemplatesPanel($this->dbmole));
      }
    }

Licence
-------

TemplatesPanel is free software distributed [under the terms of the MIT license](http://www.opensource.org/licenses/mit-license)
