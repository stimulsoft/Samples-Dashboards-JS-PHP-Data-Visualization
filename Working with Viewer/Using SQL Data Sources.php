<?php
require_once '../vendor/autoload.php';

use Stimulsoft\Events\StiDataEventArgs;
use Stimulsoft\Report\StiReport;
use Stimulsoft\Viewer\StiViewer;


// Creating a viewer object and set the necessary javascript options
$viewer = new StiViewer();
$viewer->javascript->relativePath = '../';
$viewer->javascript->appendHead('<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">');

// Defining viewer events before processing
// It is allowed to assign a PHP function, or the name of a JavaScript function, or a JavaScript function as a string
// Also it is possible to add several functions of different types using the append() method
$viewer->onBeginProcessData = function (StiDataEventArgs $args) {
    // In this event, it is possible to handle the data request, and replace the connection parameters

    // You can change the connection string
    // This example uses the 'Northwind' SQL database, it is located in the 'Data' folder
    // You need to import it and correct the connection string to your database
    if ($args->connection == 'MySQL')
        $args->connectionString = 'Server=localhost; Database=northwind; UserId=root; Pwd=;';

    // You can change the SQL query
    if ($args->dataSource == 'MyDataSource')
        $args->queryString = 'SELECT * FROM MyTable';

    // You can change the SQL query parameters with the required values
    // For example: SELECT * FROM @Parameter1 WHERE Id = @Parameter2 AND Date > @Parameter3
    if ($args->dataSource == 'MyDataSourceWithParams') {
        $args->parameters['Parameter1']->value = 'TableName';
        $args->parameters['Parameter2']->value = 10;
        $args->parameters['Parameter3']->value = '2019-01-20';
    }
};

// Processing the request and, if successful, immediately printing the result
$viewer->process();

// Creating a report object
$report = new StiReport();

// Loading a dashboard by URL
// This method does not load the report object on the server side, it only generates the necessary JavaScript code
// The dashboard will be loaded into a JavaScript object on the client side
$report->loadFile('../reports/ManufacturingSQL.mrt');

// Assigning a report object to the viewer
$viewer->report = $report;

// Displaying the visual part of the viewer as a prepared HTML page
$viewer->printHtml();
