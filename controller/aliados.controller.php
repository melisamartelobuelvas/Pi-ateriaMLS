<?php

class AliadosController{
    
    
    public function __CONSTRUCT(){
    }
    
    private function http_get_contents($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_TIMEOUT, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if(FALSE === ($retval = curl_exec($ch))) {
            echo curl_error($ch);
        } else {
            return $retval;
        }
    }
    
    public function Index(){
        $json = $this->http_get_contents('http://mediven.esy.es/vista/lista_json.php');
        $dato = json_decode($json);
        require_once 'view/header.php';
        require_once 'view/lateral.php';
        require_once 'view/aliados/listar.php';
        require_once 'view/footer.php';
    }
        
    public function Comparar(){
        $json = $this->http_get_contents('http://mediven.esy.es/vista/lista_json.php');
        $dato = json_decode($json);
        
        $json = $this->http_get_contents('http://mediven.esy.es/vista/lista_json.php?idmedi='.$_REQUEST['aliado1']);
        $aliado1=json_decode($json);
        $json = $this->http_get_contents('http://mediven.esy.es/vista/lista_json.php?idmedi='.$_REQUEST['aliado2']);
        $aliado2=json_decode($json);
        
        $grafic1="[['".$aliado1[0]->nombre."',".$aliado1[0]->unidades."],['".$aliado2[0]->nombre."',".$aliado2[0]->unidades."]]";
        //$grafic2="[['".$_REQUEST['aliado1']."',".$aliado1[0]->PesoCanal."],['".$_REQUEST['aliado2']."',".$aliado2[0]->PesoCanal."]]";
        //$grafic3="[['".$_REQUEST['aliado1']."',".$aliado1[0]->Pesopiel."],['".$_REQUEST['aliado2']."',".$aliado2[0]->Pesopiel."]]";
        
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
            data.addColumn('number', 'Unidades');
            data.addRows(".$grafic1.");
            var options = {'title':'Comparacion de unidades','width':640,'height':480};
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
            data.addColumn('number', 'Peso');
            data.addRows(".$grafic2.");
            var options = {'title':'Comparacion de peso canal','width':320,'height':240};
            var chart = new google.visualization.ColumnChart(document.getElementById('grafican2'));
            chart.draw(data, options);
        }
        </script>";
        echo "<script type='text/javascript'>
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Topping');
            data.addColumn('number', 'Peso');
            data.addRows(".$grafic3.");
            var options = {'title':'Comparacion de peso piel','width':320,'height':240};
            var chart = new google.visualization.ColumnChart(document.getElementById('grafican3'));
            chart.draw(data, options);
        }
        </script>";
        */
        require_once 'view/footer.php';
    }
}