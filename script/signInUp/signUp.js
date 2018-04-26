/**
 * Created by chenran on 4/25/18.
 */
//cite https://codepen.io/jaycbrf/pen/iBszr
console.log("enter sign up javascript");
$(document).ready(function() {
    // $('#signIn').bootstrapValidator({
    //     // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
    //     feedbackIcons: {
    //         valid: 'glyphicon glyphicon-ok',
    //         invalid: 'glyphicon glyphicon-remove',
    //         validating: 'glyphicon glyphicon-refresh'
    //     },
    //     fields: {
    //         sign_in_name: {
    //             validators: {
    //                 stringLength: {
    //                     min: 2,
    //                 },
    //                 notEmpty: {
    //                     message: 'Please supply your user name'
    //                 }
    //             }
    //         },
    //         sign_in_password: {
    //             validators: {
    //                 stringLength: {
    //                     min: 2,
    //                 },
    //                 notEmpty: {
    //                     message: 'The password is required and can\'t be empty'
    //                 },
    //             }
    //         }
    //     }
    // })


    $('#signUp').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            signUpName: {
                validators: {
                    stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Please supply your user name'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required and can\'t be empty'
                    },
                    identical: {
                        field: 'confirmPassword',
                        message: 'The password and its confirm are not the same'
                    }
                }
            },
            confirmPassword: {
                validators: {
                    notEmpty: {
                        message: 'The confirm password is required and can\'t be empty'
                    },
                    identical: {
                        field: 'password',
                        message: 'The password and its confirm are not the same'
                    }
                }
            }
        }
    })
});

