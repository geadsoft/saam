
function loadDashboard(graph1,graph2,graph3,graph4,graph5){

  viewGraphs1(graph1)
  viewGraphs2(graph2)
  viewGraphs3(graph3)
  viewGraphs4(graph4)
  viewGraphs5(graph5)
 
}

function viewGraphs1(graph1) {

  Highcharts.chart('container1', {
    chart: {
      type: 'bar', // Cambia 'column' a 'bar'
      height: '600', // o usa un número específico como 600
      width: null     // permite que se ajuste automáticamente
    },
    title:{
      text:'Mayor Toneladas'
    },
    accessibility: {
      announceNewData: {
        enabled: true,
      },
    },
    xAxis: {
      type: 'category',
    },
    yAxis: {
      title: {
        text: '',
      },
    },
    legend: {
      enabled: false,
    },
    plotOptions: {
      series: {
        borderWidth: 0,
        dataLabels: {
          enabled: true,
          format: '{point.y:.1f}Tm',
        },
      },
    },

    tooltip: {
      headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
      pointFormat:
        '<span style="color:{point.color}">{point.name}</span>: ' +
        '<b>{point.y:.2f}%</b> of total<br/>',
    },

    series: [
      {
        name: 'Browsers',
        colorByPoint: true,
        data: graph1
      },
    ],
  })

}

function viewGraphs2(graph2) {

  Highcharts.chart('container2', {
    chart: {
      title: 'Promedio',
      type: 'bar', // Cambia 'column' a 'bar'
      height: '600', // o usa un número específico como 600
      width: null     // permite que se ajuste automáticamente
    },
    title:{
      text:'Mayor Precio Promedio'
    },
    accessibility: {
      announceNewData: {
        enabled: true,
      },
    },
    xAxis: {
      type: 'category',
    },
    yAxis: {
      title: {
        text: '',
      },
    },
    legend: {
      enabled: false,
    },
    plotOptions: {
      series: {
        borderWidth: 0,
        dataLabels: {
          enabled: true,
          format: '${point.y:.1f}',
        },
      },
    },

    tooltip: {
      headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
      pointFormat:
        '<span style="color:{point.color}">{point.name}</span>: ' +
        '<b>{point.y:.2f}%</b> of total<br/>',
    },

    series: [
      {
        name: 'Browsers',
        colorByPoint: true,
        data: graph2
      },
    ],
  })

}

function viewGraphs3(graph3){
    Highcharts.chart('container3', {
      chart: {
          type: 'column',
          height: '450', // o usa un número específico como 600
          width: null     // permite que se ajuste automáticamente
      },
      title: {
          text: 'Compra de Palma, Quevedo vs Oriente'
      },
      xAxis: {
          categories: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre' ,'Diciembre'],
          crosshair: true,
          accessibility: {
              description: 'Meses'
          }
      },
      yAxis: {
          min: 0,
          title: {
              text: '1000 toneladas métricas (TM)'
          }
      },
      tooltip: {
          valueSuffix: ' (Tm)'
      },
      plotOptions: {
          column: {
              pointPadding: 0.2,
              borderWidth: 0
          }
      },
      series: graph3
  });
}

function viewGraphs4(graph4){
      Highcharts.chart('container4', {
      chart: {
          type: 'pie',
          zooming: {
              type: 'xy'
          },
          panning: {
              enabled: true,
              type: 'xy'
          },
          panKey: 'shift'
      },
      title: {
          text: 'Dia Semana'
      },
      tooltip: {
          valueSuffix: 'Tm'
      },
      /*subtitle: {
          text:
          'Source:<a href="https://www.mdpi.com/2072-6643/11/3/684/htm" target="_default">MDPI</a>'
      },*/
      plotOptions: {
          pie: {
              allowPointSelect: true,
              cursor: 'pointer',
              dataLabels: [{
                  enabled: true,
                  distance: 20
              }, {
                  enabled: true,
                  distance: -40,
                  format: '{point.percentage:.1f}%',
                  style: {
                      fontSize: '1.2em',
                      textOutline: 'none',
                      opacity: 0.7
                  },
                  filter: {
                      operator: '>',
                      property: 'percentage',
                      value: 10
                  }
              }]
          }
      },
      series: [
          {
              name: 'Percentage',
              colorByPoint: true,
              data: graph4
          }
      ]
  });
}

function viewGraphs5(graph5){

    Highcharts.chart('container5', {
      chart: {
          type: 'bar'
      },
      title: {
          text: 'Tonelada semana por Variedad'
      },
      /*subtitle: {
          text: 'Source: <a ' +
              'href="https://en.wikipedia.org/wiki/List_of_continents_and_continental_subregions_by_population"' +
              'target="_blank">Wikipedia.org</a>'
      },*/
      xAxis: {
          categories: ['COARI', 'GUINNENSI', 'TAISHA', 'HIBRIDA' , 'AMAZON'],
          title: {
              text: null
          },
          gridLineWidth: 1,
          lineWidth: 0
      },
      yAxis: {
          min: 0,
          title: {
              text: 'Dia Semana (Toneladas)',
              align: 'high'
          },
          labels: {
              overflow: 'justify'
          },
          gridLineWidth: 0
      },
      tooltip: {
          valueSuffix: ' Toneladas'
      },
      plotOptions: {
          bar: {
              borderRadius: '50%',
              dataLabels: {
                  enabled: true
              },
              groupPadding: 0.1
          }
      },
      legend: {
          layout: 'vertical',
          align: 'right',
          verticalAlign: 'top',
          x: -40,
          y: 80,
          floating: true,
          borderWidth: 1,
          backgroundColor: 'var(--highcharts-background-color, #ffffff)',
          shadow: true
      },
      credits: {
          enabled: false
      },
      series: graph5
  });

}