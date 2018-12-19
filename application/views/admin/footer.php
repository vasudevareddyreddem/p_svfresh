</div>
    </div>
	<script src="<?php echo base_url().'assets/js/popper.js';?>"></script>
 <script src="<?php echo base_url().'assets/js/plugins.js'?>"></script>
   
    
    <script src="<?php echo base_url().'assets/js/tooltip.js';?>"></script>

    <script src="<?php echo base_url().'assets/js/bootstrap.min.js';?>"></script>
    <script src="<?php echo base_url().'assets/js/bootstrapValidator.min.js';?>"></script>

    <script src="<?php echo base_url().'assets/js/jquery.nicescroll.js';?>"></script>
    <script src="<?php echo base_url().'assets/js/scroll-up-bar.min.js';?>"></script>
    <script src="<?php echo base_url().'assets/js/sa-functions.js';?>"></script>
    <script src="<?php echo base_url().'assets/js/chart.min.js';?>"></script>
	<script src="<?php echo base_url().'assets/js/chosen.jquery.min.js';?>"></script>
    
    <script>
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                datasets: [{
                    label: 'Statistics',
                    data: [460, 458, 330, 502, 430, 610, 488],
                    borderWidth: 2,
                    backgroundColor: 'rgb(87,75,144)',
                    borderColor: 'rgb(87,75,144)',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#ffffff',
                    pointRadius: 4
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 150
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            display: false
                        },
                        gridLines: {
                            display: false
                        }
                    }]
                },
            }
        });

        var ctx = document.getElementById("myChart2").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                datasets: [{
                    label: 'Statistics',
                    data: [460, 458, 330, 502, 430, 610, 488],
                    borderWidth: 2,
                    backgroundColor: 'rgb(87,75,144)',
                    borderColor: 'rgb(87,75,144)',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#ffffff',
                    pointRadius: 4
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 150
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            display: false
                        },
                        gridLines: {
                            display: false
                        }
                    }]
                },
            }
        });
    </script>
    
    
   
    <script src="<?php echo base_url().'assets/js/summernote-lite.js';?>"></script>
    <script src="<?php echo base_url().'assets/js/scripts.js';?>"></script>
    <script src="<?php echo base_url().'assets/js/custom.js';?>"></script>
	<script src="<?php echo base_url().'assets/js/datatables.min.js';?>"></script>
    <script src="<?php echo base_url().'assets/js/dataTables.bootstrap.min.js';?>"></script>
    <script src="<?php echo base_url().'assets/js/datatables-init.js';?>"></script>  

</body>

</html>