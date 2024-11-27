<?php
require_once '../vendor/autoload.php';

use Stimulsoft\Report\StiReport;
use Stimulsoft\Viewer\Enums\StiViewerTheme;
use Stimulsoft\Viewer\StiViewer;


// Creating a viewer object and set the necessary javascript options
$viewer = new StiViewer();
$viewer->javascript->useRelativeUrls = false;
$viewer->javascript->appendHead('<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">');

// Configuring the viewer options object
$viewer->options->appearance->fullScreenMode = true;
$viewer->options->appearance->backgroundColor = 'black';
$viewer->options->appearance->theme = StiViewerTheme::Office2022BlackTeal;
$viewer->options->toolbar->showFullScreenButton = false;

// Processing the request and, if successful, immediately printing the result
$viewer->process();

// Creating a report object
$report = new StiReport();

// Loading a dashboard by URL
// This method does not load the report object on the server side, it only generates the necessary JavaScript code
// The dashboard will be loaded into a JavaScript object on the client side
$report->loadFile('../reports/SalesOverview.mrt');

// Assigning a report object to the viewer
$viewer->report = $report;

// Displaying the visual part of the viewer as a prepared HTML page
$viewer->printHtml();
