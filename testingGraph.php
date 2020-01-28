
<!doctype html>
<html>

<head>
	<title>Pie Chart</title>
	<script src="https://www.chartjs.org/dist/2.9.3/Chart.min.js"></script>
	<script src="https://www.chartjs.org/samples/latest/utils.js"></script>
    
</head>

<body>
    <select id="dropdownPhase" >
        <option value=""> Please select choice </option>
        <option value="prod">prod</option>
        <option value="qa">qa</option>
        </select>
	<div id="canvas-holder" style="width:40%">
		<canvas id="chart-area"></canvas>
	</div>
	<button id="randomizeData">Randomize Data</button>
	<button id="addDataset">Add Dataset</button>
	<button id="removeDataset">Remove Dataset</button>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script>
        
        var dataPoints=[1,2];
        // /console.log("initial dataPoints = " + dataPoints);
        var array= [ { phase: "prod", issue:"other"}, {phase: "prod", issue:"environment"} , {phase: "qa", issue:"other"}];
        var chosenPhase;
        var environment=0;
        var other=0;
        var arrayCount = [];


        // replace with config
        var issueArray= ["other","environment"];


        function getRandomColor() {
            var letters = '0123456789ABCDEF'.split('');
            var color = '#';
            for (var i = 0; i < 6; i++ ) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }


		var config = {
			type: 'pie',
			data: {
				datasets: [{
					data: dataPoints,
                    backgroundColor: [
						window.chartColors.red,
						window.chartColors.orange,
						window.chartColors.yellow,
						window.chartColors.green,
						window.chartColors.blue,
                        window.chartColors.purple
                    ],
					label: 'Dataset 1'
				}],
				labels: [
					'Red',
					'Orange',

				]
			},
			options: {
				responsive: true
			}
		};

		window.onload = function() {
			var ctx = document.getElementById('chart-area').getContext('2d');
			window.myPie = new Chart(ctx, config);
		};

        $("#dropdownPhase").change(function () {
            dataPoints=[];
            other = 0;
            environment = 0;
            chosenPhase = $(this).val();
            console.log("ChosenPhase = "+ chosenPhase);
            for (key in array)
            {
                if(array[key].phase == chosenPhase)
                {
                    // if(array[key].issue == "environment")
                    // {
                    //     environment = environment + 1;
                    // }
                    // if(array[key].issue == "other")
                    // {
                    //     other = other + 1;
                    // }
                    for ( k in issueArray)
                    {
                        if(array[key].issue == issueArray[k])
                        {
                            arrayCount[k]= arrayCount[k]
                        }
                    }
                }
            }
            console.log("environment count = " + environment);
            console.log("other count = " + other);
            dataPoints.push(environment);
            dataPoints.push(other);
            console.log("DataPoints = " + dataPoints);
            

            config.data.datasets.forEach(function(dataset) {
				dataset.data = dataPoints;
                
			});
            window.myPie.update();
                      
        });

		document.getElementById('randomizeData').addEventListener('click', function() {
			config.data.datasets.forEach(function(dataset) {
				dataset.data = dataset.data.map(function() {
					return randomScalingFactor();
				});
			});

			window.myPie.update();
		});

		var colorNames = Object.keys(window.chartColors);
		document.getElementById('addDataset').addEventListener('click', function() {
			var newDataset = {
				backgroundColor: [],
				data: [],
				label: 'New dataset ' + config.data.datasets.length,
			};

			for (var index = 0; index < config.data.labels.length; ++index) {
				newDataset.data.push(randomScalingFactor());

				var colorName = colorNames[index % colorNames.length];
				var newColor = window.chartColors[colorName];
				newDataset.backgroundColor.push(newColor);
			}

			config.data.datasets.push(newDataset);
			window.myPie.update();
		});

		document.getElementById('removeDataset').addEventListener('click', function() {
			config.data.datasets.splice(0, 1);
			window.myPie.update();
		});

        
	</script>
</body>

</html>
