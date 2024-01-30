<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>Usuarios</title>

    <?php
        $js = new \Stimulsoft\StiJavaScript(\Stimulsoft\StiComponentType::Designer);
        $js->renderHtml();
    ?>

    <script type="text/javascript">
        var license = @json($license);
        Stimulsoft.Base.StiLicense.loadFromFile(license);
        Stimulsoft.Base.Localization.StiLocalization.setLocalizationFile("reports/stimulsoft/localization/es.xml", true);
        var reportPath = 'reports/stimulsoft/usuarios.mrt';

        var options = new Stimulsoft.Viewer.StiViewerOptions();
        var jsonData = @json(['usuarios' => $users]);
        var dataSet = new Stimulsoft.System.Data.DataSet("data");
        dataSet.readJson(jsonData);

        var report = new Stimulsoft.Report.StiReport();
        report.loadFile(reportPath);
        report.regData("data", "data", dataSet);
        report.dictionary.synchronize();

        var viewer = new Stimulsoft.Viewer.StiViewer(options, "StiViewer", false);
        viewer.report = report;
        viewer.renderHtml("reportContent");
    </script>
</head>
    <body>
        <div id="reportContent"></div>
    </body>
</html>
