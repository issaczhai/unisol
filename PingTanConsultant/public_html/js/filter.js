(function(){
	var Filter = {

		init: function(){
			this.btn = $('.filter');
			this.bindEvent();
		},

		bindEvent: function(){
			this.btn.on('click', this.filter());
		},

		filter: function(){
			var type = this.btn.data('type'),
				value = this.btn.data('value'),
				urlBase = './process_filter.php',
				postData = {},
				data,
				xhr,
				response;

			postData.filterType = type;
			postData.filterValue = value;
			data = buildXHRData(postData);

			xhr = new Request(urlBase, data, 'POST', function (result) {
		    	
		    		
		    });

		}
	};

	Filter.init();

})();