function checkEmpty(value) {
    if (value != "") {
        return true
    } else {
        return false
    }
}
function validMobile(number) {
    if (!isNaN(number)) {
        if (number.length == 10) {
            var firstTwo = number.substr(0, 2);
            if (firstTwo >= 70 && firstTwo <= 99) {
                return true
            } else {
                return false
            }
        } else {
            return false
        }
    } else {
        return false
    }
}
function validEmail(email) {
    var pattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return pattern.test(email)
}
function alphaNumeric(string) {
    var pattern = /^[a-zA-Z0-9]*$/;
    return pattern.test(string)
}
function alphaOnly(string) {
    var pattern = /^[a-zA-Z]*$/;
    return pattern.test(string)
}
function minValue(val, len) {
    return val.length < len ? false : true
}
function maxValue(val, len) {
    return val.length > len ? false : true
}
function matchValue(value, matchesValue) {
    return matchesValue == value ? true : false
}
function validateImage(image, validTypes) {
    image = image.toLowerCase();
    var ext = image.split(".").pop(), i;
    var allowedTypes = validTypes.split(",");
    for (i = 0; i < allowedTypes.length; i++) {
        if (allowedTypes[i] == ext) {
            return true;
            break
        }
    }
}
function specialCharacters(string) {
    var specialChars = ['@', '#', '$', '&', '<', '>', '{', '}', '^'], i;
    for (i = 0; i < specialChars.length; i++) {
        if (string.indexOf(specialChars[i]) != -1) {
            return false;
            break
        }
    }
}
function validateMe(identifire, isForm=null) {
    var toValidate, input, rule, params, value, i, current, ruleArg, errorId, error, errorLabel, status = false;
    if (isForm != null) {
        toValidate = $("#" + isForm).find('.' + identifire)
    } else {
        toValidate = $("." + identifire)
    }
    toValidate.each(function () {
        input = $(this);
        params = input.attr("data-validation-rules").split("|");
        errorLabel = input.attr("data-validation-label");
        errorId = input.attr("data-validation-message-id");
        error = $("#" + errorId);
        value = $.trim(input.val());
        for (i = 0; i < params.length; i++) {
            current = params[i];
            if (current.indexOf("[") != -1) {
                var bracketPos = current.indexOf("[");
                rule = current.substr(0, bracketPos)
            } else {
                rule = current
            }
            if (rule == "required") {
                if (!checkEmpty(value)) {
                    if (input.attr('type') == "file") {
                        error.text("Please Choose a " + errorLabel)
                    } else if (input.is("SELECT")) {
                        error.text("Please Choose a " + errorLabel)
                    } else {
                        error.text("Please Enter Your " + errorLabel)
                    }
                    status = false;
                    break
                } else {
                    error.text("");
                    status = true
                }
            }
            if (rule == "validEmail") {
                if (checkEmpty(value)) {
                    if (!validEmail(value)) {
                        error.text("Please Enter a Valid Email Address");
                        status = false;
                        break
                    } else {
                        error.text("");
                        status = true
                    }
                }
            }
            if (rule == "validMobile") {
                if (checkEmpty(value)) {
                    if (!validMobile(value)) {
                        error.text("Please Enter a Valid Mobile No.");
                        status = false;
                        break
                    } else {
                        error.text("");
                        status = true
                    }
                }
            }
            if (rule == "alpha") {
                if (checkEmpty(value)) {
                    if (!alphaOnly(value)) {
                        error.text(errorLabel + " Field Can Only Contain Alphabet Characters");
                        status = false;
                        break
                    } else {
                        error.text("");
                        status = true
                    }
                }
            }
            if (rule == "alphaNumeric") {
                if (checkEmpty(value)) {
                    if (!alphaNumeric(value)) {
                        error.text(errorLabel + " Field Can Only Contain AlphaNumeric Characters");
                        status = false;
                        break
                    } else {
                        error.text("");
                        status = true
                    }
                }
            }
            if (rule == "noSpecialChars") {
                if (checkEmpty(value)) {
                    if (specialCharacters(value) === false) {
                        error.text("Special Characters are not allowed in " + errorLabel + " Field !");
                        status = false;
                        break
                    } else {
                        error.text("");
                        status = true
                    }
                }
            }
            if (rule == "min") {
                if (checkEmpty(value)) {
                    minLength = parseInt(current.split("[")[1]);
                    if (!minValue(value, minLength)) {
                        error.text(errorLabel + " Should be Minimum " + minLength + " Characters Long");
                        status = false;
                        break
                    } else {
                        error.text("");
                        status = true
                    }
                }
            }
            if (rule == "max") {
                if (checkEmpty(value)) {
                    maxLength = parseInt(current.split("[")[1]);
                    if (!maxValue(value, maxLength)) {
                        error.text(errorLabel + " Should be Maximum " + maxLength + " Characters Long");
                        status = false;
                        break
                    } else {
                        error.text("");
                        status = true
                    }
                }
            }
            if (rule == "matches") {
                if (checkEmpty(value)) {
                    var matchesId = current.split("[")[1].split("]")[0];
                    var matchesValue = $.trim($("#" + matchesId).val());
                    var matchesLabel = $("#" + matchesId).attr('data-validation-label');
                    if (!matchValue(value, matchesValue)) {
                        error.text(errorLabel + " and " + matchesLabel + " Should Be The Same.");
                        status = false;
                        break
                    } else {
                        error.text("");
                        status = true
                    }
                }
            }
            if (rule == "validFile") {
                if (value != "") {
                    var fileParams = current.split("[")[1].split("]")[0];
                    var allowedSize = fileParams.substr(fileParams.lastIndexOf(",") + 1, 1000000000);
                    if (isNaN(allowedSize)) {
                        allowedTypes = fileParams
                    } else {
                        allowedTypes = fileParams.substr(0, fileParams.lastIndexOf(","))
                    }
                    if (validateImage(value, allowedTypes)) {
                        if (!isNaN(allowedSize)) {
                            var currentFileSize = input[0].files[0].size;
                            allowedSize = allowedSize * 1000000;
                            if (currentFileSize > allowedSize) {
                                error.text("File Size Can be Maximum " + allowedSize / 1000000 + " MB !");
                                status = false;
                                break
                            } else {
                                error.text("");
                                status = true
                            }
                        } else {
                            error.text("");
                            status = true
                        }
                    } else {
                        error.text("Only " + allowedTypes.toUpperCase() + " File Formats Are Allowed !");
                        status = false;
                        break
                    }
                }
            }
        }
    });
    return status
}
