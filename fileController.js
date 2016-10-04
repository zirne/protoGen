function FileController() {
	var fileList = [];
	var container = $('<div>');
	var that = this;


	this.getList = function() {
		return this.fileList;
	}

	this.printHtml = function() {
		var str = "";
		for(var i in fileList) {
			str += " " + fileList[i]['name'];
		}
		return $('<div>').text(str);
	};

	this.printForm = function() {
		var validatorField = container.find('.validatorField');
		if(validatorField.length == 0) {
			validatorField = $('<input>').addClass('validatorField').hide();
			container.append(validatorField);
		}

		var innerContainer = container.find('.innerContainer');
		if(innerContainer.length == 0) {
			innerContainer = $('<div>').addClass('innerContainer');
			container.append(innerContainer);
		}
		innerContainer.empty();

		for(var i in fileList) {
			$('<div>').text(fileList[i]['name']).appendTo(innerContainer);
		}
		var newUploadField = $('<input>').attr('type', 'file').attr('name', "file").appendTo(innerContainer);
		$('<input>').attr("type", "hidden").attr("name", "meetingID").attr("value", "123").appendTo(innerContainer);//TA BORT HÅRDKODAD VALUE HÄR OCH ERSÄTT MED meetingID från JSON

		$('<button>').on('click', function(ev) {
			ev.preventDefault();
			ev.stopPropagation();

			var formData = new FormData(newUploadField.parents('form')[0]);

			$.ajax({
				url: 'backend/index.php?do=upload',
				type: 'POST',
				xhr: function() {
					var myXhr = $.ajaxSettings.xhr();
					if(myXhr.upload) {
						myXhr.upload.addEventListener('progress',function(e) {
							if(e.lengthComputable) {
								$('progress').attr({value:e.loaded,max:e.total});
							}
						}, false);
					}
					return myXhr;
				},
				beforeSend:  function() {},
				success: function(e) {
					console.log(e);
					var newFile = {};
					console.log(newUploadField.val());
					newFile['name'] = newUploadField.val();
					fileList.push(newFile);
					validatorField.trigger('change');

					that.printForm();
				},
				error: function(e) {
					console.log(e);
					alert('Det gick ju åt helvete');
				},
				data: formData,
				cache: false,
				contentType: false,
				processData: false
			});
		}).text("Skicka").appendTo(innerContainer);

		return container;
	};
};