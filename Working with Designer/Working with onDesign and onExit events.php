<?php
require_once '../vendor/autoload.php';

use Stimulsoft\Designer\StiDesigner;
use Stimulsoft\Report\StiReport;
use Stimulsoft\Viewer\Enums\StiToolbarDisplayMode;
use Stimulsoft\Viewer\StiViewer;


// Getting the current action
$action = $_GET['action'] ?? 'view';

// Creating a viewer or designer object, defining events and options before processing
if ($action == 'design') {
    $component = new StiDesigner();
    $component->onExit = 'designerExit';
    $component->options->appearance->fullScreenMode = true;
    $component->options->toolbar->showFileMenuExit = true;
}
else {
    $component = new StiViewer();
    $component->onDesignReport = 'viewerDesign';
    $component->options->appearance->fullScreenMode = true;
    $component->options->toolbar->showFullScreenButton = false;
    $component->options->toolbar->showDesignButton = true;
}

// Set the necessary javascript options
$component->javascript->useRelativeUrls = false;

// Processing the request and, if successful, immediately printing the result
$component->process();

// Creating a report object
$report = new StiReport();

// Loading a dashboard by URL
// This method does not load the report object on the server side, it only generates the necessary JavaScript code
// The dashboard will be loaded into a JavaScript object on the client side
$report->loadFile('../reports/Christmas.mrt');

// Assigning a report object to the component
$component->report = $report;
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    <title>Working with onDesign and onExit events</title>
    <style>
        html, body {
            font-family: sans-serif;
        }
    </style>

    <?php
    // Rendering the necessary JavaScript code of the component
    $component->javascript->renderHtml();
    ?>

    <script>
        // The function will be called after clicking the Design button on the viewer panel
        function viewerDesign(args) {

            // Redirect to the dashboard designer page
            window.location.href = '?action=design';
        }

        // The function will be called after clicking the Exit item in the designer menu
        function designerExit(args) {

            // Redirect to the dashboard viewer page
            window.location.href = '?action=view';
        }
    </script>
</head>
<body>
<?php
// Rendering the visual HTML part of the component
$component->renderHtml();
?>
</body>
</html>
