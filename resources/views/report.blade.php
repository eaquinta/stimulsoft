<!DOCTYPE html>
<html>
<head>
    <title>My Report</title>
    <script src="https://cdn.stimulsoft.com/reports/js-files/stimulsoft.reports.js"></script>
    <script src="https://cdn.stimulsoft.com/reports/js-files/stimulsoft.viewer.js"></script>
</head>
<body>
    <div id="reportViewer"></div>

    <script>
        // Initialize the report viewer
        var viewer = new Stimulsoft.Viewer.StiViewer(
            document.getElementById("reportViewer"),
            "<?= $report->serializedObject() ?>",
            {}
        );

        // Render the report
        viewer.render();
    </script>
</body>
</html>
