google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Task', 'Amount of money'],
  ['Food', 8],
  ['House', 2],
  ['Transport', 4],
  ['Telecomunication', 2],
  ['Healthcare', 8],
  ['Hygiene', 18],
  ['Kids', 8],
  ['Entertainment', 8],
  ['Trips', 8],
  ['Trainings', 8],
  ['Books', 8],
  ['Savings', 8],
  ['Pension', 8],
  ['Repayment', 8],
  ['Donation', 8],
  ['Others', 8]
]);

  var options = {
	  'title':'Expenses',
	  'width':600,
	  'height':400
	 
};
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}