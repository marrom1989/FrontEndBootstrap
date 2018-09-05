Highcharts.chart('piechart', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: 'Chart of Expenses'
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
        style: {
          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
        }
      }
    }
  },
  series: [{
    name: 'Brands',
    colorByPoint: true,
    data: [{
      name: 'Food',
      y: 5.88,
      sliced: true,
      selected: true
    }, {
      name: 'House',
      y: 5.88
    }, {
      name: 'Transport',
      y: 5.88
    }, {
      name: 'Telecomunication',
      y: 5.88
    }, {
      name: 'Healthcare',
      y: 5.88
    }, {
      name: 'Cloth',
      y: 5.88
    }, {
      name: 'Hygiene',
      y: 5.88
    }, {
      name: 'Kids',
      y: 5.88
    }, {
      name: 'Entertainment',
      y: 5.88
    }, {
      name: 'Trips',
      y: 5.88
    }, {
      name: 'Trainings',
      y: 5.88
    }, {
      name: 'Books',
      y: 5.88
    }, {
      name: 'Savings',
      y: 5.88
    }, {
      name: 'Pension',
      y: 5.88
    }, {
      name: 'Repayment',
      y: 5.88
    }, {
      name: 'Donation',
      y: 5.88
    }, {
      name: 'Others',
      y: 5.88
    }]
  }]
});