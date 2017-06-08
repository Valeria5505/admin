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

        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Занято',     20],
            ['Свободно',      80]
        ]);

        var options = {
            title: 'дисковое пространство'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
</script>
<script src="assets/js/script.js"></script>
</body>

</html>

