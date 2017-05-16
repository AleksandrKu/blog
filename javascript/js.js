$(function() {
    // form  (id="contactForm")
    $('#contactForm').submit(function(event) {
       event.preventDefault();
        var formValid = true;
        // перебираем все элементы управления формы (input и textarea)
        $('#contactForm input,textarea').each(function() {
            // проверяем, является ли данный элемент капчей
            // если это так, то не выполняем его проверку
           /* if ($(this).attr('id') == 'text-captcha') { return true; }*/
            // находим предков, имеющих класс .form-group (для установления success/error)
            var formGroup = $(this).parents('.form-group');
            // находим glyphicon (иконка успеха или ошибки)
            var glyphicon = formGroup.find('.form-control-feedback');
            // выполняем валидацию данных с помощью HTML5 функции checkValidity
            if (this.checkValidity()) {
                // добавляем к formGroup класс .has-success и удаляем .has-error
                formGroup.addClass('has-success').removeClass('has-error');
                // добавляем к glyphicon класс .glyphicon-ok и удаляем .glyphicon-remove
                glyphicon.addClass('glyphicon-ok').removeClass('glyphicon-remove');
            } else {
                // добавляем к formGroup класс .has-error и удаляем .has-success
                formGroup.addClass('has-error').removeClass('has-success');
                // добавляем к glyphicon класс glyphicon-remove и удаляем glyphicon-ok
                glyphicon.addClass('glyphicon-remove').removeClass('glyphicon-ok');
                // если элемент не прошёл проверку, то отмечаем форму как не валидную
                formValid = false;
            }
        });
        // проверяем элемент, содержащий код капчи
        // получаем значение элемента input, который содержит код капчи
      /*  var captcha = $("#text-captcha").val();*/
        // если количество символов в коде капчи не равна 6,
        // то отмечаем капчу как не валидную и не отправляем форму на сервер
      /*  if (captcha.length!=6) {
            // получаем элемент, содержащий капчу
            inputCaptcha = $("#text-captcha");
            // находим предка, имеющего класс .form-group (для установления success/error)
            formGroupCaptcha = inputCaptcha.parents('.form-group');
            // находим glyphicon (иконка успеха или ошибки)
            glyphiconCaptcha = formGroupCaptcha.find('.form-control-feedback');
            // добавляем к formGroup класс .has-error и удаляем .has-success
            formGroupCaptcha.addClass('has-error').removeClass('has-success');
            // добавляем к glyphicon класс glyphicon-remove и удаляем glyphicon-ok
            glyphiconCaptcha.addClass('glyphicon-remove').removeClass('glyphicon-ok');
        }*/
        // если форма валидна и длина капчи равно 6 символам, то отправляем форму на сервер (AJAX)
        if (formValid) {
            //получаем имя, которое ввёл пользователь
            var name = $("#name").val();
            //получаем email, который ввёл пользователь
            var email = $("#email").val();
            //получаем сообщение, которое ввёл пользователь
            var message = $("#message").val();
            var id_article = $(".id_article").attr('id');
            console.log(message);
            //получаем капчу, которую ввёл пользователь
            //var captcha = $("#text-captcha").val();

            // объект, посредством которого будем кодировать форму перед отправкой её на сервер
            var formData = new FormData();
            // добавить в formData значение 'name'=значение_поля_name
            formData.name = name;
            // добавить в formData значение 'email'=значение_поля_email
            formData.email = email;
            // добавить в formData значение 'message'=значение_поля_message
            formData.message = message;
            // добавить в formData значение 'captcha'=значение_поля_captcha
           // formData.append('captcha', captcha);
console.log(formData);

var data_for_send = "name=" + name + "&email="+ email + "&message="+ message + "&id_article=" + id_article;
console.log(data_for_send);
            //отправляем данные на сервер (AJAX)
            $.ajax({
                //метод передачи запроса - POST
                type: "POST",
                //URL-адрес запроса
                url: "comment.php",
                //передаваемые данные - formData
                data: data_for_send,
                // не устанавливать тип контента, т.к. используется FormData
               // contentType: false,
                // не обрабатывать данные formData
               // processData: false,
                // отключить кэширование результатов в браузере
                cache: false,
                //при успешном выполнении запроса
                success : function(data){
//console.log(data);
                    // разбираем строку JSON, полученную от сервера
                   var data_object =  JSON.parse(data);
                  /* var data_in =   data ;*/

                 console.log(data_object);
                 console.log(data_object.result);
                    // устанавливаем элементу, содержащему текст ошибки, пустую строку
                    $('#error').text('');

                    // если сервер вернул ответ success (данные получены)
                    if (data_object.result == "success") {
                        // скрываем форму обратной связи
                      // $('#contactForm').hide();
                        $('#message').val('');
                        // удаляем у элемента, имеющего id=successMessage, класс hidden
                        $('#successMessage').removeClass('hidden');
                    }
                  /*  else if ($data.result == "invalidCaptcha") {
                        // если сервер вернул ответ invalidcaptcha, то делаем следующее...
                        // получаем элемент, содержащий капчу
                        inputCaptcha = $("#text-captcha");
                        // находим предка, имеющего класс .form-group (для установления success/error)
                        formGroupCaptcha = inputCaptcha.parents('.form-group');
                        // находим glyphicon (иконка успеха или ошибки)
                        glyphiconCaptcha = formGroupCaptcha.find('.form-control-feedback');
                        // добавляем к formGroup класс .has-error и удаляем .has-success
                        formGroupCaptcha.addClass('has-error').removeClass('has-success');
                        // добавляем к glyphicon класс glyphicon-remove и удаляем glyphicon-ok
                        glyphiconCaptcha.addClass('glyphicon-remove').removeClass('glyphicon-ok');
                        // выводим новый код капчи
                        $('#img-captcha').attr('src', '/feedback/captcha.php?id=' + Math.random() + '');
                        // устанавливаем полю, с помощью которого осуществляем ввод капчи пустое значение
                        $("#text-captcha").val('');
                    } */else {
                        // если сервер вернул ответ error, то делаем следующее...
                        $('#error').text('Error from server');
                    }
                },
                error: function (request) {
                    $('#error').text('Error ' + request.responseText + ' when sending data.');
                }
            });
        }
    });
});