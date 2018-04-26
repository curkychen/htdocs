/**
 * Created by chenran on 4/25/18.
 */
$(document).ready(function() {
    console.log("enter sign in javascript");
    $('#signIn').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            sign_in_name: {
                validators: {
                    stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Please supply your user name'
                    }
                }
            },
            sign_in_password: {
                validators: {
                    stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'The password is required and can\'t be empty'
                    },
                }
            }
        }
    })
});
