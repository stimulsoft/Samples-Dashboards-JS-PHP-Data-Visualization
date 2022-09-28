<?php
require_once '../stimulsoft/helper.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
	<title>Sending an Exported Dashboard to the Server-Side</title>
	<style>html, body { font-family: sans-serif; }</style>

	<script src="../scripts/stimulsoft.reports.js" type="text/javascript"></script>
	<script src="../scripts/stimulsoft.dashboards.js" type="text/javascript"></script>
	<script src="../scripts/stimulsoft.viewer.js" type="text/javascript"></script>
	
	<?php
		// Creating the events handler for this example
		// Documentation: https://www.stimulsoft.com/en/documentation/online/programming-manual/index.html?reports_and_dashboards_for_php_engine_php_handler.htm
		StiHelper::init('Sending%20an%20Exported%20Dashboard%20to%20the%20Server-Side%20Handler.php', 30);
	?>
	
	<script type="text/javascript">
		var options = new Stimulsoft.Viewer.StiViewerOptions();
		options.appearance.fullScreenMode = true;
		options.appearance.scrollbarsMode = true;
		options.toolbar.displayMode = Stimulsoft.Viewer.StiToolbarDisplayMode.Separated;
		options.height = "600px"; // Height for non-fullscreen mode
		
		var viewer = new Stimulsoft.Viewer.StiViewer(options, "StiViewer", false);
		
		// Sending the exported dashboard to the server-side.
		// Documentation: https://www.stimulsoft.com/en/documentation/online/programming-manual/index.html?reports_and_dashboards_for_php_web_viewer_export.htm
		viewer.onEndExportReport = function (args) {
			// Current export format
			var format = args.format;
			// File name of the exported dashboard
			var fileName = args.fileName;
			// Exported binary data
			var data = args.data;

			// Prevent built-in handler, which saves the exported dashboard as a file
			args.preventDefault = true;
			
			// Calling the server-side handler
			Stimulsoft.Helper.process(args);
		}
		
		var dashboard = Stimulsoft.Report.StiReport.createNewDashboard();
		dashboard.loadFile("../reports/Christmas.mrt");
		viewer.report = dashboard;
		
		function onLoad() {
			viewer.renderHtml("viewerContent");
		}
	</script>
</head>
<body onload="onLoad();">
	<div id="viewerContent"></div>
</body>
</html>