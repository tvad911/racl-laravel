(function () {

    var laroute = (function () {

        var routes = {

            absolute: false,
            rootUrl: 'http://racl.dev',
            routes : [{"host":null,"methods":["GET","HEAD"],"uri":"api\/user","name":null,"action":"Closure"},{"host":null,"methods":["GET","HEAD"],"uri":"\/","name":null,"action":"Closure"},{"host":null,"methods":["GET","HEAD"],"uri":"login","name":"login","action":"App\Http\Controllers\Auth\LoginController@showLoginForm"},{"host":null,"methods":["POST"],"uri":"login","name":null,"action":"App\Http\Controllers\Auth\LoginController@login"},{"host":null,"methods":["POST"],"uri":"logout","name":"logout","action":"App\Http\Controllers\Auth\LoginController@logout"},{"host":null,"methods":["GET","HEAD"],"uri":"register","name":"register","action":"App\Http\Controllers\Auth\RegisterController@showRegistrationForm"},{"host":null,"methods":["POST"],"uri":"register","name":null,"action":"App\Http\Controllers\Auth\RegisterController@register"},{"host":null,"methods":["GET","HEAD"],"uri":"password\/reset","name":null,"action":"App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm"},{"host":null,"methods":["POST"],"uri":"password\/email","name":null,"action":"App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail"},{"host":null,"methods":["GET","HEAD"],"uri":"password\/reset\/{token}","name":null,"action":"App\Http\Controllers\Auth\ResetPasswordController@showResetForm"},{"host":null,"methods":["POST"],"uri":"password\/reset","name":null,"action":"App\Http\Controllers\Auth\ResetPasswordController@reset"},{"host":null,"methods":["GET","HEAD"],"uri":"home","name":null,"action":"App\Http\Controllers\HomeController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"test","name":null,"action":"App\Http\Controllers\HomeController@test"},{"host":null,"methods":["POST"],"uri":"admin\/user\/updatemulti","name":"admin.user.updatemulti","action":"App\Http\Controllers\Backend\UsersController@postUpdateMulti"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/user\/export\/{type}","name":"admin.user.export","action":"App\Http\Controllers\Backend\UsersController@export"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/user\/permission\/{id}","name":"admin.user.permission","action":"App\Http\Controllers\Backend\UsersController@permission"},{"host":null,"methods":["PUT"],"uri":"admin\/user\/updatepermission\/{id}","name":"admin.user.updatePermission","action":"App\Http\Controllers\Backend\UsersController@updatePermission"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/user","name":"admin.user.index","action":"App\Http\Controllers\Backend\UsersController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/user\/create","name":"admin.user.create","action":"App\Http\Controllers\Backend\UsersController@create"},{"host":null,"methods":["POST"],"uri":"admin\/user","name":"admin.user.store","action":"App\Http\Controllers\Backend\UsersController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/user\/{user}","name":"admin.user.show","action":"App\Http\Controllers\Backend\UsersController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/user\/{user}\/edit","name":"admin.user.edit","action":"App\Http\Controllers\Backend\UsersController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"admin\/user\/{user}","name":"admin.user.update","action":"App\Http\Controllers\Backend\UsersController@update"},{"host":null,"methods":["DELETE"],"uri":"admin\/user\/{user}","name":"admin.user.destroy","action":"App\Http\Controllers\Backend\UsersController@destroy"},{"host":null,"methods":["POST"],"uri":"admin\/permission\/updatemulti","name":"admin.permission.updatemulti","action":"App\Http\Controllers\Backend\PermissionsController@postUpdateMulti"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/permission\/export\/{type}","name":"admin.permission.export","action":"App\Http\Controllers\Backend\PermissionsController@export"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/permission","name":"admin.permission.index","action":"App\Http\Controllers\Backend\PermissionsController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/permission\/create","name":"admin.permission.create","action":"App\Http\Controllers\Backend\PermissionsController@create"},{"host":null,"methods":["POST"],"uri":"admin\/permission","name":"admin.permission.store","action":"App\Http\Controllers\Backend\PermissionsController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/permission\/{permission}","name":"admin.permission.show","action":"App\Http\Controllers\Backend\PermissionsController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/permission\/{permission}\/edit","name":"admin.permission.edit","action":"App\Http\Controllers\Backend\PermissionsController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"admin\/permission\/{permission}","name":"admin.permission.update","action":"App\Http\Controllers\Backend\PermissionsController@update"},{"host":null,"methods":["DELETE"],"uri":"admin\/permission\/{permission}","name":"admin.permission.destroy","action":"App\Http\Controllers\Backend\PermissionsController@destroy"},{"host":null,"methods":["POST"],"uri":"admin\/role\/updatemulti","name":"admin.role.updatemulti","action":"App\Http\Controllers\Backend\RolesController@postUpdateMulti"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/role\/export\/{type}","name":"admin.role.export","action":"App\Http\Controllers\Backend\RolesController@export"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/role\/test","name":"admin.group.test","action":"App\Http\Controllers\Backend\RolesController@test"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/role","name":"admin.role.index","action":"App\Http\Controllers\Backend\RolesController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/role\/create","name":"admin.role.create","action":"App\Http\Controllers\Backend\RolesController@create"},{"host":null,"methods":["POST"],"uri":"admin\/role","name":"admin.role.store","action":"App\Http\Controllers\Backend\RolesController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/role\/{role}","name":"admin.role.show","action":"App\Http\Controllers\Backend\RolesController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/role\/{role}\/edit","name":"admin.role.edit","action":"App\Http\Controllers\Backend\RolesController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"admin\/role\/{role}","name":"admin.role.update","action":"App\Http\Controllers\Backend\RolesController@update"},{"host":null,"methods":["DELETE"],"uri":"admin\/role\/{role}","name":"admin.role.destroy","action":"App\Http\Controllers\Backend\RolesController@destroy"},{"host":null,"methods":["POST"],"uri":"admin\/group\/updatemulti","name":"admin.group.updatemulti","action":"App\Http\Controllers\Backend\GroupsController@postUpdateMulti"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/group\/export\/{type}","name":"admin.group.export","action":"App\Http\Controllers\Backend\GroupsController@export"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/group","name":"admin.group.index","action":"App\Http\Controllers\Backend\GroupsController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/group\/create","name":"admin.group.create","action":"App\Http\Controllers\Backend\GroupsController@create"},{"host":null,"methods":["POST"],"uri":"admin\/group","name":"admin.group.store","action":"App\Http\Controllers\Backend\GroupsController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/group\/{group}","name":"admin.group.show","action":"App\Http\Controllers\Backend\GroupsController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/group\/{group}\/edit","name":"admin.group.edit","action":"App\Http\Controllers\Backend\GroupsController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"admin\/group\/{group}","name":"admin.group.update","action":"App\Http\Controllers\Backend\GroupsController@update"},{"host":null,"methods":["DELETE"],"uri":"admin\/group\/{group}","name":"admin.group.destroy","action":"App\Http\Controllers\Backend\GroupsController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"_debugbar\/open","name":"debugbar.openhandler","action":"Barryvdh\Debugbar\Controllers\OpenHandlerController@handle"},{"host":null,"methods":["GET","HEAD"],"uri":"_debugbar\/clockwork\/{id}","name":"debugbar.clockwork","action":"Barryvdh\Debugbar\Controllers\OpenHandlerController@clockwork"},{"host":null,"methods":["GET","HEAD"],"uri":"_debugbar\/assets\/stylesheets","name":"debugbar.assets.css","action":"Barryvdh\Debugbar\Controllers\AssetController@css"},{"host":null,"methods":["GET","HEAD"],"uri":"_debugbar\/assets\/javascript","name":"debugbar.assets.js","action":"Barryvdh\Debugbar\Controllers\AssetController@js"}],
            prefix: '',

            route : function (name, parameters, route) {
                route = route || this.getByName(name);

                if ( ! route ) {
                    return undefined;
                }

                return this.toRoute(route, parameters);
            },

            url: function (url, parameters) {
                parameters = parameters || [];

                var uri = url + '/' + parameters.join('/');

                return this.getCorrectUrl(uri);
            },

            toRoute : function (route, parameters) {
                var uri = this.replaceNamedParameters(route.uri, parameters);
                var qs  = this.getRouteQueryString(parameters);

                return this.getCorrectUrl(uri + qs);
            },

            replaceNamedParameters : function (uri, parameters) {
                uri = uri.replace(/\{(.*?)\??\}/g, function(match, key) {
                    if (parameters.hasOwnProperty(key)) {
                        var value = parameters[key];
                        delete parameters[key];
                        return value;
                    } else {
                        return match;
                    }
                });

                // Strip out any optional parameters that were not given
                uri = uri.replace(/\/\{.*?\?\}/g, '');

                return uri;
            },

            getRouteQueryString : function (parameters) {
                var qs = [];
                for (var key in parameters) {
                    if (parameters.hasOwnProperty(key)) {
                        qs.push(key + '=' + parameters[key]);
                    }
                }

                if (qs.length < 1) {
                    return '';
                }

                return '?' + qs.join('&');
            },

            getByName : function (name) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].name === name) {
                        return this.routes[key];
                    }
                }
            },

            getByAction : function(action) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].action === action) {
                        return this.routes[key];
                    }
                }
            },

            getCorrectUrl: function (uri) {
                var url = this.prefix + '/' + uri.replace(/^\/?/, '');

                if(!this.absolute)
                    return url;

                return this.rootUrl.replace('/\/?$/', '') + url;
            }
        };

        var getLinkAttributes = function(attributes) {
            if ( ! attributes) {
                return '';
            }

            var attrs = [];
            for (var key in attributes) {
                if (attributes.hasOwnProperty(key)) {
                    attrs.push(key + '="' + attributes[key] + '"');
                }
            }

            return attrs.join(' ');
        };

        var getHtmlLink = function (url, title, attributes) {
            title      = title || url;
            attributes = getLinkAttributes(attributes);

            return '<a href="' + url + '" ' + attributes + '>' + title + '</a>';
        };

        return {
            // Generate a url for a given controller action.
            // laroute.action('HomeController@getIndex', [params = {}])
            action : function (name, parameters) {
                parameters = parameters || {};

                return routes.route(name, parameters, routes.getByAction(name));
            },

            // Generate a url for a given named route.
            // laroute.route('routeName', [params = {}])
            route : function (route, parameters) {
                parameters = parameters || {};

                return routes.route(route, parameters);
            },

            // Generate a fully qualified URL to the given path.
            // laroute.route('url', [params = {}])
            url : function (route, parameters) {
                parameters = parameters || {};

                return routes.url(route, parameters);
            },

            // Generate a html link to the given url.
            // laroute.link_to('foo/bar', [title = url], [attributes = {}])
            link_to : function (url, title, attributes) {
                url = this.url(url);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given route.
            // laroute.link_to_route('route.name', [title=url], [parameters = {}], [attributes = {}])
            link_to_route : function (route, title, parameters, attributes) {
                var url = this.route(route, parameters);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given controller action.
            // laroute.link_to_action('HomeController@getIndex', [title=url], [parameters = {}], [attributes = {}])
            link_to_action : function(action, title, parameters, attributes) {
                var url = this.action(action, parameters);

                return getHtmlLink(url, title, attributes);
            }

        };

    }).call(this);

    /**
     * Expose the class either via AMD, CommonJS or the global object
     */
    if (typeof define === 'function' && define.amd) {
        define(function () {
            return laroute;
        });
    }
    else if (typeof module === 'object' && module.exports){
        module.exports = laroute;
    }
    else {
        window.laroute = laroute;
    }

}).call(this);

