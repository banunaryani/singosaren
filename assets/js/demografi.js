$(function() {

	// $("#usiaModal").on('show.bs.modal', function(e) {
	// 	$('#maps').style.pointerEvents = 'none';
	// })


	// BAR USIA
	var ctx = document.getElementById('usia').getContext('2d');
	
	var dataUsia = {
		labels: ['0-9 th', '10-19 th', '20-29 th', '30-39 th', '40-49 th', '50-59 th', '60-69 th', '>70 th'],
		datasets: [{
			label: 'Laki-laki',
			backgroundColor: 'rgba(75, 192, 192, 0.8)',
			data: [279, 308, 317, 281, 274, 253, 173, 65]
		}, {
			label: 'Perempuan',
			backgroundColor: "rgba(255, 99, 132, 0.8)",
			data: [271, 275, 272, 305, 284, 259, 136, 89]
		}]
	};

	var chart = new Chart(ctx, {
	    type: 'bar',

	    data: dataUsia,
	    options: {
	    	title: {
	    		display: true,
	    		text: 'Jumlah Penduduk berdasarkan Usia'
	    	},
	    	tooltips: {
	    		mode: 'index',
	    		intersect: false
	    	},
	    	responsive: true,
	        scales: {
	            xAxes: [{
	                stacked: true
	            }],
	            yAxes: [{
	                stacked: true
	            }]
	        },
	        legend: {
	        	display: true,
	        	position: 'bottom'
	        }	    
	    }
	});
	// END BAR USIA



	// DOUGHNUT AGAMA
	var configAgama = {
			type: 'pie',
			data: {
				datasets: [{
					data: [3822,8,6,4,1,0],
					backgroundColor: [
						'rgba(255, 99, 132, 0.7)',
		                'rgba(54, 162, 235, 0.7)',
		                'rgba(255, 206, 86, 0.7)',
		                'rgba(75, 192, 192, 0.7)',
		                'rgba(153, 102, 255, 0.7)'
					],
					label: 'Jumlah'
				}],
				labels: [
					'Islam',
					'Kristen',
					'Katolik',
					'Hindu',
					'Budha',
					'Lainnya'
				]
			},
			options: {
				responsive: true,
				title: {
					display: true,
					text: 'Jumlah Penduduk berdasarkan Agama'
				},
				animation: {
					animateScale: true,
					animateRotate: true
				},
				legend: {
		            display: true,
		            position: 'right'
		        }
			}
		};

		var ctxa = document.getElementById('agama').getContext('2d');
		var doughnut = new Chart(ctxa, configAgama);

		// END DOUGHNUT AGAMA


		// DOUGHNUT PENDIDIKAN
		var configPendidikan = {
			type: 'doughnut',
			data: {
				datasets: [{
					data: [638,367,847,540,1033,301],
					backgroundColor: [
						'rgba(255, 99, 132, 0.7)',
		                'rgba(54, 162, 235, 0.7)',
		                'rgba(255, 206, 86, 0.7)',
		                'rgba(75, 192, 192, 0.7)',
		                'rgba(153, 102, 255, 0.7)',
		                'rgba(255, 159, 64, 0.7)'
					],
					label: 'Jumlah'
				}],
				labels: [
					'Tidak/Belum Sekolah',
					'Tidak Lulus SD',
					'SD',
					'SLTP',
					'SLTA/SMK',
					'Perguruan Tinggi'
				]
			},
			options: {
				responsive: true,
				title: {
					display: true,
					text: 'Jumlah Penduduk berdasarkan Pendidikan Terakhir'
				},
				animation: {
					animateScale: true,
					animateRotate: true
				},
				legend: {
		            display: true,
		            position: 'right'
		        }
			}
		};

		var ctxp = document.getElementById('pendidikan').getContext('2d');
		var doughnutp = new Chart(ctxp, configPendidikan);
		// END DOUGHNUT PENDIDIKAN


		// MATA PENCAHARIAN
		var configPencaharian = {
			type: 'bar',
			data: {
				datasets: [{
					data: [86,8,14,9,68,407,13,798,18,2,682],
					backgroundColor: [
						'#B63B48',
						'#AAC27F',
						'#A7B48B',
						'#4D7A85',
						'#5C7D96',
						'#D4793D',
						'#CED76B',
						'#89AC65',
						'#5A9A54',
						'#403F3E',
						'#675753'
					]
				}],
				labels: [
					'Pegawai negeri sipil',
					'Polisi',
					'Pedagang',
					'Petani',
					'Buruh tani',
					'Karyawan swasta',
					'Karyawan BUMN',
					'Buruh harian lepas',
					'Tukang jahit',
					'Mekanik',
					'Wiraswasta'	
				]
			},
			options: {
				responsive: true,
				title: {
					display: true,
					text: 'Jumlah Penduduk berdasarkan Mata Pencaharian Terakhir'
				},
				animation: {
					animateScale: true,
					animateRotate: true
				},
				legend: {
		            display: false
		        }
			}
		};

		var ctxpc = document.getElementById('pencaharian').getContext('2d');
		var doughnutp = new Chart(ctxpc, configPencaharian);
		// END MATA PENCAHARIAN

});