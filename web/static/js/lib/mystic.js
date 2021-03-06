/*
    Inquisition // Celestial // Mystic.js

    - JS lib for data generation and manipulation
 */

"use strict";

var Mystic = function () {};

Mystic.queryAPI = function (httpMethod, apiURL, timeout, data, successFunction, errorFunction, beforeSendFunction) {
    /*
        Make AJAX request to Inquisition API with given params
     */

    $.ajax({
        dataType: 'json',
        type: httpMethod,
        url: apiURL,
        data: data,
        beforeSend: beforeSendFunction,
        success: successFunction,
        error: errorFunction,
        timeout: timeout
    });
};

Mystic.initAPILoad = function (onlyContent, contentWrapper, httpMethod, apiUrl, fadeOutFunct, fadeInFunct,
                               timeout, initialHtml, orderByFieldOpts, postData) {
    /*
        Abstraction class for making API call and performing before and after functionality
     */

    Mystic.queryAPI(httpMethod, apiUrl, timeout, postData, function (apiData) {
        contentWrapper.fadeOut(250, function () {
            try {
                fadeOutFunct(onlyContent, apiData, contentWrapper, initialHtml, orderByFieldOpts[0],
                    orderByFieldOpts[1]);
            } catch (e) {
                ErrorBot.generateError(3, 'issue initiating data call :: [ ' + e + ' ]');
            }
        }).fadeIn(250, function () {
            try {
                fadeInFunct(onlyContent);
            } catch (e) {
                ErrorBot.generateError(3, 'issue processing fetched data :: [ ' + e + ' ]');
            }
        });
    }, function () {
        ErrorBot.generateError(4, 'could not load data from the Inquisition API :: [ REQUEST DETAILS: { ' + httpMethod
            + ' ' + apiUrl + ' } ]');
    });
};
