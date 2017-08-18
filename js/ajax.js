$(function(){
		
	    var app = {
          
        initialize : function () {
            this.setUpListeners();
        },
  
        setUpListeners: function () {
            $('form').on('submit', app.submitForm);
			$(document).on('click','.del_button',app.deleteClick);
            $('form').on('keydown', 'input', app.removeError);
        },
		deleteClick: function (e) {
			 e.preventDefault();
			 var clickedID = this.id.split("-"); //Разбиваем строку (Split работает аналогично PHP explode)
			 var DbNumberID = clickedID[1]; //и получаем номер из массива
			 var myData = 'action=delete&recordToDelete='+ DbNumberID; //выстраиваем  данные для POST
			 //var str = myData.serialize();
			 $.ajax({
                url: '../functions/action.php',
                type: 'POST',
				dataType:"text",
                data: myData
            })		
            .done(function(msg) {
				
				
                if(msg){
					// в случае успеха, скрываем, выбранный пользователем для удаления, элемент
					$('.comment_item_'+msg).fadeOut("slow");
					
					
					alert('Комментарий '+msg+' удален');

                }else{
			//	alert(msg);
					
					alert('Что то пошло не так'); //выводим ошибку 
				}
				
            })
			.error(function (xhr, ajaxOptions, thrownError){
                alert(thrownError); //выводим ошибку
            });
			 
			 
		},
        submitForm: function (e) {
            e.preventDefault();
             
            var form = $(this),
                submitBtn = form.find('input[type="submit"]');
			
            if( app.validateForm(form) === false ) return false;
 
            submitBtn.attr('disabled', 'disabled');
 
            var str = form.serialize();
			
            $.ajax({
                url: '../functions/action.php',
                type: 'POST',
				dataType:"text",
                data: str
            })
			
            .done(function(msg) {
			
                if(msg){
					console.log(msg);
                    $(".comment_list").append(msg);
					form.trigger( 'reset' );
					//form.html(result);

                }else{
					console.log(msg);
					alert('Что то пошло не так'); //выводим ошибку 
					form.trigger( 'reset' );
					
					
                }
				
            })
			.error(function (xhr, ajaxOptions, thrownError){
                alert(thrownError); //выводим ошибку
            })
            .always(function() {
                submitBtn.removeAttr('disabled');
            });
             
        },
 
        validateForm : function (form){
            var inputs = form.find('.form-control'),
                valid = true;
 
            inputs.tooltip('destroy');
 
            $.each(inputs, function(index, val) {
                var input = $(val),
                    val = input.val(),
                    formGroup = input.parents('.form-group'),
                    label = formGroup.find('label').text().toLowerCase(),
                    textError = 'Введите ' + label;
 
                if(val.length === 0){
                    formGroup.addClass('has-error').removeClass('has-success');
                    input.tooltip({
                        trigger: 'manual',
                        placement: 'right',
                        title: textError
                    }).tooltip('show');
                    valid = false;
                }else{
                    formGroup.addClass('has-success').removeClass('has-error');
                }
            });
 
            return valid;
        },
 
        removeError: function () {
            $(this).tooltip('destroy').parents('.form-group').removeClass('has-error');
        }       
          
    }
  
    app.initialize();
	
	
});