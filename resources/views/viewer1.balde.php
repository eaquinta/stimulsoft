<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>viewer1</title>

	<!-- Office2013 style -->
	<link src="{{ asset('Stimul/Stimulsoft.viewer.office2013.whiteteal.css') }}" rel="stylesheet">

	<!-- Stimusloft Reports.JS -->
	<script src="{{ asset('Stimul/stimulsoft.reports.js') }}" type="text/javascript"></script>
    <script src="{{ asset('Stimul/stimulsoft.viewer.js') }}" type="text/javascript"></script>

	<?php
		$options = StiHelper::createOptions();
		$options->handler = "handler.php";
		$options->timeout = 30;
		StiHelper::initialize($options);
	?>

    <script type="text/javascript">

        //Stimulsoft.Base.StiLicense.loadFromFile("rpt/stimulsoft/license.php");
        var options = new Stimulsoft.Viewer.StiViewerOptions();
        options.appearance.fullScreenMode = false;
        options.toolbar.showSendEmailButton = true;

        var viewer = new Stimulsoft.Viewer.StiViewer(options, "StiViewer", false);

        // Process SQL data source
        viewer.onBeginProcessData = function (event, callback) {
            <?php StiHelper::createHandler(); ?>
        }

        viewer.onBeginExportReport = function (args) {
            <?php //StiHelper::createHandler(); ?>
            //args.fileName = "MyReportName";
        }

        // Process exported report file on the server side
        /*viewer.onEndExportReport = function (event) {
            event.preventDefault = true; // Prevent client default event handler (save the exported report as a file)
           <?php StiHelper::createHandler(); ?>
        }*/

        viewer.onEmailReport = function (event) {
            <?php StiHelper::createHandler(); ?>
        }
        var report = new Stimulsoft.Report.StiReport();
        report.loadFile('{{ asset($RptFileName)  }}');
        var rptdata = {!! $RptReclist !!};


        var dataSet = new Stimulsoft.System.Data.DataSet("Customer");
        dataSet.readJson(rptdata);
        report.dictionary.databases.clear();
        report.dictionary.dataSources.clear();

        report.regData("Customer", "Customer", dataSet);

        report.getComponents().getByName('rptTitle').text ='{!! $rptTitle !!}';
        report.dictionary.synchronize();

        viewer.report = report;
        function onLoad() {
            viewer.renderHtml(document.getElementById("viewerContent"));
        }

    </script>
	</head>
<body onload="onLoad();" >
     <div style="margin: 0px auto; background-color : #7a8d8e">
          <div id="viewerContent" style="margin: 0px auto; width:50%; background-color : yellow ; position: relative !important; ">
          </div>
     </div>
</body>
</html>
