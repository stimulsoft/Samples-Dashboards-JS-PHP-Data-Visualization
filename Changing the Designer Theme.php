<?php
require_once 'vendor/autoload.php';

use Stimulsoft\Designer\Enums\StiDesignerTheme;
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
    <title>Changing the Designer Theme</title>
    <style>
        html, body {
            font-family: sans-serif;
            background: black;
        }
    </style>

    <?php
    /** https://www.stimulsoft.com/en/documentation/online/programming-manual/index.html?reports_and_dashboards_for_php_deployment.htm */
    $js = new StiJavaScript(StiComponentType::Designer);
    $js->renderHtml();
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
        $options->appearance->theme = StiDesignerTheme::Office2022BlackGreen;

        /** https://www.stimulsoft.com/en/documentation/online/programming-manual/index.html?reports_and_dashboards_for_php_web_designer_deployment.htm */
        $designer = new StiDesigner($options);

        /** https://www.stimulsoft.com/en/documentation/online/programming-manual/index.html?reports_and_dashboards_for_php_web_designer_creating_editing_report.htm */
        $report = new StiReport();
        $report->loadFile('reports/SalesOverview.mrt');
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