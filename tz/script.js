/* ----------------------------

	Обычные проверки
	
---------------------------- */

function CustomValidation() {
	this.invalidities = [];
	this.validityChecks = [];
}

CustomValidation.prototype = {
	addInvalidity: function(message) {
		this.invalidities.push(message);
	},
	getInvalidities: function() {
		return this.invalidities.join('. \n');
	},
	checkValidity: function(input) {
		for ( var i = 0; i < this.validityChecks.length; i++ ) {

			var isInvalid = this.validityChecks[i].isInvalid(input);
			if (isInvalid) {
				this.addInvalidity(this.validityChecks[i].invalidityMessage);
			} 

			var requirementElement = this.validityChecks[i].element;
			if (requirementElement) {
				if (isInvalid) {
					requirementElement.classList.add('invalid');
					requirementElement.classList.remove('valid');
				} else {
					requirementElement.classList.remove('invalid');
					requirementElement.classList.add('valid');
				}

			} 
		} 
	}
};



/* ----------------------------

	Дополнительные проверки
	
---------------------------- */

var usernameValidityChecks = [
	{
		isInvalid: function(input) {
			return input.value.length < 3;
		},
		invalidityMessage: 'Имя должно содержать больше 3 символов',
		element: document.querySelector('label[for="username"] .input-requirements li:nth-child(1)')
	},
	{
		isInvalid: function(input) {
			var illegalCharacters = input.value.match(/[^a-zA-Z0-9]/g);
			return illegalCharacters ? true : false;
		},
		invalidityMessage: 'Имя должно содержать только символы и числа',
		element: document.querySelector('label[for="username"] .input-requirements li:nth-child(2)')
	}
];

var telefonValidityChecks = [
	{
		isInvalid: function(input) {
			return input.value.length < 11 | input.value.length > 12;
		},
		invalidityMessage: 'В телефоне Должно присутсвовать 11 символов',
		element: document.querySelector('label[for="telefon"] .input-requirements li:nth-child(1)')
	},
	{
		isInvalid: function(input) {
			return input.value.match(/[^0-9]/g);
		},
		invalidityMessage: 'В телефоне не должно присутствовать букв',
		element: document.querySelector('label[for="telefon"] .input-requirements li:nth-child(2)')
	},
];

var checkboxValidityChecks = [
	{
		isInvalid: function(input) {
			return !input.checked;
		},
		invalidityMessage: 'Галочка должна быть нажата',
		element: document.querySelector('label[for="checkbox"] .input-requirements li:nth-child(1)')
	},
];




/* ----------------------------

	Проверка

---------------------------- */

function checkInput(input) {

	input.CustomValidation.invalidities = [];
	input.CustomValidation.checkValidity(input);

	if ( input.CustomValidation.invalidities.length == 0 && input.value != '' ) {
        input.setCustomValidity('');
        return 1;
	} else {
		var message = input.CustomValidation.getInvalidities();
        input.setCustomValidity(message);
        return 0;
	}
}



/* ----------------------------

	Подключение дополнительных проверок

---------------------------- */

var usernameInput = document.getElementById('username');
var telefonInput = document.getElementById('telefon');
var messageInput = document.getElementById('message');
var checkboxInput = document.getElementById('checkbox');

usernameInput.CustomValidation = new CustomValidation();
usernameInput.CustomValidation.validityChecks = usernameValidityChecks;

telefonInput.CustomValidation = new CustomValidation();
telefonInput.CustomValidation.validityChecks = telefonValidityChecks;

messageInput.CustomValidation = new CustomValidation();


checkboxInput.CustomValidation = new CustomValidation();
checkboxInput.CustomValidation.validityChecks = checkboxValidityChecks;


/* ----------------------------

	Подключение подписок

---------------------------- */

var inputs = document.querySelectorAll('input:not([type="submit"])');
var submit = document.querySelector('input[type="submit"');

for (var i = 0; i < inputs.length; i++) {
	inputs[i].addEventListener('keyup', function() {
		checkInput(this);
	});
}

function Send(f)
{
    rr = 0;
	for (var i = 0; i < inputs.length; i++) {
       
        if(checkInput(inputs[i])){
            rr++;
        }     
    }
   
    
    if(rr == 4){
        console.log(rr);
        $.ajax({
            url: "ajax.php",
            type: "POST",
            data: {
                name: usernameInput.value,
                telefon: telefonInput.value,
                message: messageInput.value,
              },
            success: function(data) {
                alert(data);
            }
          });
        return false;
    } else{
        return false;
    }
}

/*submit.addEventListener('click', function() {
    rr = 0;
	for (var i = 0; i < inputs.length; i++) {
       
        if(checkInput(inputs[i])){
            rr++;
        }     
    }
   
    
    if(rr == 4){
        console.log(rr);
    } else{
        return false;
    }
    
});*/

document.getElementById('checkbox').addEventListener('click', function() {
    checkInput(this);
});