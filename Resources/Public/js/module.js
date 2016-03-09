/**
 * Created by Marco_Lewandowsky on 04.08.2015.
 */

/**
 * Angular module for custom flexform
 */
require(['jquery','angular'], function($, angular) {

    angular.module("GitHubModule", [])
        .controller("GitHubController", function ($scope, $http) {

            const PROTOCOLL = 'https';
            const BASEURL   = 'api.github.com';

            /**
             * serializes list
             * @type {string}
             */
            $scope.serializedValue = '';

            /**
             * serializes list
             * @type {string}
             */
            $scope.identifier = {};

            /**
             * serializes list
             * @type {string}
             */
            $scope.repositories = [];

            /**
             * serializes list
             * @type {string}
             */
            $scope.branches = [];

            /**
             * load repos for the given user name
             */
            $scope.userNameChange = function() {
                // reset
                $scope.repositories = [];
                $scope.branches = [];

                // getting repos
                $http.get(`${PROTOCOLL}://${BASEURL}/users/${$scope.identifier.userName}/repos`)
                    .success(function (data, status, headers, config) {
                        // save repositories
                        $scope.repositories = data;
                    })
                    .error(function (data, status, headers, config) {
                        console.log("Error while getting repos: ", data);
                    });

            };

            /**
             * load branches for the given repo
             */
            $scope.repoChange = function() {
                // getting branches
                $http.get(`${PROTOCOLL}://${BASEURL}/repos/${$scope.identifier.userName}/${$scope.identifier.repository}/branches`)
                    .success(function (data, status, headers, config) {
                        // save branches
                        $scope.branches = data;
                    })
                    .error(function (data, status, headers, config) {
                        console.log("Error while getting branches: ", data);
                    });
            };

            /**
             * @param {string} value
             */
            $scope.initItems = function(value) {
                try {
                    // parse value
                    var id = JSON.parse(b64_to_utf8(value));
                    // rebuild form
                    $scope.identifier.userName = id.userName;
                    $scope.userNameChange();
                    $scope.identifier.repository = id.repository;
                    $scope.repoChange();
                    $scope.identifier.branch = id.branch;

                } catch (e) {
                    console.log("JSON String not valid");
                }
            };

            /**
             * watcher for 'items' variable
             */
            $scope.$watch('identifier', function() {
                $scope.serializedValue =  utf8_to_b64(JSON.stringify($scope.identifier));
            }, true);

            /**
             * encoding helper
             * @param str
             * @returns {string}
             */
            function utf8_to_b64( str ) {
                return window.btoa(encodeURIComponent( str ));
            }

            /**
             * decoding helper
             * @param str
             * @returns {string}
             */
            function b64_to_utf8( str ) {
                return decodeURIComponent(window.atob( str ));
            }
        });
});
