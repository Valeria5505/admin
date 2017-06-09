<footer>
    <div class="footer"></div>
</footer>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="assets/chartist/chartist.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<!-- 1. Подключить библиотеку jQuery -->

<!-- 2. Подключить скрипт moment-with-locales.min.js для работы с датами -->
<script type="text/javascript" src="assets/js/moment-with-locales.min.js"></script>
<!-- 3. Подключить скрипт платформы Twitter Bootstrap 3 -->
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<!--     4. Подключить скрипт виджета "Bootstrap datetimepicker" -->
<script type="text/javascript" src="assets/js/bootstrap-datetimepicker.min.js"></script>

<script type="text/javascript">
    $(function () {
        $('#datetimepicker2').datetimepicker(
            {pickTime: false, language: 'ru'}
        );
    });
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        <?
        $kb = 1024;
        $mb = 1024 * $kb;
        $disk_total = disk_total_space(".")/$mb;
        $disk_free = disk_free_space(".")/$mb;
        ?>
        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Базы данных',     <?=$sizeDatabase[0]["SUM(size)"]?>],
            ['Проекты',     <?=$sizeProject[0]["SUM(files_size)"]?>],
            ['Свободно',       <?=$disk_free?>],
            ['Система',      (<?=$disk_total-($disk_free+$sizeDatabase[0]["SUM(size)"]+$sizeProject[0]["SUM(files_size)"])?>)],
        ]);

        var options = {
            title: 'дисковое пространство'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
</script>
<script id="my_code" src="assets/js/script.js"></script>
<script>
    start();
</script>
</body>

</html>

