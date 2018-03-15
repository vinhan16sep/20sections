$(document).ready(function() {
    'use strict';

    //OnLoad Document
    $('#client_signup').hide();
    $('#featured_client, #featured_brand').hide();

    //Client Signup

    $('#btn_signup').click(function(){
        $('#client_login').hide();
        $('#client_signup').show();
    });

    $('#btn_login').click(function(){
        $('#client_login').show();
        $('#client_signup').hide();
    });

    //Click to show active tabs

    $('a#call_view_login_brand').click(function (e){
        e.preventDefault()
        $('a[href="#view_login_brand"]').tab('show')
        $('#featured_brand').show()
    });

    $('a#call_view_login_client').click(function (e){
        e.preventDefault()
        $('a[href="#view_login_client"]').tab('show')
        $('#featured_client').show()
    });

    //Open Featured Brand or Client with each Tabs
    $('a[href="#view_login_brand"]').on('show.bs.tab', function(e) {
        $('#featured_brand').show();
        $('#featured_client').hide();
    });
    $('a[href="#view_login_client"]').on('show.bs.tab', function(e) {
        $('#featured_brand').hide();
        $('#featured_client').show();

        //Reset login Client
        $('#client_login').show();
        $('#client_signup').hide();
    });

    //Reset login Client

    $('#loginModal').on('hidden.bs.modal', function (e) {
        $('#client_login').show();
        $('#client_signup').hide();
        $('#featured_client, #featured_brand').hide();
    })


});