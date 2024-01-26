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
    /** https://www.stimulsoft.com/en/documentation/online/programming-manual/index.html?reports_and_dashboards_for_php_deployment.htm */
    $js = new \Stimulsoft\StiJavaScript(\Stimulsoft\StiComponentType::Viewer);
    $js->renderHtml();
    ?>

    <script type="text/javascript">
        <?php
        $handler = new \Stimulsoft\StiHandler(false);
        $handler->passQueryParametersToReport = true;                       // Carga los parametros de la URL
        $handler->options->url = '/handler';                                // Carga el manejador especifico
        //$handler->license->setKey('6vJhGtLLLz2GNviWmUTrhSqnO...');
        //$handler->license->setFile('license.key');
        $handler->renderHtml();


        /** https://www.stimulsoft.com/en/documentation/online/programming-manual/index.html?reports_and_dashboards_for_php_settings.htm */
        $options = new \Stimulsoft\Viewer\StiViewerOptions();


        //$options->localization = '/resources/loc/de.xml';


        $options->toolbar->showSendEmailButton = false;
        $options->toolbar->displayMode = \Stimulsoft\Viewer\StiToolbarDisplayMode::Separated;
        $options->appearance->fullScreenMode = true;
        $options->appearance->scrollbarsMode = true;
        $options->height = '600px'; // Height for non-fullscreen mode

        /** https://www.stimulsoft.com/en/documentation/online/programming-manual/index.html?reports_and_dashboards_for_php_deployment.htm */
        $viewer = new \Stimulsoft\Viewer\StiViewer($options);

        $viewer->onPrepareVariables = true;  // Carga las variables del Handler


        /** https://www.stimulsoft.com/en/documentation/online/programming-manual/index.html?reports_and_dashboards_for_php_engine_connecting_sql_data.htm */
        $viewer->onBeginProcessData = true;

        /** https://www.stimulsoft.com/en/documentation/online/programming-manual/index.html?reports_and_dashboards_for_php_web_viewer_send_email.htm */
        $viewer->onEmailReport = true;

        /** https://www.stimulsoft.com/en/documentation/online/programming-manual/index.html?reports_and_dashboards_for_php_web_designer_creating_editing_report.htm */
        $report = new \Stimulsoft\Report\StiReport();
        $report->loadFile('reports/stimulsoft/Variables.mrt');
        //$report->render('onAfterRender');
        $viewer->report = $report;
        ?>
        function onAfterRender() {
            alert('Listo Che!');
        }
        // After loading the HTML page, display the visual part of the Viewer in the specified container.
        function onLoad() {
            <?php
                $viewer->renderHtml('viewerContent');
            ?>
        }
    </script>
</head>
    <body onload="onLoad();">
        <div id="viewerContent"></div>
    </body>
</html>
