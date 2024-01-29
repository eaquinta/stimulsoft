<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>Usuarios {{ $name }}</title>
    <style>
        html, body {
            font-family: sans-serif;
        }
    </style>
    <?php
        $js = new \Stimulsoft\StiJavaScript(\Stimulsoft\StiComponentType::Designer);
        $js->renderHtml();
    ?>

    <script type="text/javascript">
        var reportPath = 'reports/stimulsoft/usuarios.mrt';

        var options = new Stimulsoft.Viewer.StiViewerOptions();
        //var options = new Stimulsoft.Designer.StiDesignerOptions();
        options.appearance.scrollbarsMode = true;
        options.appearance.fullScreenMode = true;
        //options.appearance.scrollbarsMode = true;
		//options.appearance.pageBorderColor = Stimulsoft.System.Drawing.Color.navy;
		// options.toolbar.borderColor = Stimulsoft.System.Drawing.Color.navy;
		//options.toolbar.showPrintButton = false;
        //options.toolbar.showOpenFileButton = false;
		//options.toolbar.showViewModeButton = false;
		// options.toolbar.viewMode = Stimulsoft.Viewer.StiWebViewMode.WholeReport;
		// options.toolbar.zoom = 50;
		// options.width = "1000px";
		// options.height = "500px";


        jsonData =  {
            "usuarios" : [{
                "id" : "1",
                "name" : "Estuardo Quintanilla"
                }, {
                "id" : "2",
                "name" : "Juanfrancisto"
                }, {
                "id" : "3",
                "name" : "Three"
                }]
        };

        debugger;
        var jsonData = @json(['usuarios' => $users]);
        
        var dataSet = new Stimulsoft.System.Data.DataSet("data");
        dataSet.readJson(jsonData);

        var report = new Stimulsoft.Report.StiReport();
        report.loadFile(reportPath);
        report.regData("data", "data", dataSet);
        report.dictionary.synchronize();
        //var designer = new Stimulsoft.Designer.StiDesigner(null, "StiDesigner", false);
        //designer.report = report;
        //designer.renderHtml("reportContent");
        //debugger;

        var viewer = new Stimulsoft.Viewer.StiViewer(options, "StiViewer", false);
        viewer.report = report;

    </script>
</head>
    <body>
        <div id="reportContent"></div>
        <div>
            <script type="text/javascript">
                // Show the report viewer in this place
                viewer.renderHtml();
            </script>
        </div>
    </body>
</html>
