footerPadding();
window.onresize = footerPadding;

function footerPadding(event) {
    var footer = document.querySelector("footer");
    var footerHeight = footer.clientHeight;
    document.querySelector("body").style.paddingBottom = footerHeight + 5 + "px";
}

function hasError(field) {
    if(field.nodeName === "LABEL"){
        field = field.previousElementSibling;
    }
    
    
    if (field.disabled || field.type === "submit" || field.type === "button" || field.type === "reset" || field.type === "file")
        return;
    
    var validity = field.validity;
    if (validity.valid || field.parentElement.classList.contains("hide")) 
        return;

    // If field is required and empty
    if (validity.valueMissing) 
    {
        if(field.type === "checkbox"){
            return "Please sign the declaration";
        }
        return 'Please Enter a Value. This field cannot be left blank';
    }
    // If not the right type
    if (validity.typeMismatch) return 'Please Enter a valid Email address.';

    // If too short
    if (validity.tooShort)
        return 'Please lengthen this text to ' + field.getAttribute('minLength') + ' characters or more. You are currently using ' + field.value.length + ' characters.';

    // If too long
    if (validity.tooLong)
        return 'Please shorten this text to no more than ' + field.getAttribute('maxLength') + ' characters. You are currently using ' + field.value.length + ' characters.';

    // If number input isn't a number
    if (validity.badInput) {
        return 'Bad input entered';
    }

    // If a number value doesn't match the step interval
    if (validity.stepMismatch) return 'Please select a valid value.';

    // If a number field is over the max
    if (validity.rangeOverflow) return 'Please select a smaller value.';

    // If a number field is below the min
    if (validity.rangeUnderflow) return 'Please select a larger value.';

    // If pattern doesn't match
    if (validity.patternMismatch) {
        if (field.type === "text" && field.name === "phone") {
            return "This is not a valid phone number.";
        }

        if (field.type === "text" && field.name === "amount") {
            return "Please Enter a valid amount in INR.";
        }

        if (field.name === "user_name") {
            if (field.value.search(" ") === -1) {
                return "Please enter your last name also.";
            }
            return "Please enter name. No digits or special character allowed.";
        }
    }

    // If all else fails, return a generic catchall error
    return 'The value you entered for this field is invalid.';
}

function showError(field, errorMssg) {
    if(field.nodeName === "LABEL"){
        field = field.previousElementSibling;
    }
    field.classList.add("error");

    var id = field.id || field.name;
    var messageBox = document.querySelector('.error-message#error-for-' + id);
    if (!messageBox) {
        messageBox = document.createElement("div");
        messageBox.classList.add("error-message");
        messageBox.id = 'error-for-' + id;
        field.parentNode.appendChild(messageBox);
    }
    messageBox.innerHTML = errorMssg;
    messageBox.style.display = "block";
}

function removeError(field) {
    if(field.nodeName === "LABEL"){
        field = field.previousElementSibling;
    }
    if (field.classList.contains("error")) {
        field.classList.remove("error");
        field.parentNode.querySelector("div.error-message").style.display = "none";
    }
}