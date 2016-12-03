<?php

class AliadosController{
    
    
    public function __CONSTRUCT(){
    }
    
    public function Index(){
        $json = file_get_contents('https://www.datos.gov.co/resource/3a4x-4hwu.json');
        $dato = json_decode($json);
        require_once 'view/header.php';
        require_once 'view/lateral.php';
        require_once 'view/aliados/listar.php';
        require_once 'view/footer.php';
    }

    
    public function Comparar(){
        $json = file_get_contents('https://www.datos.gov.co/resource/3a4x-4hwu.json');
        $dato = json_decode($json);
        
        $json = file_get_contents('https://www.datos.gov.co/resource/3a4x-4hwu.json?nombrecomercial='.str_replace(" ","+",$_REQUEST['aliado1']));
        $aliado1=json_decode($json);
        $json = file_get_contents('https://www.datos.gov.co/resource/3a4x-4hwu.json?nombrecomercial='.str_replace(" ","+",$_REQUEST['aliado2']));
        $aliado2=json_decode($json);
        $grafic1="[['".$_REQUEST['aliado1']."',".$aliado1[0]->precio."],['".$_REQUEST['aliado2']."',".$aliado2[0]->precio."]]";
        //$grafic2="[['".$_REQUEST['aliado1']."',".$aliado1[0]->camas."],['".$_REQUEST['aliado2']."',".$aliado2[0]->camas."]]";
        //$grafic3="[['".$_REQUEST['aliado1']."',".$aliado1[0]->emp."],['".$_REQUEST['aliado2']."',".$aliado2[0]->emp."]]";
        
        //echo $grafic;
        
        require_once 'view/header.php';
        require_once 'view/lateral.php';
        echo "<div id='graficadatos'>";
            echo '<div id="grafican1"></div>';
            echo '<div id="grafican2"></div>';
            echo '<div id="grafican3"></div>';
        echo "</div>";
        require_once 'view/aliados/listar.php';
        
        echo "<script type='text/javascript'>
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Topping');
            data.addColumn('number', 'Slices');
            data.addRows(".$grafic1.");
            var options = {'title':'Precio del combustible','width':640,'height':480};
            var chart = new google.visualization.ColumnChart(document.getElementById('grafican1'));
            chart.draw(data, options);
        }
        </script>";
        /*echo "<script type='text/javascript'>
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Topping');
            data.addColumn('number', 'Slices');
            data.addRows(".$grafic2.");
            var options = {'title':'Grafica del servicio hotelero - Camas','width':320,'height':240};
            var chart = new google.visualization.PieChart(document.getElementById('grafican2'));
            chart.draw(data, options);
        }
        </script>";
        echo "<script type='text/javascript'>
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Topping');
            data.addColumn('number', 'Slices');
            data.addRows(".$grafic3.");
            var options = {'title':'Grafica del servicio hotelero - Empleados','width':320,'height':240};
            var chart = new google.visualization.PieChart(document.getElementById('grafican3'));
            chart.draw(data, options);
        }
        </script>";*/
        
        require_once 'view/footer.php';
    }
}