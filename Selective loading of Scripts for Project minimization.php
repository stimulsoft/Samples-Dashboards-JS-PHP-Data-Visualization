<?php
require_once 'vendor/autoload.php';

use Stimulsoft\Designer\StiDesigner;
use Stimulsoft\Designer\StiDesignerOptions;
use Stimulsoft\Enums\StiComponentType;
use Stimulsoft\Report\StiReport;
use Stimulsoft\StiHandler;
use Stimulsoft\StiJavaScript;

?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>Selective loading of Scripts for Project minimization</title>
    <style>
        html, body {
            font-family: sans-serif;
        }
    </style>
    
    <?php
    /** https://www.stimulsoft.com/en/documentation/online/programming-manual/index.html?reports_and_dashboards_for_php_engine_optimazing_scripts_loading.htm */
    $helper = new StiJavaScript(StiComponentType::Designer);

    $helper->options->reports = false;
    $helper->options->blocklyEditor = false;
    $helper->options->reportsChart = true;
    $helper->options->reportsExport = true;
    $helper->options->reportsImportXlsx = false;
    $helper->options->reportsMaps = false;

    $helper->packed = true;
    $helper->renderHtml();
    ?>

    <script type="text/javascript">
        <?php
        $handler = new StiHandler();
        //$handler->license->setKey('6vJhGtLLLz2GNviWmUTrhSqnO...');
        //$handler->license->setFile('license.key');
        $handler->renderHtml();

        /** https://www.stimulsoft.com/en/documentation/online/programming-manual/index.html?reports_and_dashboards_for_php_web_designer_settings.htm */
        $options = new StiDesignerOptions();
        $options->appearance->fullScreenMode = true;

        /** https://www.stimulsoft.com/en/documentation/online/programming-manual/index.html?reports_and_dashboards_for_php_web_designer_deployment.htm */
        $designer = new StiDesigner($options);

        /** https://www.stimulsoft.com/en/documentation/online/programming-manual/index.html?reports_and_dashboards_for_php_web_designer_creating_editing_report.htm */
        $report = new StiReport();
        $report->loadFile('reports/Christmas.mrt');
        $designer->report = $report;
        ?>

        function onLoad() {
            <?php
            $designer->renderHtml('designerContent');
            ?>
        }
    </script>
</head>
<body onload="onLoad();">
<div id="designerContent"></div>
</body>
</html>